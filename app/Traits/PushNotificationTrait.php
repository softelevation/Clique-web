<?php

namespace App\Traits;


trait PushNotificationTrait
{
    // use HelperTrait;
	
    public function send_PushNotificat($firebaseToken,$title,$body){
		if($firebaseToken){
			$SERVER_API_KEY = 'AAAA1Yfqffo:APA91bFZHa2zh1ZWSkCa-e7TsHLx2lBc7awEOrNEsAZfRdjQB-W8Y2YEpuwvky3qz6Hjgz2xmsnbVZM2vkX7n7mHsHrNFwN-N57-gq42bAoCIekmoE9dB2oOCJT5gVRSzn52GkJS1ojx';
			$data = [
				"registration_ids" => $firebaseToken,
				"notification" => [
					"title" => $title,
					"body" => $body,  
				]
			];
			$dataString = json_encode($data);
			
			$headers = [
				'Authorization: key=' . $SERVER_API_KEY,
				'Content-Type: application/json',
			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
			$response = curl_exec($ch);
			return $response;
		}else{
			return false;
		}
    }
}
