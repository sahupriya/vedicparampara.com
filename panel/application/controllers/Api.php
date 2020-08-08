<?php
date_default_timezone_set('Asia/Calcutta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('base');
        $this->load->database();
        $this->controller = "Api/";
        $this->load->library('session');
        $this->load->library('excel');
        ini_set('memory_limit', '-1');
        $this->load->model('Notification');
        error_reporting(0);
    }
    
    public function signup()
    {
        $user_id = $this->input->get_post('user_id');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        
        $q = $this->db->where('user_id !=',$user_id)->where('email',$email)->get('user');
        $q = $this->db->where('user_id !=',$user_id)->where('mobile',$mobile)->get('user');
        if($q->num_rows() > 0)
        {
            $json['result'] = "Email Already Exist";
            $json['result'] = "Mobile Already Exist";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            if($_FILES['image']['name'])
            {
                $image = "uploads/user/".rand(0000,9999).basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_REQUEST['image'] = $image;
                }
            }
            
            if($_FILES['aadhar_image']['name'])
            {
                $aadhar_image = "uploads/user/aadhar".rand(0000,9999).basename($_FILES["aadhar_image"]["name"]);
                if(move_uploaded_file($_FILES['aadhar_image']['tmp_name'], $aadhar_image))
                {
                    $_REQUEST['aadhar_image'] = $aadhar_image;
                }
            }

            if($user_id != ''){
                $validate_data = $this->base->validate_data('user',$_REQUEST);
                $this->db->where('user_id',$user_id)->update('user',$validate_data);
            }
            else
            {
                
                $q1 = $this->db->where('mobile',$mobile)->where('otp_verified',1)->get('user');
                
                 if($q1->num_rows() > 0)
                {
                    $json['result'] = "Email Already Exist";
                    $json['result'] = "Mobile Already Exist";
                    $json['message'] = "unsuccess";
                    $json['status'] = 0;
            
                    header('Content-Type: application/json');
                    echo json_encode($json);
        }else{
                $otp = rand(0000,9999);
                $message = "Welcome to PARAMPARA. Please Enter OTP : $otp, To Verify Your Profile and Get Startes. Regards PARAMPARA.";
                $sms_responce = $this->base->send_sms($_REQUEST['mobile'],$message);
                // $this->db->insert("test",array('data'=>json_encode($sms_responce),'data1'=>$_REQUEST['mobile']));
                // echo "<pre>";print_r($sms_responce);die;
                $_REQUEST['otp'] = $otp;
                
                $_REQUEST['approved'] = ($_REQUEST['type'] == 'VENDOR') ? 0 : 1;
                
                $validate_data = $this->base->validate_data('user',$_REQUEST);
                $this->db->insert('user',$validate_data);
                $user_id = $this->db->insert_id();
                
                if($_REQUEST['type'] == 'VENDOR')
                {
                    $this->db->insert('notification',array(
                        'notify_by'=> $user_id,
                        'notify_by_name'=> $validate_data['username'],
                        'notify_by_image'=> isset($validate_data['image']) ? $validate_data['image'] : 'uploads/user/default-user.jpg',
                        'notify_to'=>'admin',
                        'message'=> 'A new Vendor has been Register, Please Approve The Vendor.',
                        'link' => site_url('site/vendor')
                        ));
                }
                
        }
            }

            $data = $this->db->where('user_id',$user_id)->get('user')->row_array();
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }
    
    public function signupPandit()
    {
        $user_id = $this->input->get_post('user_id');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('mobile');
        
        $p = $this->db->where('user_id !=',$user_id)->where('email',$email)->get('pandit');
        $q = $this->db->where('user_id !=',$user_id)->where('mobile',$mobile)->get('pandit');
        if($q->num_rows() > 0||$p->num_rows() > 0)
        {
            $json['result'] = "Entered Email or Mobile Already Exist";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            if($_FILES['image']['name'])
            {
                $image = "uploads/user/".rand(0000,9999).basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_REQUEST['image'] = $image;
                }
            }
            
            if($_FILES['aadhar_image']['name'])
            {
                $aadhar_image = "uploads/user/aadhar".rand(0000,9999).basename($_FILES["aadhar_image"]["name"]);
                if(move_uploaded_file($_FILES['aadhar_image']['tmp_name'], $aadhar_image))
                    $_REQUEST['aadhar_image'] = $aadhar_image;
                }
            }

            if($user_id != ''){
                $validate_data = $this->base->validate_data('pandit',$_REQUEST);
                $this->db->where('user_id',$user_id)->update('pandit',$validate_data);
            }
            else
            {
                $p1 = $this->db->where('mobile',$mobile)->get('pandit');
                
            if($p1->num_rows() > 0)
                {
                $json['result'] = "Email Already Exist";
                $json['result'] = "Mobile Already Exist";
                $json['message'] = "unsuccess";
                $json['status'] = 0;
            
                header('Content-Type: application/json');
                echo json_encode($json);
        }else{
                $otp = rand(0000,9999);
                $message = "Welcome to PARAMPARA. Please Enter OTP : $otp, To Verify Your Profile and Get Startes. Regards PARAMPARA.";
                $sms_responce = $this->base->send_sms($_REQUEST['mobile'],$message);
                // $this->db->insert("test",array('data'=>json_encode($sms_responce),'data1'=>$_REQUEST['mobile']));
                // echo "<pre>";print_r($sms_responce);die;
                $_REQUEST['otp'] = $otp;
                
                $_REQUEST['approved'] = ($_REQUEST['type'] == 'PANDIT') ? 0 : 1;
                
                $validate_data = $this->base->validate_data('pandit',$_REQUEST);
                $this->db->insert('pandit',$validate_data);
                $user_id = $this->db->insert_id();
                
                if($_REQUEST['type'] == 'PANDIT')
                {
                    $this->db->insert('notification',array(
                        'notify_by'=> $user_id,
                        'notify_by_name'=> $validate_data['username'],
                        'notify_by_image'=> isset($validate_data['image']) ? $validate_data['image'] : 'uploads/user/default-user.jpg',
                        'notify_to'=>'admin',
                        'message'=> 'A new Pandit has been Register, Please Approve The Pandit.',
                        'link' => site_url('site/vendor')
                        ));
                }
        }
            }

            if($user_id!=null){
                $data = $this->db->where('user_id',$user_id)->get('pandit')->row_array();
            }else{
                $data = $this->db->where('email',$email)->get('pandit')->row_array();
            }
        
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        } 
        
    public function signupVender()
    {
        $id = $this->input->get_post('id');
        $email = $this->input->get_post('email');
        $mobile = $this->input->get_post('contact');
        
        $q = $this->db->where('id !=',$id)->where('email',$email)->get('vender');
        $p = $this->db->where('id !=',$id)->where('contact',$mobile)->get('vender');
        if($q->num_rows() > 0||$p->num_rows() > 0)
        {
            $json['result'] = "Entered Email or Contact Already Exist";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            if($_FILES['image']['name'])
            {
                $image = "uploads/user/".rand(0000,9999).basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_REQUEST['image'] = $image;
                }
            }
            
            if($_FILES['idProof']['name'])
            {
                $aadhar_image = "uploads/user/aadhar".rand(0000,9999).basename($_FILES["idProof"]["name"]);
                if(move_uploaded_file($_FILES['idProof']['tmp_name'], $aadhar_image))
                {
                    $_REQUEST['aadhar_image'] = $aadhar_image;
                }
            }

            if($id != ''){
                $validate_data = $this->base->validate_data('vender',$_REQUEST);
                $this->db->where('id',$id)->update('vender',$validate_data);
            }
            else
            {
                
                $p1 = $this->db->where('contact',$mobile)->get('vender');
                if($p1->num_rows() > 0)
                {
                    $json['result'] = "Entered Email or Contact Already Exist";
                    $json['message'] = "unsuccess";
                    $json['status'] = 0;
            
                    header('Content-Type: application/json');
                    echo json_encode($json);
             }else{
                $otp = rand(0000,9999);
                $message = "Welcome to PARAMPARA. Please Enter OTP : $otp, To Verify Your Profile and Get Startes. Regards PARAMPARA.";
                $sms_responce = $this->base->send_sms($_REQUEST['contact'],$message);
                // $this->db->insert("test",array('data'=>json_encode($sms_responce),'data1'=>$_REQUEST['mobile']));
                // echo "<pre>";print_r($sms_responce);die;
                $_REQUEST['otp'] = $otp;
                
                $_REQUEST['approved'] = ($_REQUEST['type'] == 'VENDOR') ? 0 : 1;
                
                $validate_data = $this->base->validate_data('vender',$_REQUEST);
                $this->db->insert('vender',$validate_data);
                $user_id = $this->db->insert_id();
                
                if($_REQUEST['type'] == 'VENDOR')
                {
                    $this->db->insert('notification',array(
                        'notify_by'=> $user_id,
                        'notify_by_name'=> $validate_data['name'],
                        'notify_by_image'=> isset($validate_data['image']) ? $validate_data['image'] : 'uploads/user/default-user.jpg',
                        'notify_to'=>'admin',
                        'message'=> 'A new Vendor has been Register, Please Approve The Vendor.',
                        'link' => site_url('site/vendor')
                        ));
                }
            }
            }

            if($id!=null){
                $data = $this->db->where('id',$id)->get('vender')->row_array();
            }else{
                $data = $this->db->where('email',$email)->get('vender')->row_array();
            }
        
            $data['image'] = base_url($data['image']);
            $data['idProof'] = base_url($data['aadhar_image']);
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }
    
    public function resend_otp()
    {
        $mobile = $this->input->get_post('mobile');
        
        $q = $this->db->where('mobile',$mobile)->get('user');
        if($q->num_rows() > 0)
        {
            $data = $q->row_array();
            
            $otp = rand(0000,9999);
            $message = "Welcome to PARAMPARA. Please Enter OTP : $otp, To Verify Your Profile and Get Startes. Regards PARAMPARA.";
            $sms_responce = $this->base->send_sms($mobile,$message);
            // echo "<pre>";print_r($sms_responce);die;
            $data['otp'] = $otp;
            $this->db->where('mobile',$mobile)->update('user',array('otp'=>$otp));
            
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Please Enter Registered Mobile.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }
    
    public function resend_otpVenderPandit()
    {
        $mobile = $this->input->get_post('mobile');
        $type = $this->input->get_post('type');
        if($type=='PANDIT'){
            $q = $this->db->where('mobile',$mobile)->get('pandit');
        }else{
            $q = $this->db->where('contact',$mobile)->get('vender');

        }

        if($q->num_rows() > 0)
        {
            $data = $q->row_array();
            
            $otp = rand(0000,9999);
            $message = "Welcome to PARAMPARA. Please Enter OTP : $otp, To Verify Your Profile and Get Startes. Regards PARAMPARA.";
            $sms_responce = $this->base->send_sms($mobile,$message);
            // echo "<pre>";print_r($sms_responce);die;
            $data['otp'] = $otp;
            if($type=='PANDIT'){
                $this->db->where('mobile',$mobile)->update('pandit',array('otp'=>$otp));
            }else{
                $this->db->where('contact',$mobile)->update('vender',array('otp'=>$otp));
    
            }
            
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Please Enter Registered Mobile.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }

    public function verify_otp()
    {

        $user_id = $this->input->get_post('user_id');
        $otp = $this->input->get_post('otp');
        
        $q = $this->db->where('user_id',$user_id)->where('otp',$otp)->get('user');
        if($q->num_rows() > 0)
        {
            $data = $q->row_array();
            
            $this->db->where('user_id',$user_id)->update('user',array('otp_verified'=>1));
            
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            $data['otp_verified'] = 1;
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Please Enter Valid OTP.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }

    public function verify_otpVenderPandit()
    {
        $user_id = $this->input->get_post('user_id');
        $type = $this->input->get_post('type');
        $otp = $this->input->get_post('otp');
        if($type=='PANDIT'){
            $q = $this->db->where('user_id',$user_id)->where('otp',$otp)->get('pandit');
        }else{
            $q = $this->db->where('id',$user_id)->where('otp',$otp)->get('vender');
        }
       
        $data1 ;
        if($q->num_rows() > 0)
        {
            if($type=='PANDIT'){
                $this->db->where('user_id',$user_id)->update('pandit',array('otp_verified'=>1));
                $q1 = $this->db->where('user_id',$user_id)->where('otp',$otp)->get('pandit');
                $data1  = $q1->row_array();
            }else{
                $this->db->where('id',$user_id)->update('vender',array('isActive'=>1));
                $q1 = $this->db->where('id',$user_id)->where('otp',$otp)->get('vender');
              $data1  = $q1->row_array();

            }
            
           

            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            $data['otp_verified'] = 1;
            
            $json['result'] = $data1;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Please Enter Valid OTP.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }

    public function social_login()
    {
        $social_id = $this->input->get_post('social_id');
        $email = $this->input->get_post('email');
        
        $q = $this->db->where('social_id',$social_id)->get('user');
        if($q->num_rows() > 0)
        {
            $data = $q->row_array();
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            if($_FILES['image']['name'])
            {
                $image = "uploads/user/".rand(0000,9999).basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_REQUEST['image'] = $image;
                }
            }
            
            if($_FILES['aadhar_image']['name'])
            {
                $aadhar_image = "uploads/user/aadhar".rand(0000,9999).basename($_FILES["aadhar_image"]["name"]);
                if(move_uploaded_file($_FILES['aadhar_image']['tmp_name'], $aadhar_image))
                {
                    $_REQUEST['aadhar_image'] = $aadhar_image;
                }
            }
            
            $validate_data = $this->base->validate_data('user',$_REQUEST);
            $this->db->insert('user',$validate_data);
            $user_id = $this->db->insert_id();

            $data = $this->db->where('user_id',$user_id)->get('user')->row_array();
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }       
    }

    public function login()
    {
        $type = $this->input->get_post('type');
        $email = $this->input->get_post('email');
        $password = $this->input->get_post('password');
        $register_id = $this->input->get_post('register_id');

        $isValid = $this->db->where('type', $type)->where('mobile', $email)->where('password',$password)->get('user');
        if($isValid->num_rows())
        {
            $data = $isValid->row_array();
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            
            if($register_id != ''){
                $this->db->where('user_id',$data['user_id'])->update('user',array('register_id'=>$register_id));
                $data['register_id'] = $register_id;
            }
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Please enter valid credentials";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function loginVenderPandit()
    {
        $email = $this->input->get_post('email');
        $password = $this->input->get_post('password');
        $type = $this->input->get_post('type');

        if($type=='VENDER'){
            $isValid = $this->db->where('contact', $email)->where('password',$password)->get('vender');
        }else{
            $isValid = $this->db->where('mobile', $email)->where('password',$password)->get('pandit');

        }

        if($isValid->num_rows())
        {
            $data = $isValid->row_array();
            $data['image'] = base_url($data['image']);
            if($type=='VENDER'){
                $data['idProof'] = base_url($data['idProof']);

            }  else{
            $data['aadhar_image'] = base_url($data['aadhar_image']);

            }
            
    
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Please enter valid Email or Password";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_profile()
    {
        $user_id = $this->input->get_post('user_id');

        $isValid = $this->db->where('user_id',$user_id)->get('user');
        if($isValid->num_rows())
        {
            $data = $isValid->row_array();
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "User not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_slider()
    {
        $isValid = $this->db->where('is_display','1')->get('carousel_slider');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No slider image found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_commission()
    {
        $isValid = $this->db->get('commission');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No commission  found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_donation()
    {
        $isValid = $this->db->where('status','1')->get('donation');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No Donation is found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function donation_pay()
    { 
        $validate_data = $this->base->validate_data('donationlisting',$_REQUEST);
        $a=$this->db->insert('donationlisting',$validate_data);
       
        $pooja_booking_id = $this->db->insert_id();
		$message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "Your docation is successfully submitted",
                    "message" => 'Your docation is successfully submitted',
                    "id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
    }
    
    public function dailypandit_booking_submittion()
    {
        $user_id = $this->input->get_post('user_id');
        $isValid = $this->db->where('user_id',$user_id)->get('dailypandit_booking');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No Request for Daily Pandit";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
    public function assign_dailypandit()
    {
        $user_id = $this->input->get_post('pandit_id');
        $this->db->where('pandit_id',$user_id);
        $this->db->select('C.*, T.username AS username');
        $this->db->from('dailypandit_booking AS C');
        $this->db->join('user AS T', 'T.user_id = C.user_id', 'left');
        $isValid= $this->db->get();
        //print_r($isValid1);exit();
        //$isValid = $this->db->where('pandit_id',$user_id)->get('dailypandit_booking');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No Request for Daily Pandit";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    public function get_kundali_booking()
    {
        $user_id = $this->input->get_post('user_id');
        $isValid = $this->db->where('user_id',$user_id)->get('kundali');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No Request for Kundali making";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_paramars_booking()
    {
        $user_id = $this->input->get_post('user_id');
        $isValid = $this->db->where('user_id',$user_id)->get('paramarsh');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No Request for   paramarsh";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    public function donation_submittion()
    {
        $user_id = $this->input->get_post('user_id');
        
        
        
         $this->db->select('C.*, T.donation_cause AS donation_cause');
        $this->db->from('donationlisting AS C');
        $this->db->join('donation AS T', 'T.donation_id = C.cause', 'left');
        $isValid= $this->db->get();
        //$isValid = $this->db->where('userId',$user_id)->get('donationlisting');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No Donation Submit";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function change_password()
    {
        $user_id = $this->input->get_post('user_id');
        $old_password = $this->input->get_post('old_password');
        $password = $this->input->get_post('password');
        
        $isValid = $this->db->where("user_id",$user_id)->where("password",$old_password)->get('user');
        if($isValid->num_rows() > 0)
        {
            $this->db->where("user_id",$user_id)->update("user",array('password'=>$password));

            $data = $this->db->where("user_id",$user_id)->get('user')->row_array();
            $data['image'] = base_url($data['image']);
            $data['aadhar_image'] = base_url($data['aadhar_image']);
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Old password does not match";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function forgot_password()
    {
        
        $this->load->helper('string');

        $mobile = $this->input->get_post('mobile');
        $isValid = $this->db->where("mobile",$mobile)->get('user');
        if ($isValid->num_rows() > 0)
        {
            $user = $isValid->row_array();
            $pass = random_string('alnum', 6);
            
            $message = "Your new Password Of Parampara App is : $pass";
            $sms_responce = $this->base->send_sms($mobile,$message);

            $this->db->where('mobile',$mobile)->update('user',array('password'=>$pass));
            
            $ressult['result'] = "Forgot password successfuly";
            $ressult['message'] = 'successfull';
            $ressult['status'] = '1';
            $json = $ressult;
        }
        else
        {
            $ressult['result'] = 'Mobile not exist';
            $ressult['message'] = 'unsuccessfull';
            $ressult['status'] = '0';
            $json = $ressult;
        }

        header('Content-type: application/json');
        echo json_encode($json);
    }
     public function pandit_forgot_password()
    {
        
        $this->load->helper('string');

        $mobile = $this->input->get_post('mobile');
        //$isValid = $this->db->where("mobile",$mobile)->get('pandit');
        $type = $this->input->get_post('type');

        if($type=='VENDER'){
            $isValid = $this->db->where('contact', $mobile)->get('vender');
        }else{
            $isValid = $this->db->where('mobile', $mobile)->get('pandit');

        }
        if ($isValid->num_rows() > 0)
        {
            $user = $isValid->row_array();
            $pass = random_string('alnum', 6);
            
            $message = "Your new Password Of Parampara App is : $pass";
            $sms_responce = $this->base->send_sms($mobile,$message);

            $this->db->where('mobile',$mobile)->update('pandit',array('password'=>$pass));
            
            $ressult['result'] = "Forgot password successfuly";
            $ressult['message'] = 'successfull';
            $ressult['status'] = '1';
            $json = $ressult;
        }
        else
        {
            $ressult['result'] = 'Mobile not exist';
            $ressult['message'] = 'unsuccessfull';
            $ressult['status'] = '0';
            $json = $ressult;
        }

        header('Content-type: application/json');
        echo json_encode($json);
    }
    
     public function vender_forgot_password()
    {
        
        $this->load->helper('string');

        $mobile = $this->input->get_post('mobile');
        $isValid = $this->db->where("contact",$mobile)->get('vender');
        if ($isValid->num_rows() > 0)
        {
            $user = $isValid->row_array();
            $pass = random_string('alnum', 6);
            
            $message = "Your new Password Of Parampara App is : $pass";
            $sms_responce = $this->base->send_sms($mobile,$message);

            $this->db->where('mobile',$mobile)->update('vender',array('password'=>$pass));
            
            $ressult['result'] = "Forgot password successfuly";
            $ressult['message'] = 'successfull';
            $ressult['status'] = '1';
            $json = $ressult;
        }
        else
        {
            $ressult['result'] = 'Mobile not exist';
            $ressult['message'] = 'unsuccessfull';
            $ressult['status'] = '0';
            $json = $ressult;
        }

        header('Content-type: application/json');
        echo json_encode($json);
    }
    
    public function assignPoojaPandit()
    {
        $id = $this->input->get_post('id');
        $poojaId = $this->input->get_post('poojaId');
        $panditId = $this->input->get_post('panditId');
        $status = $this->input->get_post('status');
        
        $success="success";
        
        $validate_data = $this->base->validate_data('pujaAssignPandit',$_REQUEST);

        $isExist="";
       if($status=='1'){
        
        $this ->db->where('pujaAssignPandit.poojaId',$poojaId )->where('pujaAssignPandit.panditId',$panditId )->delete('pujaAssignPandit');
        $isExist = $this->db->where('pujaAssignPandit.poojaId',$poojaId)->where('pujaAssignPandit.panditId',$panditId)->get('pujaAssignPandit');

        
         if($isExist->num_rows())
          {
           
            $data = $isExist->result();
            $json['result'] = $data;
            $json['message'] = "Unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product Deleted";
            $json['message'] = "successfully Deleted";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        
        
       }else{
           
        if($id != ''){
             $this->db->where('pujaAssignPandit.id',$id)->update('pujaAssignPandit',$validate_data);
        }else  if($id == '' && $poojaId !='' && $panditId ==''){
          $this->db->select("p.*");
        $isExist= $this->db->join("pandit p","p.user_id=pb.panditId")->where('pb.poojaId',$poojaId)->get('pujaAssignPandit pb');
       
        }else  if($id == '' && $poojaId =='' && $panditId !=''){
             $this->db->select("p.*");
            // $this->db->where('pb.panditId',$poojaId);
         $isExist=     $this->db->join("pooja p","p.pooja_id=pb.poojaId")->where('pb.panditId',$panditId)->get('pujaAssignPandit pb');

        }else{

        // $validate_data = $this->base->validate_data('vender',$_REQUEST);
         
              $isExist = $this->db->where('pujaAssignPandit.poojaId',$poojaId)->where('pujaAssignPandit.panditId',$panditId)->get('pujaAssignPandit');
              if($isExist->num_rows()){
               $success ="Already Exist";
               
              }else{
                   $this->db->insert('pujaAssignPandit',$validate_data);
           $id = $this->db->insert_id();
                         $isExist = $this->db->where('pujaAssignPandit.id',$id)->get('pujaAssignPandit');

              }
         }
         
      /*   
        $this->db->select("*");
       
        if($id == '' && $poojaId !='' && $panditId ==''){
                   $isExist = $this->db->where('pb.panditId', 'p.id')->get('pujaAssignPandit pb');

            //   $isExist = $this->db->where('pujaAssignPandit.poojaId',$poojaId)->get('pujaAssignPandit');
        }else  if($id == '' && $poojaId =='' && $panditId !=''){
              $isExist = $this->db->where('pujaAssignPandit.panditId',$panditId)->get('pujaAssignPandit');
        }else{
            
                          $isExist = $this->db->where('pujaAssignPandit.id',$id)->get('pujaAssignPandit');

        }*/

        if($isExist->num_rows())
        {
           
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = $success;
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "data not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
       }


     
    }
    
    public function get_virtual_service()
    {
        $isExist = $this->db->get('virtual_service');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Virtual Service not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_pooja()
    {
        $isExist = $this->db->where('status','1')->get('pooja');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Pooja not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function paramarsh()
    { 
        //$data = json_decode(file_get_contents("php://input"));
        $validate_data = $this->base->validate_data('paramarsh',$_REQUEST);
        $a=$this->db->insert('paramarsh',$validate_data);
        if($a){
            $status=array("paramars_status"=>0);
            $this->db->where('user_id',$validate_data['user_id']);
            $this->db->update('user',$status);
            
        }
        $pooja_booking_id = $this->db->insert_id();
		$message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You request for a new paramarsh",
                    "message" => 'You request for a new paramarsh',
                    "id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
    }
    
	public function kundali()
    {   
        //$data = json_decode(file_get_contents("php://input"));
        $validate_data = $this->base->validate_data('kundali',$_REQUEST);
        $this->db->insert('kundali',$validate_data);
        $pooja_booking_id = $this->db->insert_id();
		$message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You request for a  kundali",
                    "message" => 'You request for a  kundali',
                    "id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
    }
    
    public function bhavya_ayojan()
    {
        $validate_data = $this->base->validate_data('bhavya_ayojan',$_REQUEST);
        
        $this->db->insert('bhavya_ayojan',$validate_data);
        $pooja_booking_id = $this->db->insert_id();
        $this->db->select("p.*,p.ayojan_name,p.image,p.description");
        $this->db->join("ayojan p","p.ayojan_id=pb.ayojan_id");
        $isExist = $this->db->where('pb.booking_id',$pooja_booking_id)->get('bhavya_ayojan pb');
        if($isExist->num_rows())
        {
            //push_firebase
            $message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You have a new Booking",
                    "message" => 'You have a new Booking',
                    "booking_id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
           // $this->get_range_ayojan_booking($this->input->get_post('longitude'),$this->input->get_post('lattitude'));
            $data = $isExist->row_array();
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Can not be Booked at This Time";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            header('Content-Type: application/json');
            echo json_encode($json);
        }  
    
        
    }
    
     public function dailypandit_booking()
    {
        $validate_data = $this->base->validate_data('dailypandit_booking',$_REQUEST);
        $this->db->insert('dailypandit_booking',$validate_data);
        $pooja_booking_id = $this->db->insert_id();
       // $this->db->select("p.*,p.ayojan_name,p.image,p.description");
       // $this->db->join("ayojan p","p.ayojan_id=pb.ayojan_id");
        $isExist = $this->db->where('booking_id',$pooja_booking_id)->get('dailypandit_booking');
        if($isExist->num_rows())
        {
            //push_firebase
            $message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You have a new Booking",
                    "message" => 'You have a new Booking',
                    "booking_id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
             
           // $this->get_range_ayojan_booking($this->input->get_post('longitude'),$this->input->get_post('lattitude'));
            $data = $isExist->row_array();
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Can not be Booked at This Time";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }

    public function mandal_booked()
    {
        $validate_data = $this->base->validate_data('mandal_booked',$_REQUEST);
        $this->db->insert('mandal_booked',$validate_data);
        $pooja_booking_id = $this->db->insert_id();
        $this->db->select("p.*,p.mandali_name,p.image,p.description");
        $this->db->join("mandal p","p.mandal_id=pb.mandal_id");
        $isExist = $this->db->where('pb.booking_id',$pooja_booking_id)->get('mandal_booked pb');
        if($isExist->num_rows())
        {
            //push_firebase
            $message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You have a new Booking",
                    "message" => 'You have a new Booking',
                    "booking_id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
             
           // $this->get_range_mandal_booking($this->input->get_post('longitude'),$this->input->get_post('lattitude'));
            $data = $isExist->row_array();
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Can not be Booked at This Time";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
	
    public function pooja_booking()
    {
        $validate_data = $this->base->validate_data('pooja_booking',$_REQUEST);
        $this->db->insert('pooja_booking',$validate_data);
        $pooja_booking_id = $this->db->insert_id();
        
        $this->db->select("p.*,p.pooja_name,p.image,p.description");
        $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
        $isExist = $this->db->where('pb.pooja_booking_id',$pooja_booking_id)->get('pooja_booking pb');
        if($isExist->num_rows())
        {
            //push_firebase
            $message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You have a new Booking",
                    "message" => 'You have a new Booking',
                    "pooja_booking_id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
             
            $this->get_range_pooja_booking1($this->input->get_post('longitude'),$this->input->get_post('lattitude'));
            //$registration_ids = array();
        //  $vendors = $this->db->select('register_id')->where("status",'1')->where("approved",'1')->where("type",'VENDOR')->get('user')->result();
        //  foreach($vendors as $r){
        //      $registration_ids[] = $r->register_id;
        //  }
            //$firebase = $this->base->push_firebase($registration_ids, $message);
            // echo "<pre>";print_r(json_decode($firebase));die;
            
            $data = $isExist->row_array();
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
           
        }
        else
        {
            $json['result'] = "Can not be Booked at This Time";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function forword_pooja_booking()
    {
        $pooja_booking_id = $this->input->get_post('pooja_booking_id');
        $vendor_id = $this->input->get_post('vendor_id');
        $status = $this->input->get_post('status');
          $name = $this->input->get_post('forwarded_by_name');
        
        $this->db->select("pb.*,p.pooja_name,p.image,p.description");
        $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
        $isExist = $this->db->where('pb.pooja_booking_id',$pooja_booking_id)->where('pb.accepted_by',$vendor_id)->get('pooja_booking pb');
        if($isExist->num_rows())
        {
            $data = $isExist->row_array();
            
            //push_firebase
            $message = array(
                "message" => array(
                    "result" => "successful",
                    "key" => "You have a new Booking",
                    "message" => 'You have a new Booking',
                    "pooja_booking_id" => $pooja_booking_id,
                    "date" => date('Y-m-d h:i:s')
                )
            );
            $registration_ids = array();
        //  $vendors = $this->db->select('register_id')->where("user_id !=",$vendor_id)->where("status",'1')->where("approved",'1')->where("type",'VENDOR')->get('user')->result();
        //  foreach($vendors as $r){
        //      $registration_ids[] = $r->register_id;
        //  }
        //     $firebase = $this->base->push_firebase($registration_ids, $message);
            // echo "<pre>";print_r($firebase);die;
            
            //update forward
            $this->db->where('pooja_booking_id',$pooja_booking_id)->update('pooja_booking',array('accepted_by'=> 0,'status'=>$status,'forwarded_by'=>$vendor_id,'forwarded_by_name'=>$name,'accepted_by_name'=> 0));
            $data['forwarded_by'] = $vendor_id;
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "You can not Forward This Booking.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function verify_pending_pooja_booking()
    {
        $pooja_booking_id = $this->input->get_post('pooja_booking_id');
        
        $this->db->where(" (pb.accepted_by = 0 OR pb.forwarded_by > 0) ");//new request or a forwarding request
        
        $this->db->select("pb.*,p.pooja_name,p.image,p.description");
        $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
        $isPending = $this->db->where('pb.pooja_booking_id',$pooja_booking_id)->get('pooja_booking pb');
        if($isPending->num_rows())
        {
            $data = $isPending->row_array();
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "This Pooja is already Accepted by Some One.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function accept_pooja_booking()
    {
        $pooja_booking_id = $this->input->get_post('pooja_booking_id');
        $user_id = $this->input->get_post('user_id');
        $status = $this->input->get_post('status');
        $name = $this->input->get_post('accepted_by_name');
        
        $isValid = $this->db->where("status",'1')->where("approved",'1')->where("user_id", $user_id)->get('pandit');
        
        if($isValid->num_rows())
        {
            $this->db->where(" (pb.accepted_by = 0 OR pb.forwarded_by > 0) ");//new request or a forwarding request
            
            $this->db->select("pb.*,p.pooja_name,p.image,p.description");
            $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
            $isPending = $this->db->where('pb.pooja_booking_id',$pooja_booking_id)->get('pooja_booking pb');
            
        
            if($isPending->num_rows())
            {
                
                
                $this->db->where('pooja_booking_id',$pooja_booking_id)->update('pooja_booking', array('accepted_by'=> $user_id,'panditId'=> $user_id, 'status'=>$status,'forwarded_by'=>0,'accepted_by_name'=>$name,'forwarded_by_name'=>null));
                $data = $isPending->row_array();
                $data['accepted_by'] = $user_id;
                
                $json['result'] = $data;
                $json['message'] = "success";
                $json['status'] = 1;
                $userData = $this->db->select("*")->where('user_id',$data['user_id'])->get('user')->row();
                
                $registration_data['status'] =$status;
                $registration_data['title'] = "Pooja Request accepted";
                $registration_data['body'] = $name." is accept your pooja Request";
                $registration_data['Type'] = "pooja";
                $registration_data['Activity'] = "com.ambitious.parampara.Activity.MyPooja_Booking";
                $registration_data['Image'] = "null";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
                
                
                header('Content-Type: application/json');
                echo json_encode($json);
            }
            else
            {
                $json['result'] = "This Pooja is already Accepted by Some One.";
                $json['message'] = "unsuccess";
                $json['status'] = 0;
                
                header('Content-Type: application/json');
                echo json_encode($json);
            }
        }
        else
        {
            $json['result'] = "You can not Accept This Booking.";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function change_pooja_booking_status()
    {
        $pooja_booking_id = $this->input->get_post('pooja_booking_id');
        $status = $this->input->get_post('status');
        
        $this->db->select("pb.*,p.pooja_name,p.image,p.description");
        $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
        $isValid = $this->db->where('pb.pooja_booking_id',$pooja_booking_id)->get('pooja_booking pb');
      //  $isValid = $this->db->like('pb.pooja_booking_id',$pooja_booking_id)->get('pooja_booking pb');
        if($isValid->num_rows())
        {
            $this->db->where('pooja_booking_id',$pooja_booking_id)->update('pooja_booking', array('status'=> $status));
            $data = $isValid->row_array();
            
            $data['status'] = $status;
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
                $userData = $this->db->select("*")->where('user_id',$data['user_id'])->get('user')->row();
                
                $registration_data['status'] =$status;
                $registration_data['title'] = "Pooja Request ".$status;
                $registration_data['body'] = $data['accepted_by_name']." is ".$status." your pooja Request";
                $registration_data['Type'] = "pooja";
                $registration_data['ppoja_id'] = $pooja_booking_id;
               
                $registration_data['Image'] = "null";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                if($status!= 'Canceled By User'){
                    $registration_data['Activity'] = "com.ambitious.parampara.Activity.MyPooja_Booking";
                    $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
                }else{
                    $registration_data['Activity'] = "null";
                    $pandit = $this->db->select("*")->where('user_id',$data['panditId'])->get('pandit')->row();
                    $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$pandit->mobile); 
                }
                
                
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Pooja Not Found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        
    }
    
    public function get_pooja_booking()
    { 
        /////////////////////////////
        $type= $this->input->get_post('type');
    if($type==1){
    ///////////////////////////////
        $user_id = $this->input->get_post('user_id');
        $vendor_id = $this->input->get_post('vendor_id');
        $pooja_booking_id = $this->input->get_post('pooja_booking_id');
        $status = $this->input->get_post('status');
        
        if($user_id != ''){
            $this->db->where('pb.user_id',$user_id);
        }
        if($vendor_id != ''){
            $this->db->where('pb.accepted_by',$vendor_id);
        }
        if($status != ''){
            $this->db->like('pb.status',$status);
        }
        if($pooja_booking_id != ''){
            $this->db->where('pb.pooja_booking_id',$pooja_booking_id);
        }
        
        
         if($status=="pending"){
             $this->db->select("pb.*,p.pooja_name,p.image,p.description");
            //$this->db->join("pandit pandit","pandit.user_id=pb.panditId");
            //$this->db->select("pb.*,p.pooja_name,p.image,p.description,pandit.*");
            $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
            //$this->db->join("pandit pandit","pandit.user_id=pb.panditId");
        }else{
            $this->db->select("pb.*,u.image as userImg , p.pooja_name,p.image,p.description,pandit.avg_rating,pandit.image as pandit_image,pandit.username as panditName,pandit.experience as experience");
            // $this->db->join("pandit pandit","pandit.user_id=pb.panditId,pandit.*");
           // $this->db->select("pb.*,p.pooja_name,p.image,p.description,pandit.*");
            $this->db->join("pooja p","p.pooja_id=pb.pooja_id");
            $this->db->join("user u","u.user_id=pb.user_id");
            $this->db->join("pandit pandit","pandit.user_id=pb.panditId");
        }
        $this->db->order_by("pb.pooja_booking_id", "desc");
        $isValid = $this->db->get('pooja_booking pb');
        if($isValid->num_rows())
        {
            $data = $isValid->result();
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Any Booking Not Found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        ////////////////////////
    }else if($type==2){
         $user_id = $this->input->get_post('user_id');
        $vendor_id = $this->input->get_post('vendor_id');
        $pooja_booking_id = $this->input->get_post('booking_id');
        $status = $this->input->get_post('status');
        
        if($user_id != ''){
            $this->db->where('pb.user_id',$user_id);
        }
        if($vendor_id != ''){
            $this->db->where('pb.accepted_by',$vendor_id);
        }
        if($status != ''){
            $this->db->like('pb.status',$status);
        }
        if($pooja_booking_id != ''){
            $this->db->where('pb.booking_id',$pooja_booking_id);
        }
        
        
       if($status=="pending"){
             $this->db->select("pb.*,p.ayojan_name,p.image,p.description");
            $this->db->join("ayojan p","p.ayojan_id=pb.ayojan_id");
        }else{
            $this->db->select("pb.*,u.image as userImg , p.ayojan_name,p.image,p.description,pandit.avg_rating,pandit.image as pandit_image,pandit.username as panditName");
             $this->db->join("ayojan p","p.ayojan_id=pb.ayojan_id");
            $this->db->join("user u","u.user_id=pb.user_id");
            $this->db->join("pandit pandit","pandit.user_id=pb.panditId");
        }
        $this->db->order_by("pb.booking_id", "desc");
        $isValid = $this->db->get('bhavya_ayojan pb');
        if($isValid->num_rows())
        {
            $data = $isValid->result();
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            $json['type'] = 'ayojan';
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Any Ayojan Booking Not Found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            $json['type'] = 'ayojan';
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }else if($type==3){
         $user_id = $this->input->get_post('user_id');
        $vendor_id = $this->input->get_post('vendor_id');
        $pooja_booking_id = $this->input->get_post('booking_id');
        $status = $this->input->get_post('status');
        
        if($user_id != ''){
            $this->db->where('pb.user_id',$user_id);
        }
        if($vendor_id != ''){
            $this->db->where('pb.accepted_by',$vendor_id);
        }
        if($status != ''){
            $this->db->like('pb.status',$status);
        }
        if($pooja_booking_id != ''){
            $this->db->where('pb.booking_id',$pooja_booking_id);
        }
        
        
         if($status=="pending"){
             $this->db->select("pb.*,p.mandali_name,p.image,p.description");
            $this->db->join("mandal p","p.mandal_id=pb.mandal_id");
        }else{
            $this->db->select("pb.*,u.image as userImg , p.mandali_name,p.image,p.description,pandit.avg_rating,pandit.image as pandit_image,pandit.username as panditName");
            // $this->db->join("pandit pandit","pandit.user_id=pb.panditId,pandit.*");
           // $this->db->select("pb.*,p.pooja_name,p.image,p.description,pandit.*");
            $this->db->join("mandal p","p.mandal_id=pb.mandal_id");
            $this->db->join("user u","u.user_id=pb.user_id");
            $this->db->join("pandit pandit","pandit.user_id=pb.panditId");
        }
        $this->db->order_by("pb.booking_id", "desc");
        $isValid = $this->db->get('mandal_booked pb');
        if($isValid->num_rows())
        {
            $data = $isValid->result();
            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            $json['type'] = 'mandal';
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Any MandalBooking Not Found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            $json['type'] = 'mandal';
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
        
        
        
        
        
    }
    
    public function get_category()
    {
        $isExist = $this->db->where('status','1')->get('category');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Category not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_office_dailypandit()
    {
        $isExist = $this->db->where('subscription_for','office')->get('dailypandit_subscription');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Daily Pandit not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_home_dailypandit()
    {
        $isExist = $this->db->where('subscription_for','home')->get('dailypandit_subscription');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Daily Pandit not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
	public function get_mandal()
    {
        $isExist = $this->db->where('status','1')->get('mandal');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Bhajan Mandal not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    /*public function get_common_booking()
    {
         $user_id = 64;
        $type =2;
        $status = "completed";
                    $this->db->where('user_id',$user_id);
                    $this->db->where('type',$type);
                    $this->db->where('status',$status);
        $isExist = $this->db->get('common_booking');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "booking not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }*/
    
    public function get_terms()
    {
        $isExist = $this->db->get('terms');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Terms not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_privacy_policy()
    {
        $isExist = $this->db->get('privacy_policy');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Privacy Policy not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
	public function get_ayojan()
    {
        $isExist = $this->db->where('status','1')->get('ayojan');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Bhavya Ayojan not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    public function get_ayojan_booking()
    {
        $user_id = $this->input->get_post('user_id');
        $isValid = $this->db->where('user_id',$user_id)->get('bhavya_ayojan');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No any your Request for ayojan";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    public function assign_ayojan_booking()
    {
        $user_id = $this->input->get_post('panditId');
        $isValid = $this->db->where('panditId',$user_id)->where('status',"accepted")->get('bhavya_ayojan');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No any your Request for ayojan";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function assign_mandal_booking()
    {
        $user_id = $this->input->get_post('panditId');
        $isValid = $this->db->where('panditId',$user_id)->where('status',"accepted")->get('mandal_booked');
       
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No any your Request for Mandal";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    public function get_mandal_booking()
    {
        $user_id = $this->input->get_post('user_id');
        $isValid = $this->db->where('user_id',$user_id)->get('mandal_booked');
        if($isValid->num_rows())
        {
            $json['result'] = $isValid->result_array();
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "No any your Request for Mandal";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
   /* public function get_ayojan_booking()
    {
        $isExist = $this->db->get('bhavya_ayojan');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Bhavya Ayojan Bookings not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    public function get_mandal_booking()
    {
        $isExist = $this->db->get('mandal_booked');
        if($isExist->num_rows())
        {
            $data = $isExist->result();
            

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Mandal Booked Bookings not found";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }*/
    
    public function get_product()
    {
        $category_id = $this->input->get_post('category_id');
        $vendorId = $this->input->get_post('vendorId');
        if($category_id != ''){
            $this->db->where('p.category_id',$category_id)->where('p.qty >', '0');
        }
        
        if($vendorId != ''){
            $this->db->where('p.vendorId',$vendorId);
        }
        
        $this->db->select("p.*,c.category_name,v.shopName");
        $this->db->join('category c',"c.category_id=p.category_id","LEFT");
        $this->db->join('vender v',"v.id=p.vendorId","LEFT");
        $isExist = $this->db->where('p.status','1')->get('product p');

        if($isExist->num_rows())
        {
            $data = $isExist->result();

        

            // $data['image'] = base_url($data['image']);

            
            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }

    public function add_product()
    {
         $id = $this->input->get_post('id');
         $user_id="";
      

        if($_FILES['image']['name'])
        {
            $image = "uploads/product/".rand(0000,9999).basename($_FILES["image"]["name"]);
            if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
            {
                $_REQUEST['image'] = $image;
            }
        }
        $validate_data = $this->base->validate_data('product',$_REQUEST);
        if($id != ''){
             $user_id=$id;
             $this->db->where('product.product_id',$id)->update('product',$validate_data);
            // $this->db->where('product.product_id',$id);
        }else{

        // $validate_data = $this->base->validate_data('vender',$_REQUEST);
        $this->db->insert('product',$validate_data);
        $user_id = $this->db->insert_id();

         }
        
        $this->db->select("*");
        $isExist = $this->db->where('product.product_id',$user_id)->get('product');
        if($isExist->num_rows())
        {
           
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
   

    public function add_Stock()
    {
        $validate_data = $this->base->validate_data('userSelectedProduct',$_REQUEST);
        $this->db->insert('userSelectedProduct',$validate_data);
        $user_id = $this->db->insert_id();

        
        $this->db->select("*");
        $isExist = $this->db->where('userSelectedProduct.id',$user_id)->get('userSelectedProduct');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
    
    
    public function add_PoojaRating()
    {
        $id = $this->input->get_post('id');
        $rating = $this->input->get_post('rating');
        $feedBack = $this->input->get_post('feedBack');
        $panditId = $this->input->get_post('panditId');
        $type = $this->input->get_post('type');
        $isExist;
         if($type=='user'){
                $this->getAvgPanditRating($rating,$panditId);
              $isExist = $this->db->where('pooja_booking_id',$id)->update('pooja_booking',array('user_rating'=> $rating,'user_feedback'=> $feedBack));
         }else{
             $isExist = $this->db->where('pooja_booking_id',$id)->update('pooja_booking',array('pandit_rating'=> $rating,'pandit_feedback'=> $feedBack));
         }
        
      
        if($isExist)
        {
           
            $json['message'] = "success";
            $json['status'] = 200;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }

   public function add_OrderRating()
    {
        $id = $this->input->get_post('id');
        $rating = $this->input->get_post('rating');
        $feedBack = $this->input->get_post('feedBack');
        $produtId = $this->input->get_post('produtId');
        $type = $this->input->get_post('type');
        $isExist;
         if($type=='user'){
                $this->setAvgPorductRating($rating,$produtId);
                $isExist = $this->db->where('id',$id)->update('orders',array('user_rating'=> $rating,'user_feedback'=> $feedBack));
         }else{
             $isExist = $this->db->where('id',$id)->update('orders',array('vender_rating'=> $rating,'vendor_feedback'=> $feedBack));
         }
        
      
        if($isExist)
        {
           
            $json['message'] = "success";
            $json['status'] = 200;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }

    public function get_Stock()
    {
      
        $userId = $this->input->get_post('userId');
        if($userId != ''){
            $this->db->where('p.userId',$userId);
        }
        
        $this->db->select("p.*,prod.name,prod.description,prod.image,c.category_name");
        $this->db->join('product prod',"prod.product_id=p.productId","LEFT");
        $this->db->join('category c',"c.category_id=prod.category_id","LEFT");
        $isExist = $this->db->where('p.userId',$userId)->get('userSelectedProduct p');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
     public function get_ProductStock()
    {
      $category_id = $this->input->get_post('category_id');
       

        $this->db->select("p.*,prod.name,prod.description,prod.image,c.category_name,c.category_id");
        $this->db->join('product prod',"prod.product_id=p.productId","LEFT");
        $this->db->join('category c',"c.category_id=prod.category_id","LEFT");
         if($category_id != ''){
            $this->db->where('c.category_id',$category_id);
        }
        $isExist = $this->db->where('p.productQuanitiy >',0)->get('userSelectedProduct p');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
    
     public function get_order()
    {
        $status = $this->input->get_post('status');
        $userId = $this->input->get_post('userId');
        $venderId = $this->input->get_post('venderId');
       if($userId != ''){
            $this->db->where('o.user_id',$userId);
        }
        if($venderId != ''){
            $this->db->where('o.vendorId',$venderId);
        }
        
        if($status != ''){
            $this->db->where('o.status',$status);
        }

        $this->db->select("o.*,u.image as userImg,prod.name,prod.description,prod.image,c.category_name,v.shopName,v.name as vendor_name,v.image as vender_image");
        $this->db->join('product prod',"prod.product_id=o.product_id","LEFT");
        $this->db->join('category c',"c.category_id=prod.category_id","LEFT");
        $this->db->join('vender v',"v.id=o.vendorId","LEFT");
        $this->db->join('user u',"u.user_id=o.user_id","LEFT");
        $this->db->order_by("o.id", "desc");
        $isExist = $this->db->get('orders o');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
      public function add_order()
    {
        $validate_data = $this->base->validate_data('orders',$_REQUEST);
        
        $this->db->insert('orders',$validate_data);
        $user_id = $this->db->insert_id();
       // $this->input->get_post('quantity')." ".$this->input->get_post('product_name') ." ".$this->input->get_post('category_name').""
      // $qty = $this->db->where('product_id',$validate_data['product_id'])->get('product')->row()->qty;
      // print_r($qty-$validate_data['quantity']);exit();
       
       
       ////////////////////////
        $vendorId = $this->input->get_post('vendorId');
        // echo "id :: ".$vendorId;
        $data = $this->db->select("*")->where('id',$vendorId)->get('vender')->row();
        $registration_data = array();
        $registration_data['status'] ="2";
        $registration_data['title'] = "New Order Recived";
        $registration_data['body'] ="".$this->input->get_post('quantity')." ".$this->input->get_post('product_name') ." ( ".$this->input->get_post('category_name').")";
        $registration_data['Type'] = "Vender";
        $registration_data['Activity'] = "null";
        $registration_data['Image'] = "null";
        
        //echo "        topic :: ".'vendor-'.$data->contact;
        $registration_data1 = array();
        $registration_data1['data'] = json_encode($registration_data);
        $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'vendor-'.$data->contact); 
        
        $this->db->select("*");
        $isExist = $this->db->where('orders.id',$user_id)->get('orders');
        if($isExist->num_rows())
        {
            $data = $isExist->result();

            $json['result'] = $data;
            $json['message'] = "success";
            $json['status'] = 1;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        else
        {
            $json['result'] = "Product not Available";
            $json['message'] = "unsuccess";
            $json['status'] = 0;
            
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
    
    
    
      public function change_order_status()
    {
      
        $status = $this->input->get_post('status');
        $orderId = $this->input->get_post('orderId');
        $qty = $this->input->get_post('qty');
        $productId = $this->input->get_post('productId');
        $registration_data = array();
        $registration_data['status'] =$status;
         
        
        $this->db->select("*");
        $data = $this->db->where('product.product_id',$productId)->get('product')->row();
        $orderData = $this->db->select("*")->where('id',$orderId)->get('orders')->row();
        $userData = $this->db->select("*")->where('user_id',$orderData->user_id)->get('user')->row();
        $registration_data['body'] = $data->qty." ".$data->name ." (".$data->category_name.")" ;
        $registration_data['Activity'] = "com.ambitious.parampara.Activity.MyOrders_items";
        $registration_data['Image'] = "null";
        
        if($status=='1'){
        $registration_data['title'] = "Accept your order";
        $registration_data['Type'] = "User";
        $registration_data1 = array();
        $registration_data1['data'] = json_encode($registration_data);
         
        $tempQty = $data->qty;
         if($tempQty>=$qty){
             $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile);
             $data1=$tempQty-$qty;
             $res = $this->db->where('product.product_id',$productId)->update('product', array('qty'=> $data1));
             $isExist = $this->db->where('orders.id',$orderId)->update('orders',array('status'=> $status));
             
         if($isExist)
            {
                //$data = $isExist->result();

                $json['result'] = $data;
                $json['message'] = "success";
                $json['message1'] = "". $tempQty;
                 $json['message2'] = "".$userData->mobile;
                $json['status'] = 1;
            
                header('Content-Type: application/json');
                echo json_encode($json);
            }
        else
            {
                $json['result'] = "database error";
                $json['message'] = "unsuccess";
                $json['status'] = 0;
            
                header('Content-Type: application/json');
                echo json_encode($json);
            }
             
         }else{
              $json['result'] = "product not Available";
                $json['message'] = "unsuccess";
                $json['status'] = $data;
            
                header('Content-Type: application/json');
                echo json_encode($json);
         }
         
        }else{
             $isExist = $this->db->where('orders.id',$orderId)->update('orders',array('status'=> $status));
             
             if($status=='2'){
                $registration_data['title'] = "Your order is Packed";
                $registration_data['Type'] = "User";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
             }else if($status=='3'){
                $registration_data['title'] = "Your order is deliver";
                $registration_data['Type'] = "User";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
            }else if($status=='4'){
                $registration_data['title'] = "Wow !! , Complete your order";
                $registration_data['Type'] = "User";
                 $registration_data['order_id'] = $orderId;
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
            }else if($status=='5'){
                $registration_data['title'] = "Sorry!! , Your order cancel by user";
                $registration_data['Type'] = "vendor";
                $registration_data['Activity'] = "null";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'vendor-'.$this->db->select("*")->where('id',$orderData->vendorId)->get('vender')->row()->contact); 
             }else if($status=='6'){
                $registration_data['title'] = "Sorry!! , Your order cancel by store";
                $registration_data['Type'] = "User";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
             }
             else if($status=='7'){
                $registration_data['title'] = "Sorry!! ,Your order is cancel";
                $registration_data['Type'] = "User";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
             }else if($status=='8'){
                $registration_data['title'] = "Sorry!! , Your order not accept  by store";
                $registration_data['Type'] = "User";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'user-'.$userData->mobile); 
             }
                
            if($isExist)
            {
                //$data = $isExist->result();

                $json['result'] = $data;
                $json['message'] = "success";
                $json['status'] = 1;
            
                header('Content-Type: application/json');
                echo json_encode($json);
            }
        else
            {
                $json['result'] = "database error";
                $json['message'] = "unsuccess";
                $json['status'] = 0;
            
                header('Content-Type: application/json');
                echo json_encode($json);
            }
             
        }
        
        
        
    }
    
    public function get_range_pooja_booking()
    {
        $longi = $this->input->get_post('longi');
        $lati = $this->input->get_post('lati');
        $final = array();
        $poojaBookingData = $this->db->select('*')->where('panditId','0')->where('status','pending')->where('lattitude!=','')->where('longitude!=','')->order_by("po.pooja_booking_id", "desc")->get('pooja_booking po');
        $range = $this->db->select('*')->where('id','1')->get('range_limits')->row()->distance_range;
        foreach($poojaBookingData->result_array() as $data)
        { $distance = $this->getDistance($lati, $longi,$data['lattitude'],$data['longitude']);
            //echo  $range."  Dis : ".$distance;
            if($range>$distance){
                 //$final=$data;
                 array_push($final,$data);
            }
            
        }
            $json['result'] = $final;
            $json['message'] = "success";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
    }
    
     public function check_available_time()
    {
        $date = $this->input->get_post('date');
         $time = $this->input->get_post('time');
       $current = date('d-m-Y H:i:s');
        $req_time = date('d-m-Y H:i:s', strtotime("$date $time"));
    $d= date('d-m-Y H:i:s', strtotime('+1 day', strtotime($current)));
 if($req_time >$d ){ 
            $json['message'] = "This Time is Available";
            $json['status'] = 1;
            header('Content-Type: application/json');
            echo json_encode($json);
 }else{
            $json['message'] = "This Time is not Available";
            $json['status'] = 0;
            header('Content-Type: application/json');
            echo json_encode($json);
 }
         
    }
    
    
    public function get_range_pooja_booking1($longi2,$lati2)
    {
        // $longi = $this->input->get_post('longi');
       // $lati = $this->input->get_post('lati');
        $longi =$longi2;
        $lati = $lati2;
        $final = array();
        $poojaBookingData = $this->db->select('*')->where('approved','1')->where('lattitude!=','')->where('logitude!=','')->get('pandit po');
    
        $range = $this->db->select('*')->where('id','1')->get('range_limits')->row()->distance_range;
    
        foreach($poojaBookingData->result_array() as $data)
        {
              
            $distance = $this->getDistance($lati, $longi,$data['lattitude'],$data['logitude']);
        
           
            if($range>$distance){
                
                 //$final=$data;
                $registration_data['status'] ='pending';
                $registration_data['body'] = "New Pooja Request" ;
                $registration_data['Activity'] = "null";
                $registration_data['Image'] = "null";
                $registration_data['title'] = "New Pooja Request";
                $registration_data['Type'] = "Pandit";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$data['mobile']); 
                 
            }
            
            
        }
       
        
    }
    
     public function confrm_range_pandit()
    {
         $longi = $this->input->get_post('longi');
        $lati = $this->input->get_post('lati');
        $poojaBookingData = $this->db->select('*')->where('approved','1')->where('lattitude!=','')->where('logitude!=','')->get('pandit po');
    
        $range = $this->db->select('*')->where('id','1')->get('range_limits')->row()->distance_range;
  
        foreach($poojaBookingData->result_array() as $data)
        {
              
            $distance = $this->getDistance($lati, $longi,$data['lattitude'],$data['logitude']);
            
          
            
        }
       if($range>$distance){
            
                  $json['message'] = " Pandit is available ";
                    $json['status'] = 1;
                    header('Content-Type: application/json');
                    echo json_encode($json);
            }else{
                $json['message'] = "No any Pandit is available at this area";
                $json['status'] = 0;
                header('Content-Type: application/json');
                echo json_encode($json);
            }
        
    }
    
    public function get_range_mandal_booking($longi2,$lati2)
    {
        $longi =$longi2;
        $lati = $lati2;
        $final = array();
        $poojaBookingData = $this->db->select('*')->where('approved','1')->where('lattitude!=','')->where('logitude!=','')->get('pandit po');
    
        $range = $this->db->select('*')->where('id','1')->get('range_limits')->row()->distance_range;
    
        foreach($poojaBookingData->result_array() as $data)
        {
              
            $distance = $this->getDistance($lati, $longi,$data['lattitude'],$data['logitude']);
        
           
            if($range>$distance){
                
                 //$final=$data;
                $registration_data['status'] ='pending';
                $registration_data['body'] = "New Mandal Request" ;
                $registration_data['Activity'] = "null";
                $registration_data['Image'] = "null";
                $registration_data['title'] = "New Mandal Request";
                $registration_data['Type'] = "Pandit";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$data['mobile']); 
                 
            }
            
            
        }
       
        
    }
    public function get_range_ayojan_booking($longi2,$lati2)
    {
        $longi =$longi2;
        $lati = $lati2;
        $final = array();
        $poojaBookingData = $this->db->select('*')->where('approved','1')->where('lattitude!=','')->where('logitude!=','')->get('pandit po');
    
        $range = $this->db->select('*')->where('id','1')->get('range_limits')->row()->distance_range;
    
        foreach($poojaBookingData->result_array() as $data)
        {
              
            $distance = $this->getDistance($lati, $longi,$data['lattitude'],$data['logitude']);
        
           
            if($range>$distance){
                
                 //$final=$data;
                $registration_data['status'] ='pending';
                $registration_data['body'] = "New Ayojan Request" ;
                $registration_data['Activity'] = "null";
                $registration_data['Image'] = "null";
                $registration_data['title'] = "New Ayojan Request";
                $registration_data['Type'] = "Pandit";
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
                $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$data['mobile']); 
                 
            }
            
            
        }
       
        
    }
    
    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {  
        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);  
        $dLon = deg2rad($longitude2 - $longitude1);  

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
        $c = 2 * asin(sqrt($a));  
        $d = $earth_radius * $c;  

        return $d;  
    }
    
    public function test(){
        $distance = $this->getDistance(25.453176, 81.778107, 26.247401, 80.465576);
        if ($distance < 100) {
            echo "Within 100 kilometer radius";
        } else {
            echo "Outside 100 kilometer radius";
        }
    }
    
    public function panditDashboard(){
         $pandit_id =$this->input->get_post('pandit_id');
        
        $final = array();
        $data=$this->db->select_sum('price')->from('pooja_booking')->where('status', 'completed')->where('panditId', $pandit_id)->get()->result_array();
        $data1=$this->db->select_sum('amount')->from('mandal_booked')->where('status', 'completed')->where('panditId', $pandit_id)->get()->result_array();
        $data2=$this->db->select_sum('amount')->from('bhavya_ayojan')->where('status', 'completed')->where('panditId', $pandit_id)->get()->result_array();
        
        $final['totalearning']=$data[0]['price']+$data1[0]['price']+$data2[0]['price'];
       // $final['totalearning']=$data[0]['price']+100+200;
        //$final['totalearning'] =$this->db->select('COUNT(id) as total')->from('orders');
        $final['totalbooking'] = $this->db->where('panditId', $pandit_id)->count_all_results('pooja_booking');
        $final['accepted_booking'] = $this->db->where('status', 'accepted')->where('panditId', $pandit_id)->count_all_results('pooja_booking');
        $final['complete_booking'] = $this->db->where('status', 'completed')->where('panditId', $pandit_id)->count_all_results('pooja_booking');
       // print_r($final['complete_booking']);exit();
       // $final['pendig_booking']=$this->db->select('COUNT(id) as total')->where('status','1')->or_where('status','2')->or_where('status','3')->where('vendorId',$vendorId)->from('orders')->num_rows();
        //$final['complete_order']=$this->db->select('COUNT(id) as total')->where('status','4')->where('vendorId',$vendorId)->from('orders')->num_rows();
        
        $json['result'] = $final;
        $json['message'] = "success";
        $json['status'] = 1;
        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
    public function vendorDashboard(){
        $vendorId =$this->input->get_post('vender_id');
        $final = array();
        $data=$this->db->select_sum('amount')->from('orders')->where('status', '4')->where('vendorId', $vendorId)->get()->result_array();
        
        $final['totalearning']=$data[0]['amount'];
        //$final['totalearning'] =$this->db->select('COUNT(id) as total')->from('orders');
        $final['neworders'] =$this->db->where('status', '0')->where('vendorId', $vendorId)->count_all_results('orders');
        $final['pendig_booking'] =$this->db->where('status', '1')->where('vendorId', $vendorId)->or_where('status','2')->or_where('status','3')->count_all_results('orders');
        $final['complete_order'] =$this->db->where('status', '4')->where('vendorId', $vendorId)->count_all_results('orders');
       // $final['pendig_booking']=$this->db->select('COUNT(id) as total')->where('status','1')->or_where('status','2')->or_where('status','3')->where('vendorId',$vendorId)->from('orders')->num_rows();
        //$final['complete_order']=$this->db->select('COUNT(id) as total')->where('status','4')->where('vendorId',$vendorId)->from('orders')->num_rows();
        
        $json['result'] = $final;
        $json['message'] = "success";
        $json['status'] = 1;
            
        header('Content-Type: application/json');
        echo json_encode($json);
      
    }
    
    public function getAvgPanditRating($rate,$panditId){
        
        $data=$this->db->select_sum('user_rating')->from('pooja_booking')->where('panditId', $panditId)->get()->result_array();
        $totalCount = $this->db->where('status', 'completed')->where('panditId', $panditId)->count_all_results('pooja_booking');
        $avg=($rate+$data[0]['user_rating'])/(5*($totalCount+1));
        $isExist = $this->db->where('user_id',$panditId)->update('pandit',array('avg_rating'=> $avg));
        
        
    }
    
    public function setAvgPorductRating($rate,$productId){
    
        $data=$this->db->select_sum('user_rating')->from('orders')->where('product_id', $productId)->get()->result_array();
        $totalCount = $this->db->where('status', '4')->where('product_id', $productId)->count_all_results('orders');
        $avg=($rate+$data[0]['user_rating'])/(5*($totalCount+1));
        $isExist = $this->db->where('product_id',$productId)->update('product',array('avg_rating'=> $avg));
        
        
    }
    
}   
?>