<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function category_name($product_category_id)
	{
		$product_category = $this->db->select('product_category_name')->where('product_category_id',$product_category_id)->get('product_category')->row_array();
		return $product_category['product_category_name'];
	}

	public function sub_category_name($product_sub_category_id)
	{
		$product_category = $this->db->select('product_sub_category_name')->where('product_sub_category_id',$product_sub_category_id)->get('product_sub_category')->row_array();
		return $product_category['product_sub_category_name'];
	}

	public function color_code($color_id)
	{
		$product_category = $this->db->select('color_code')->where('color_id',$color_id)->get('color')->row_array();
		return $product_category['color_code'];
	}

	public function color_name($color_id)
	{
		$product_category = $this->db->select('color_name')->where('color_id',$color_id)->get('color')->row_array();
		return $product_category['color_name'];
	}

	public function product_name($product_id)
	{
		$product_category = $this->db->select('product_name')->where('product_id',$product_id)->get('product')->row_array();
		return $product_category['product_name'];
	}
	
	public function user_name($user_id)
	{
		$data = $this->db->select('name')->where('user_id',$user_id)->get('user')->row_array();
		return $data['name'];
	}
	
	public function validate_data($table_name,$data)
	{
		$cols = $this->db->select("GROUP_CONCAT(column_name)AS columns")->where('table_schema',$this->db->database)->where('table_name',$table_name)->get('information_schema.columns')->row_array();
		$colExist = explode(",",$cols['columns']);
		
		foreach($data as $colName => $value)
		{
		    if(!in_array($colName, $colExist)){
		      //  $this->db->query("ALTER TABLE $table_name ADD $colName TEXT NULL");
		      unset($data[$colName]);
		    }
		}
		
		return $data;
		
	}
	
	public function send_sms($mobile, $message)
	{
        $message = urlencode($message);
        $url="http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?AUTH_KEY=792644ddfae626a9cc3681e216a5d1f&message=$message&senderId=AMBECL&routeId=1&mobileNos=$mobile&smsContentType=english";
        $ch = curl_init();    
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable  
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
        $result = curl_exec($ch);  
        curl_close($ch); 
        return $result;
	}
	
	function push_firebase($registration_ids, $message)
	{
    	$url = 'https://fcm.googleapis.com/fcm/send';
    	$fields = array(
    		'registration_ids' => $registration_ids,
    		'data' => $message,
    	);
    	$headers = array(
    		'Authorization: key='."AAAA266XilM:APA91bFf0_AFEniYv5e8yNSncoigp6pk009OBbzZMwFXhmseEw6wu-DFSnehUlGyAVns4aA0li1UAWUeYaDAU3diQk1Z7qOFTDAyDIppLEFoY0EesUFMVRnWjUQPMKJmtHcZTHscIPwX",
    		'Content-Type: application/json'
    	);

    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	// Disabling SSL Certificate support temporarly
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	    $result = curl_exec($ch);
	    curl_close($ch);
        return $result;
	}
	
	
	
	
	
	#--------------------------Base Model END------------------------------
}
