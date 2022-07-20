<?php
// $ENCRYPTION_KEY = '123';
if(!function_exists('display_date_format'))
{
	//2020-12-02
    function display_date_format($date)
    {
    	if($date != ""){
    		return date('d-m-Y', strtotime($date));
    	}else{
    		return "";
    	}
    }

    function slugify($string)
    {
        $string = utf8_encode($string);
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $string = preg_replace('/[^a-z0-9- ]/i', '', $string);
        $string = str_replace(' ', '-', $string);
        $string = trim($string, '-');
        $string = strtolower($string);
        if (empty($string)) {
            return 'n-a';
        }
        return $string;
    }
    function authavtar()
    {

    }


}

if(!function_exists('pr')){
	
	function pr($input)
    {
		echo '<pre>';
		// echo $ENCRYPTION_KEY;
		print_r($input);
		die;
    }
}

function hash_equals_custom($knownString, $userString) {
        if (function_exists('mb_strlen')) {
            $kLen = mb_strlen($knownString, '8bit');
            $uLen = mb_strlen($userString, '8bit');
        } else {
            $kLen = strlen($knownString);
            $uLen = strlen($userString);
        }
        if ($kLen !== $uLen) {
            return false;
        }
        $result = 0;
        for ($i = 0; $i < $kLen; $i++) {
            $result |= (ord($knownString[$i]) ^ ord($userString[$i]));
        }
        return 0 === $result;
    }
	
if(!function_exists('cliqueEncrypt')){
	
	function cliqueEncrypt($action, $string)
    {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = 'CuH8WPfXzMj0xRWybHjssWJ+IhTDqL5w0OD9+zXFloA=';
		$ivLen = openssl_cipher_iv_length($encrypt_method);
		/**
		 * the key was generated with 32 pseudo-bytes and then base64Encod()-ed.
		 * Not sure of the reason for encoding - just decoding in case it's necessary.
		 * 
		 * Thoughts?
		 * **/
		$key = base64_decode($key);

		if ( $action == 'encrypt' ) {
			/**
			* "AES-256-CBC" expects a 16-byte string - create an 8-byte string to be 
			* converted to a 16-byte hex before being used as the initialization vector
			* TLDR" in order to end up with 16-bytes to feed to openssl_random_pseudo_bytes,
			* divide initial length in half as the hex value will double it
			* */
			$iv = openssl_random_pseudo_bytes($ivLen/2);
			$iv = bin2hex($iv);
			$tmp_data_str_in = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($tmp_data_str_in . $iv);
		} else if( $action == 'decrypt' ) {
			$data_str_in = base64_decode($string);
			
			// This time, rather than generating one, we get the iv (converted to hex)
			// by grabbing the last 16 characters of the concatenation of the 2 that happened
			// during encryption.
			$iv = substr($data_str_in, -$ivLen);
			
			// And now we just grab everything BUT the last 16 characters. We'll
			// run openssl_decrypt and return a copy of the original input
			$encrypted_txt_str = substr($data_str_in, 0, strlen($data_str_in)-$ivLen); 

			// Notice we are returning the encrypted value of a string consisting of
			// encoded versions of the input text and a random `IV` - we'll grab the `IV`
			// from it later in order to decrypt later. 
			$output = openssl_decrypt($encrypted_txt_str, $encrypt_method, $key, 0, $iv);
		}

		return $output;
    }
}
if(!function_exists('cliqueDecrypt')){
	
	function cliqueDecrypt($encrypted_string)
    {
		$cipher     = 'AES-256-CBC';
        $options    = OPENSSL_RAW_DATA;
        $hash_algo  = 'sha256';
        $sha2len    = 32;
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($encrypted_string, 0, $ivlen);
        $hmac = substr($encrypted_string, $ivlen, $sha2len);
        $ciphertext_raw = substr($encrypted_string, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, 'clicque123', $options, $iv);
        $calcmac = hash_hmac($hash_algo, $ciphertext_raw, 'clicque123', true);
        if(function_exists('hash_equals')) {
            if (hash_equals($hmac, $calcmac)) return $original_plaintext;
        } else {
            if ($this->hash_equals_custom($hmac, $calcmac)) return $original_plaintext;
        }
    }
}

