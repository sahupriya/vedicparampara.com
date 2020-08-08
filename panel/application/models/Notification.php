<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends CI_Model{
    function __construct() {

    }
    /*
     * get rows from the mk_suborder table
     */	 
	 
    
 

    function sendNotification($title , $body , $customData = array(), $topic , $serverKey ="AAAADT3RoSM:APA91bFAl8iT5HM8DkQpECm6Iwf2YEN1eFsAyO_9NTshJwWy6K1qJym-Rjmz3N2aF5JMAhriE7FVsAtES4gih-xiQ1ABrBADLIOH7_F3jLkiuFnRQbMZnWtWhY2m1ysJQjIrRCQe-5Om"){
    if($serverKey != ""){
        ini_set("allow_url_fopen", "On");
        $data = 
        [
            "to" => '/topics/'.$topic,
            // "notification" => [
            //     "body" => $body,
            //     "title" => $title,
            // ],
            "data" => $customData
        ];

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n" . 
                            "Authorization:key=".$serverKey
            )
        );

        $context  = stream_context_create( $options );
        $result = file_get_contents( "https://fcm.googleapis.com/fcm/send", false, $context );
        return json_decode( $result );
    }
    return false;
}
    
}