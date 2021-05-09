<?php
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
