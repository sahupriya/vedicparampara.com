<?php
date_default_timezone_set('Asia/Calcutta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Site extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('base');
        $this->load->model('Notification');
		$this->load->database();
		$this->controller = "site/";
		$this->load->library('session');
		$this->load->library('excel');
        ini_set('memory_limit', '-1');
        error_reporting(0);
	}
	
	
    public function index()
    {
        if($this->session->userdata('username'))
        {
            redirect($this->controller.'dashboard');
        }
        $this->load->view('index');
    }
    
    public function login_submit()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $oldURL = $this->session->userdata('old_url');
        $isAdmin = $this->db->where('username',$username)->where('password',$password)->get('admin');
        if($isAdmin->num_rows() > 0)
        {
            $auth = $isAdmin->row_array();
            $this->session->set_userdata('auth_type','admin');
            $this->session->set_userdata('auth_id',$auth['admin_id']);
            $this->session->set_userdata('auth_name',$auth['admin_name']);
            $this->session->set_userdata('auth_image',base_url('img/company/logo.png'));
            $this->session->set_userdata('username',$username);
            $this->session->set_userdata('company',"PARAMPARA");
            $this->session->set_userdata('company_code',"PARAMPARA");
            
            if($oldURL != ''){
                $this->session->unset_userdata('old_url');
                echo "<script>window.location.href='$oldURL';</script>";
            }else{
                redirect($this->controller."dashboard");
            }
        }
        else
        {
            $url = site_url();
            echo "<script>alert('Username and Pasword Does Not Match'); window.location.href='$url'</script>";
        }
    }
    
    public function logout()
    {
        session_destroy();
        redirect($this->controller."index");
    }
    public function expire_request(){
        $pending_poojaBooking=$this->db->select('*')->join('user','user.user_id=pooja_booking.user_id')->where('TIMESTAMPDIFF(HOUR,pooja_booking.entrydt,NOW()) > 6')->where('pooja_booking.status','pending')->get('pooja_booking')->result_array();
        $registration_data = array(
                                            'status'=>'Expired',
                                            'title'=>'Booking Cancelled.',
                                            'body'=>'Your booking has been Cancelled as no pandit was available.',
                                            'Type'=>'pandit',
                                            'Activity'=>'null',
                                            'Image'=>'null'
                                    );
        foreach ($pending_poojaBooking as $pendingRequest) {  
            echo 'Pooja booking '.$pendingRequest['pooja_booking_id'].' '.$pendingRequest['mobile'].'<br>';
            $this->db->where('pooja_booking_id',$pendingRequest['pooja_booking_id'])->update('pooja_booking',array('status'=>'Canceled'));
            $this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), 'pandit-'.$pendingRequest['mobile']);
        }

        $pending_order=$this->db->select('*')->join('user','user.user_id=orders.user_id')->where('TIMESTAMPDIFF(HOUR,orders.entry_date,NOW()) > 6')->where('orders.status','0')->get('orders')->result_array();
        unset($registration_data);
        $registration_data = array(
                                            'status'=>'2',
                                            'title'=>'Order Cancelled.',
                                            'body'=>'Your order has been Cancelled as product was not available.',
                                            'Type'=>'vendor',
                                            'Activity'=>'null',
                                            'Image'=>'null'
                                    );
        foreach ($pending_order as $pendingRequest) {  
            echo 'Order booking '.$pendingRequest['id'].' '.$pendingRequest['mobile'].'<br>';
            $this->db->where('id',$pendingRequest['id'])->update('orders',array('status'=>'Canceled'));
            $this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), 'vendor-'.$pendingRequest['mobile']);
        }

    }
    public function globalAlertFormAction(){
        if (isset($_POST)) {
            $registration_data = array(
                                            'status'=>'2',
                                            'title'=>$_POST['heading'],
                                            'body'=>$_POST['message'],
                                            'Type'=>$_POST['userType'],
                                            'Activity'=>'null',
                                            'Image'=>'null'
                                    );
            $data=array();
            switch ($_POST['userType']) {
                case 'userAll':
                    $userNo=$this->db->select('mobile')->where('status','1')->get('user')->result_array();
                    foreach ($userNo as $user) {
                        $this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), 'user-'.$user['mobile']);
                    }
                    $data['status']=TRUE;
                    $data['html']="User alert sent successfully";
                    break;
                case 'panditAll':
                    $userNo=$this->db->select('mobile')->where('status','1')->get('pandit')->result_array();
                    foreach ($userNo as $user) {
                        $this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), 'pandit-'.$user['mobile']);
                    }
                    $data['status']=TRUE;
                    $data['html']="Pandit alert sent successfully";
                    break;
                case 'vendAll':
                    $userNo=$this->db->select('contact')->where('isActive','2')->get('vender')->result_array();
                    foreach ($userNo as $user) {
                        $this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), 'vendor-'.$user['contact']);
                    }
                    $data['status']=TRUE;
                    $data['html']="Vendor alert sent successfully";
                    break;
                default:
                    $data['status']=FALSE;
                    $data['html']="Data received is incorrect";
                    break;
            }
            echo json_encode($data);
            return TRUE;
        }
    }
    public function dashboard()
    {        
        $auth_type = $this->session->userdata('auth_type');
        $auth_id = $this->session->userdata('auth_id');
        $res['product_category'] = $this->db->select('count(*) as "total"')->get('category')->row();
        $res['active_vendor'] = $this->db->select('count(*) as "total"')->where("isActive='2'")->get('vender')->row();
        $res['inactive_vendor'] = $this->db->select('count(*) as "total"')->where("isActive='4'")->get('vender')->row();
        $res['distance_range'] = $this->db->select('distance_range')->where('id','1')->where('name','pandit_seach')->get('range_limits')->row();
        $res['commission'] = $this->db->select('commision')->where('id','1')->get('commission')->row();
        $res['product_sub_category'] = $this->db->select('count(*) as "total"')->where_in('status',array('0','1','2'))->get('orders')->row();
        $res['order_today']=$this->db->select('count(*) as "total"')->where('DATE(`entry_date`) = CURDATE()')->where_in('status',array('0','1','2','3'))->get('orders')->row();
        $res['booking_today']=$this->db->select('count(*) as "total"')->where('DATE(`entrydt`) = CURDATE()')->where_in('status',array('accepted','completed'))->get('pooja_booking')->row();
        $res['product'] = $this->db->select('count(*) as "total"')->get('product')->row();
        $res['user'] = $this->db->select('count(*) as "total"')->where("approved='1'")->get('user')->row();
        $res['pandit'] = $this->db->select('count(*) as "total"')->where("approved='1'")->get('pandit')->row();
        $res['auth_type'] = $auth_type;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('dashboard',$res);
        $this->load->view('include/footer');
    }
    public function today_order(){
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('user_id',$user_id)->get('user')->row_array();
        $res['order'] = $this->db->select(' orders.category_name as "order_category_name",
    orders.product_name as "order_product_name",
    orders.address as "order_address",
    orders.state as "order_state",
    orders.quantity as "order_quantity",
    orders.amount as "order_amount",
    user.username as "user_name",
    user.mobile as "user_mobile",
    vender.name as "vendor_name",
    vender.contact as "vendor_mobile" ')->from('orders')->join('user','user.user_id=orders.user_id')->join('vender','vender.id=orders.vendorId')->where('DATE(orders.`entry_date`) = CURDATE()')->where_in('orders.status',array('0','1','2','3'))->get()->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;

        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('today_order',$res);
        $this->load->view('include/footer');
    } 
    public function today_booking(){
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('user_id',$user_id)->get('user')->row_array();
        $res['booking'] = $this->db->select('pooja_booking.pooja_id as "pooja_id",
    pooja_booking.pooja_name as "pooja_name",
    pooja_booking.date as "pooja_date",
    pooja_booking.time as "pooja_time",
    pooja_booking.flat as "pooja_flat",
    pooja_booking.landmark as "pooja_landmark",
    pooja_booking.colony as "pooja_colony",
    pooja_booking.pin as "pooja_pin",
    pooja_booking.city as "pooja_city",
    pooja_booking.with_item as "pooja_with_item",
    pooja_booking.samagri as "pooja_samagri",
    pooja_booking.price as "pooja_price",
    pandit.username as "pandit_name",
    pandit.mobile as "pandit_mobile",
    user.username as "user_name",
    user.mobile as "user_mobile"')->from('pooja_booking')->join('pandit','pandit.user_id = pooja_booking.panditId')->join('user','user.user_id = pooja_booking.user_id')->where('DATE(pooja_booking.`entrydt`) = CURDATE()')->where_in('pooja_booking.status',array('accepted','completed'))->get()->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('today_booking',$res);
        $this->load->view('include/footer');
    } 
    ////////////////////////////NOTIFICATION /////////////////////////////////////
	public function get_notification()
    {
        $notification = $this->db->query("SELECT * FROM `notification` WHERE notify_to = 'admin' AND seen = '0' ORDER BY notification_id DESC LIMIT 50");
        $res['notification'] = $notification->result();
        $res['count'] = $notification->num_rows();
        $this->load->view('get_notification',$res);
	}
		
	public function seen_notification()
    {
        $notification_id = $this->input->post('notification_id');
        $this->db->where('notification_id',$notification_id)->update("notification",array('seen'=> '1','seen_by' => 'admin'));
    }
    
    
    public function notification()
	{
        $notification = $this->db->query("SELECT * FROM `notification` WHERE notify_to = 'admin' ORDER BY notification_id DESC LIMIT 100");
        $res['notification'] = $notification->result();
        $res['count'] = $notification->num_rows();
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('notification',$res);
        $this->load->view('include/footer');
	}
	////////////////////////////NOTIFICATION /////////////////////////////////////
	public function send_notification(){
        if (isset($_POST)) {
            $registration_data = array(
                                            'status'=>'2',
                                            'title'=>$_POST['title'],
                                            'body'=>$_POST['body'],
                                            'Type'=>$_POST['Type'],
                                            'Activity'=>'null',
                                            'Image'=>'null'
                                    );
            $result = $this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), $_POST['Type'].'-'.$_POST['mobile']);


            redirect($this->controller.$_POST['Type']."_detail?q=".$_POST['id']);
        }
    }

    public function user()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('user_id',$user_id)->get('user')->row_array();

        $res['user'] = $this->db->where('type','USER')->order_by('entrydt','DESC')->get('user')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('user',$res);
        $this->load->view('include/footer');
    }
	public function vendor()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('id',$user_id)->get('vender')->row_array();

        $res['user'] = $this->db->order_by('id','DESC')->get('vender')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('vendor',$res);
        $this->load->view('include/footer');
    }
	public function dailypandit_subscription(){
		 $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('id',$user_id)->get('dailypandit')->row_array();
		$res['dailypandit_subscription'] = $this->db->get('dailypandit_subscription')->result();
        $res['user'] = $this->db->order_by('id','DESC')->get('dailypandit')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('dailypandit_subscription',$res);
        $this->load->view('include/footer');
	}
	public function dailypandit(){
		 $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('id',$user_id)->get('dailypandit')->row_array();
        $res['user'] = $this->db->order_by('id','DESC')->get('dailypandit')->result();
		$res['pandit'] = $this->db->where('status',1)->get('pandit')->result();
		$res['dailypandit_subscription'] = $this->db->get('dailypandit_subscription')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('dailypandit',$res);
        $this->load->view('include/footer');
	}
	
	public function getsubscription(){
		$subscription_for = $this->input->post("subscription_for"); 
		 $this->db->where('subscription_for',$subscription_for);
		$query=$this->db->get('dailypandit_subscription');
	    	echo '<option value="">--Select Subscription--</option>';
			foreach ($query->result() as $row){ 
                         
                          ?>
					<option value="<?php echo $row->id; ?>" ><?php 
											if($row->subscription_type==1){ echo "Monthly"; }
											else if($row->subscription_type==2){ echo "2 Monthly";}
											else if($row->subscription_type==3){  echo "Quaterly";}
											else if($row->subscription_type==4){  echo "Half Yearly";}
											else if($row->subscription_type==5){  echo "Yearly";}

					?></option> 
				<?php 
			}
	}
	public function suboffice_submit()
    {
       $subscription_for = $this->input->post('subscription_for');
        $subscription_type = $this->input->post('subscription_type');
        //$price = array('price'=> $this->input->post('price'));
        //$id = $this->input->post('id');
        $q = $this->db->where('subscription_for',$subscription_for)->where('subscription_type',$subscription_type)->get('dailypandit_subscription');
        if($q->num_rows() > 0)
        {
           // $this->db->where('id',$id);
           // $this->db->update('dailypandit_subscription',$price);
            $this->session->set_flashdata('err_msg', 'Subscription for this type  Already Exist');
            redirect($this->controller."dailypandit_subscription");
        }
        else
        {$this->db->insert('dailypandit_subscription',$_POST);
            $this->session->set_flashdata('err_msg', 'Subscription for this type Saved Successfully');
            redirect($this->controller."dailypandit_subscription");   
        }       
    }
	public function subhome_submit()
    {
       $subscription_for = $this->input->post('subscription_for');
        $subscription_type = $this->input->post('subscription_type');
        $q = $this->db->where('subscription_for',$subscription_for)->where('subscription_type',$subscription_type)->get('dailypandit_subscription');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Subscription for this type  Already Exist');
            redirect($this->controller."dailypandit_subscription");
        }
        else
        {$this->db->insert('dailypandit_subscription',$_POST);
            $this->session->set_flashdata('err_msg', 'Subscription for this type Saved Successfully');
            redirect($this->controller."dailypandit_subscription");   
        }       
    }
	public function dlypandit_submit()
    {
        $subscription_id=$this->input->post('subscription_id');
       $subscription_for = $this->input->post('subscription_for');
        $pandit_id = $this->input->post('pandit_id');
        $q = $this->db->where('pandit_id',$pandit_id)->where('subscription_for',$subscription_for)->where('subscription_id',$subscription_id)->get('dailypandit');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'This Pandit is Already Exist as Subscriber');
            redirect($this->controller."dailypandit");
        }
        else
        {	
        $qq = $this->db->where('user_id',$_POST['pandit_id'])->get('pandit')->row();
			$_POST['subscription_status'] = 1;
			$_POST['subscription_date'] = date('Y-m-d');
			$registration_data = array(
                                            'status'=>'Expired',
                                            'title'=>'Daily Booking Subscription.',
                                            'body'=>'You have now Subscribe for Daily Booking.',
                                            'Type'=>'pandit',
                                            'Activity'=>'null',
                                            'Image'=>'null'
                                    );
                                   
			$this->db->insert('dailypandit',$_POST);
			$login=$this->Notification->sendNotification('title' , '$body' , array('data'=>json_encode($registration_data)), 'pandit-'.$qq->mobile);
            $this->session->set_flashdata('err_msg', 'This Pandit Saved Successfully as Subscriber');
            redirect($this->controller."dailypandit");   
        }       
    }
    public function user_submit()
    {
        $user_id = $this->input->post('user_id');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $q = $this->db->where('user_id !=',$user_id)->where("(mobile = '$mobile' OR email='$email')")->get('user');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Email Or Mobile Already Exist');
            redirect($this->controller."user");
        }
        else
        {
            if($_FILES['image']['name']){
                $image = "uploads/user/".basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_POST['image'] = $image;
                }
            }

            if($user_id != ''){
                $this->db->where('user_id',$user_id)->update('user',$_POST);
            }else{
                $_POST['approved'] = 1;
                $this->db->insert('user',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'User Saved Successfully');
            redirect($this->controller."user");
        }       
    }
    
    
    
    
    public function fulluser_submit()
    {
        $user_id = $this->input->post('user_id'); 
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        
        $ifscCode = $this->input->post('ifscCode');
        $accountHolderName = $this->input->post('accountHolderName');
        $bankAccountNumber = $this->input->post('bankAccountNumber');
        $pancard_no = $this->input->post('pancard_no');
        $dob = $this->input->post('dob');
        $aadhar_no = $this->input->post('aadhar_no');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $q = $this->db->where('user_id !=',$user_id)->where("(mobile = '$mobile' OR email='$email')")->get('user');
        if($q->num_rows() > 0)
        {
            //print_r("llllllllllllll");exit();
            $this->session->set_flashdata('err_msg', 'Email Or Mobile Already Exist');
            redirect($this->controller."user");
        }
        else
        {
            //print_r($_POST);exit();
            if($_FILES['image']['name']){
                $image = "uploads/user/".basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_POST['image'] = $image;
                }
            }

            if($user_id != ''){
                $this->db->where('user_id',$user_id)->update('user',$_POST);
            }else{
                $_POST['approved'] = 1;
               
                $this->db->update('user',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'User Updated Successfully');
            redirect($this->controller."user_detail?q=".$user_id);
        }       
    }
    public function change_user_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $q = $this->db->where('user_id',$user_id)->get('user');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('user_id',$user_id)->update('user',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."user"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller."user");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function paramarspandit_submit()
    {
        
    }
     public function kundalipandit_submit()
    {
        
    }
	
	
	
	public function change_sub_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $q = $this->db->where('id',$user_id)->get('dailypandit');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['subscription_status'] ? 0 : 1;
                $this->db->where('id',$user_id)->update('dailypandit',array('subscription_status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."dailypandit"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Dailypandit No Found');
                redirect($this->controller."dailypandit");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function user_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $q = $this->db->where('user_id',$user_id)->get('user');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('user_id',$user_id)->delete('user');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'User Deleted Successfully');
            redirect($this->controller."user"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Image No Found');
            redirect($this->controller."user");
        }
    }
	public function sub_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $q = $this->db->where('id',$user_id)->get('dailypandit');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('id',$user_id)->delete('dailypandit');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'Dailypandit Deleted Successfully');
            redirect($this->controller."dailypandit"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Image No Found');
            redirect($this->controller."dailypandit");
        }
    }
	
	public function subpandit_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $q = $this->db->where('id',$user_id)->get('dailypandit_subscription');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('id',$user_id)->delete('dailypandit_subscription');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'Subscription Detail Deleted Successfully');
            redirect($this->controller."dailypandit_subscription"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Image No Found');
            redirect($this->controller."dailypandit_subscription");
        }
    }
    public function user_detail(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $vendor_id = $this->input->get('q');
            $res['data'] = $this->db->where('user_id',$vendor_id)->get('user')->row_array();

            $res['orders'] = $this->db->join('vender','vender.id=orders.vendorId')->where('user_id',$vendor_id)->get('orders')->result_array();
            $res['pooja_booking'] = $this->db->select(
                '
                pooja_booking.pooja_booking_id as "pooja_booking_id",
                pooja_booking.pooja_id as "pooja_id",
                pooja_booking.pooja_name as "pooja_name",
                pooja_booking.user_id as "user_id",
                pooja_booking.panditId as "panditId",
                pooja_booking.username as "username",
                pooja_booking.date as "date",
                pooja_booking.time as "time",
                pooja_booking.flat as "flat",
                pooja_booking.landmark as "landmark",
                pooja_booking.colony as "colony",
                pooja_booking.pin as "pin",
                pooja_booking.city as "city",
                pooja_booking.state as "state",
                pooja_booking.price as "price",
                pooja_booking.payment_type as "payment_type",
                pooja_booking.pandit_feedback as "pandit_feedback",
                pooja_booking.status as "pooja_status",
                pooja_booking.user_feedback as "user_feedback",
                pandit.user_id as "pandit_id",
                pandit.username as "pandit_name"
                ')->from('pooja_booking')->join('pandit','pandit.user_id=pooja_booking.panditId')->where('pooja_booking.user_id',$vendor_id)->get()->result_array();
            $res['form'] = ($auth_type == 'admin')?1:0;
            $res['list'] = ($auth_type == 'admin')?1:0;
            
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('userPage',$res);
            $this->load->view('include/footer');
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function pandit()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $res['data'] = $this->db->where('user_id',$user_id)->get('pandit')->row_array();

        $res['user'] = $this->db->order_by('entrydt','DESC')->get('pandit')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pandit',$res);
        $this->load->view('include/footer');
    }
    public function pandit_submit()
    {
        $user_id = $this->input->post('user_id');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $q = $this->db->where('user_id <>',$user_id)->where("(mobile = '$mobile' OR email='$email')")->get('pandit');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Email Or Mobile Already Exist');
            redirect($this->controller."pandit");
        }
        else
        {
            if($_FILES['image']['name']){
                $image = "uploads/user/".basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_POST['image'] = $image;
                }
            }

            if($user_id != ''){
                $this->db->where('user_id',$user_id)->update('pandit',$_POST);
            }else{
                $_POST['approved'] = 1;
                $this->db->insert('pandit',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'User Saved Successfully');
            redirect($this->controller."pandit");
        }       
    }
    
    public function fullpandit_submit()
    {
        $user_id = $this->input->post('user_id');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        //print_r($_POST);exit();
        $ifscCode = $this->input->post('ifscCode');
        $accountHolderName = $this->input->post('accountHolderName');
        $bankAccountNumber = $this->input->post('bankAccountNumber');
        $pancard_no = $this->input->post('pancard_no');
        $dob = $this->input->post('dob');
        $aadhar_no = $this->input->post('aadhar_no');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $q = $this->db->where('user_id !=',$user_id)->where("(mobile = '$mobile' OR email='$email')")->get('pandit');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Email Or Mobile Already Exist');
            redirect($this->controller."pandit");
        }
        else
        {
            if($_FILES['image']['name']){
                $image = "uploads/user/".basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_POST['image'] = $image;
                }
            }

            if($user_id != ''){
                $this->db->where('user_id',$user_id)->update('pandit',$_POST);
            }else{
                $_POST['approved'] = 1;
                $this->db->insert('pandit',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'Pandit Updated Successfully');
            redirect($this->controller."pandit_detail?q=".$user_id);
        }       
    }
    public function change_pandit_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $q = $this->db->where('user_id',$user_id)->get('pandit');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('user_id',$user_id)->update('pandit',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."pandit"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller."pandit");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function change_pandit_approve()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $status = $this->input->get('s');
            $q = $this->db->where('user_id',$user_id)->get('pandit');
            if($q->num_rows() > 0)
            {
                $this->db->where('user_id',$user_id)->update('pandit',array('approved'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."pandit"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller."pandit");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function pandit_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $q = $this->db->where('user_id',$user_id)->get('pandit');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('user_id',$user_id)->delete('pandit');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'User Deleted Successfully');
            redirect($this->controller."pandit"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Image No Found');
            redirect($this->controller."pandit");
        }
    }
    public function pandit_detail(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $vendor_id = $this->input->get('q');
            $res['data'] = $this->db->where('user_id',$vendor_id)->get('pandit')->row_array();
            $res['pooja_booking'] = $this->db->select(
                '
                pooja_booking.pooja_booking_id as "pooja_booking_id",
                pooja_booking.pooja_id as "pooja_id",
                pooja_booking.pooja_name as "pooja_name",
                pooja_booking.user_id as "user_id",
                pooja_booking.panditId as "panditId",
                pooja_booking.username as "username",
                pooja_booking.date as "date",
                pooja_booking.time as "time",
                pooja_booking.flat as "flat",
                pooja_booking.landmark as "landmark",
                pooja_booking.colony as "colony",
                pooja_booking.pin as "pin",
                pooja_booking.city as "city",
                pooja_booking.state as "state",
                pooja_booking.price as "price",
                pooja_booking.payment_type as "payment_type",
                pooja_booking.pandit_feedback as "pandit_feedback",
                pooja_booking.status as "pooja_status",
                pooja_booking.user_feedback as "user_feedback",
                pandit.user_id as "pandit_id",
                pandit.username as "pandit_name"
                ')->from('pooja_booking')->join('pandit','pandit.user_id=pooja_booking.panditId')->where('pooja_booking.panditId',$vendor_id)->get()->result_array();
            $res['form'] = ($auth_type == 'admin')?1:0;
            $res['list'] = ($auth_type == 'admin')?1:0;
            
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('panditPage',$res);
            $this->load->view('include/footer');
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function change_pooja_booking_status(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $status = urldecode($this->input->get('s'));
            $go_back_url= urldecode($this->input->get('g'));
            $q = $this->db->where('id',$user_id)->get('orders');
            if($q->num_rows() > 0)
            {
                $this->db->where('pooja_booking_id ',$user_id)->update('pooja_booking',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller.$go_back_url);
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller.$go_back_url);
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function change_mandal_booking_status(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $status = urldecode($this->input->get('s'));
            $go_back_url= urldecode($this->input->get('g'));
            $q = $this->db->where('id',$user_id)->get('orders');
            if($q->num_rows() > 0)
            {
                $this->db->where('booking_id ',$user_id)->update('mandal_booked',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller.$go_back_url);
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller.$go_back_url);
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    
    
    public function change_ayojan_booking_status(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $status = urldecode($this->input->get('s'));
            $go_back_url= urldecode($this->input->get('g'));
            $q = $this->db->where('id',$user_id)->get('orders');
            if($q->num_rows() > 0)
            {
                $this->db->where('booking_id ',$user_id)->update('bhavya_ayojan',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller.$go_back_url);
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller.$go_back_url);
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function vendor_submit()
    {
        $user_id = $this->input->post('id');
        $mobile = $this->input->post('contact');
        $email = $this->input->post('email');
        $q = $this->db->where('id !=',$user_id)->where("(contact = '$mobile' OR email='$email')")->get('vender');
        if($user_id != '') {
            $this->db->where('id',$user_id)->update('vender',$_POST);
        }else {
            if($q->num_rows() > 0) {   
                $this->session->set_flashdata('err_msg', 'Email Or Mobile Already Exist');
                redirect($this->controller."vendor");
            }
            else {        
                $_POST['isActive'] = 0;
                $this->db->insert('vender',$_POST);
                $this->session->set_flashdata('err_msg', 'User Saved Successfully');
            }   
        }
        redirect($this->controller."vendor");
    }
    public function change_vendor_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $status = $this->input->get('s');
            $q = $this->db->where('id',$user_id)->get('vender');
            if($q->num_rows() > 0)
            {
                $this->db->where('id',$user_id)->update('vender',array('isActive'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."vendor"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller."vendor");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }    
    public function vendor_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->input->get('q');
        $q = $this->db->where('id',$user_id)->get('vender');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('id',$user_id)->delete('vender');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'User Deleted Successfully');
            redirect($this->controller."vendor"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Image No Found');
            redirect($this->controller."vendor");
        }
    }
    public function vendor_detail(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $vendor_id = $this->input->get('q');
            $res['data'] = $this->db->where('id',$vendor_id)->get('vender')->row_array();

            $res['orders'] = $this->db->join('vender','vender.id=orders.vendorId')->where('vendorId',$vendor_id)->get('orders')->result_array();
            $res['form'] = ($auth_type == 'admin')?1:0;
            $res['list'] = ($auth_type == 'admin')?1:0;
            
            $this->load->view('include/header');
            $this->load->view('include/sidebar');
            $this->load->view('vendorPage',$res);
            $this->load->view('include/footer');
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function change_vendor_order_status(){
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $user_id = $this->input->get('q');
            $status = $this->input->get('s');
            $go_back_url= urldecode($this->input->get('g'));
            $q = $this->db->where('id',$user_id)->get('orders');
            if($q->num_rows() > 0)
            {
                $this->db->where('id',$user_id)->update('orders',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller.$go_back_url);
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'User No Found');
                redirect($this->controller.$go_back_url);
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function category()
    {
        $auth_type = $this->session->userdata('auth_type');
        $category_id = $this->input->get('q');
        $res['data'] = $this->db->where('category_id',$category_id)->get('category')->row_array();

        $res['category'] = $this->db->order_by('entrydt','DESC')->get('category')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('category',$res);
        $this->load->view('include/footer');
    }
    public function category_submit()
    {
        $category_id = $this->input->post('category_id');
        $category_name = $this->input->post('category_name');
        $q = $this->db->where('category_id !=',$category_id)->where('category_name',$category_name)->get('category');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'category Name Already Exist');
            redirect($this->controller."category");
        }
        else
        {
            if($_FILES['image']['name']){
                $image = "uploads/category/".basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_POST['image'] = $image;
                }
            }
            if($category_id != ''){
                $this->db->where('category_id',$category_id)->update('category',$_POST);
            }else{                    
                $this->db->insert('category',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'category Saved Successfully');
            redirect($this->controller."category");   
        }
    }
    public function category_delete(){
        $auth_type = $this->session->userdata('auth_type');
        $category_id = $this->input->get('q');
        $q = $this->db->where('category_id',$category_id)->get('category');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('category_id',$category_id)->delete('category');
            $this->session->set_flashdata('err_msg', 'category Deleted Successfully');
            redirect($this->controller."category"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'category No Found');
            redirect($this->controller."category");
        }
    }
    public function sub_category(){
        $auth_type = $this->session->userdata('auth_type');
        $sub_category_id = $this->input->get('q');
        $res['data'] = $this->db->where('sub_category_id',$sub_category_id)->get('sub_category')->row_array();

        $res['sub_category'] = $this->db->select('s.*,c.category_name')->join("category c","c.category_id=s.category_id")->order_by('s.entrydt','DESC')->get('sub_category s')->result();
        $res['category_list'] = $this->db->where('status','1')->order_by('entrydt','DESC')->get('category')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('sub_category',$res);
        $this->load->view('include/footer');
    }
    public function sub_category_submit()
    {
        $sub_category_id = $this->input->post('sub_category_id');
        $category_id = $this->input->post('category_id');
        $sub_category_name = $this->input->post('sub_category_name');
        $q = $this->db->where('sub_category_id !=',$sub_category_id)->where('category_id',$category_id)->where('sub_category_name',$sub_category_name)->get('sub_category');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Sub category Name Already Exist');
            redirect($this->controller."sub_category");
        }
        else
        {
            if($sub_category_id != ''){
                $this->db->where('sub_category_id',$sub_category_id)->update('sub_category',$_POST);
            }else{                    
                $this->db->insert('sub_category',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'sub_category Saved Successfully');
            redirect($this->controller."sub_category");   
        }
    }
    
    public function sub_category_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $sub_category_id = $this->input->get('q');
        $q = $this->db->where('sub_category_id',$sub_category_id)->get('sub_category');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('sub_category_id',$sub_category_id)->delete('sub_category');
            $this->session->set_flashdata('err_msg', 'sub category Deleted Successfully');
            redirect($this->controller."sub_category"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'sub category No Found');
            redirect($this->controller."sub_category");
        }
    }
    public function pooja()
    {
        $auth_type = $this->session->userdata('auth_type');
        $pooja_id = $this->input->get('q');
        $res['data'] = $this->db->where('pooja_id',$pooja_id)->get('pooja')->row_array();

        $res['pooja'] = $this->db->order_by('pooja_id','DESC')->get('pooja')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('pooja',$res);
        $this->load->view('include/footer');
    }
    public function pooja_submit()
    {
        $pooja_id = $this->input->post('pooja_id');
        $pooja_name = $this->input->post('pooja_name');
        $q = $this->db->where('pooja_id !=',$pooja_id)->where("pooja_name",$pooja_name)->get('pooja');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Pooja Name Already Exist');
            redirect($this->controller."pooja");
        }
        else
        {
            $images = $_FILES['image']['name'];
            $image = array();
            foreach($images as $k => $name)
            {
                if($name != '')
                {
                    $img = "uploads/pooja/".rand(00000,99999).basename($name);
                    if(move_uploaded_file($_FILES['image']['tmp_name'][$k], $img))
                    {
                        $image[] = $img;
                    }
                }
            }
            if(count($image) > 0){
                $_POST['image'] = implode(",",$image);
            }

            if($pooja_id != ''){
                $this->db->where('pooja_id',$pooja_id)->update('pooja',$_POST);
            }else{
                $this->db->insert('pooja',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'pooja Saved Successfully');
            redirect($this->controller."pooja");
        }       
    }
    
    
    
    
    
    
    public function virtual_submit()
    {
        $virtual_service = $this->input->post('virtual_service');
        $q = $this->db->where('virtual_service',$virtual_service)->get('virtual_service');
        //print_r($_POST);exit();
        if($q->num_rows() > 0)
        {
            $this->db->where('id',$q->row()->id);
            $this->db->update('virtual_service',$_POST);
            $this->session->set_flashdata('err_msg', 'Virtual Service Updated Successfully');
            redirect($this->controller."virtualservice");
        }
        else
        { 
            $this->db->insert('virtual_service',$_POST);
            $this->session->set_flashdata('err_msg', 'Virtual Service Saved Successfully');
            redirect($this->controller."virtualservice");
        }       
    }
    public function change_pooja_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $pooja_id = $this->input->get('q');
            $q = $this->db->where('pooja_id',$pooja_id)->get('pooja');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('pooja_id',$pooja_id)->update('pooja',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."pooja"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Pooja No Found');
                redirect($this->controller."pooja");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    public function pooja_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $pooja_id = $this->input->get('q');
        $q = $this->db->where('pooja_id',$pooja_id)->get('pooja');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('pooja_id',$pooja_id)->delete('pooja');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'Pooja Deleted Successfully');
            redirect($this->controller."pooja"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Pooja No Found');
            redirect($this->controller."pooja");
        }
    }
    public function booking()
    {
    
       
       $auth_type = $this->session->userdata('auth_type');
        $pooja_booking_id = $this->input->get('r');
        $bo['data'] = $this->db->where('pooja_booking_id',$pooja_booking_id)->get('pooja_booking')->row_array();
        $bo['pooja_booking'] = $this->db->order_by('pooja_booking_id','DESC')->get('pooja_booking')->result();
        $bo['form'] = ($auth_type == 'admin')?1:0;
        $bo['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('booking',$bo);
        $this->load->view('include/footer');
    }
    public function dailypandit_booking()
    {
    
       
       $auth_type = $this->session->userdata('auth_type');
        $pooja_booking_id = $this->input->get('r');
        $bo['data'] = $this->db->where('booking_id',$pooja_booking_id)->get('dailypandit_booking')->row_array();
        $bo['pooja_booking'] = $this->db->order_by('booking_id','DESC')->get('dailypandit_booking')->result();
        $bo['form'] = ($auth_type == 'admin')?1:0;
        $bo['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('dailypandit_booking',$bo);
        $this->load->view('include/footer');
    }
    
    public function orders()
    {
        $auth_type = $this->session->userdata('auth_type');
        $pooja_booking_id = $this->input->get('r');
        $bo['data'] = $this->db->where('id',$pooja_booking_id)->get('orders')->row_array();
        $bo['pooja_booking'] = $this->db->order_by('id','DESC')->get('orders')->result();
        $bo['form'] = ($auth_type == 'admin')?1:0;
        $bo['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('orders',$bo);
        $this->load->view('include/footer');
    }
    public function mandal_booking()
    {
        $auth_type = $this->session->userdata('auth_type');
        $pooja_booking_id = $this->input->get('r');
        $bo['data'] = $this->db->where('booking_id',$pooja_booking_id)->get('mandal_booked')->row_array();
        $bo['pandit'] = $this->db->where('status',1)->get('pandit')->result();
        $bo['pooja_booking'] = $this->db->order_by('booking_id','DESC')->get('mandal_booked')->result();
        $bo['form'] = ($auth_type == 'admin')?1:0;
        $bo['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('mandal_booking',$bo);
        $this->load->view('include/footer');
    }
    
    public function mandal_assign_byadmin()
    {
    $booking_id = $this->input->post('id'); 
    $pandit = $this->input->post('pandit_id');
    $panditname= $this->db->where('user_id',$pandit)->get('pandit')->row()->username;
    $data=array(
        'panditId'=>$pandit,
    'accepted_by'=>$pandit,
    'accepted_by_name'=>$panditname,
    'status'=>"accepted"
        );
    $q = $this->db->where('booking_id',$booking_id)->update('mandal_booked',$data);
    if($q==true){
         /*$this->db->where('user_id',$this->input->post('pandit_id'));
            $mobile= $this->db->get('pandit')->row()->mobile;
             $registration_data="kkkkkkkkkkkkkk"
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
              $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$mobile); */
    }
    
    redirect($this->controller."mandal_booking");
    }
    
    public function ayojan_assign_byadmin()
    {
    $booking_id = $this->input->post('id'); 
    $pandit = $this->input->post('pandit_id');
    $panditname= $this->db->where('user_id',$pandit)->get('pandit')->row()->username;
    $data=array(
        'panditId'=>$pandit,
    'accepted_by'=>$pandit,
    'accepted_by_name'=>$panditname,
    'status'=>"accepted"
        );
    $q = $this->db->where('booking_id',$booking_id)->update('bhavya_ayojan',$data);
    if($q==true){
         /*$this->db->where('user_id',$this->input->post('pandit_id'));
            $mobile= $this->db->get('pandit')->row()->mobile;
             $registration_data="kkkkkkkkkkkkkk"
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
              $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$mobile); */
    }
    
    redirect($this->controller."ayojan_booking");
    }
    
    
    public function ayojan_booking()
    {
    
       
       $auth_type = $this->session->userdata('auth_type');
        $pooja_booking_id = $this->input->get('r');
        $bo['data'] = $this->db->where('booking_id',$pooja_booking_id)->get('bhavya_ayojan')->row_array();
        $bo['pooja_booking'] = $this->db->order_by('booking_id','DESC')->get('bhavya_ayojan')->result();
        $bo['form'] = ($auth_type == 'admin')?1:0;
        $bo['list'] = ($auth_type == 'admin')?1:0;
        $bo['pandit'] = $this->db->where('status',1)->get('pandit')->result();
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('ayojan_booking',$bo);
        $this->load->view('include/footer');
    }
    public function booking_submit()
    {
        $pooja_id = $this->input->post('pooja_id');
        $pooja_name = $this->input->post('pooja_name');
        $q = $this->db->where('pooja_id !=',$pooja_id)->where("pooja_name",$pooja_name)->get('pooja');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Pooja Name Already Exist');
            redirect($this->controller."pooja");
        }
        else
        {
            $images = $_FILES['image']['name'];
            $image = array();
            foreach($images as $k => $name)
            {
                if($name != '')
                {
                    $img = "uploads/pooja/".rand(00000,99999).basename($name);
                    if(move_uploaded_file($_FILES['image']['tmp_name'][$k], $img))
                    {
                        $image[] = $img;
                    }
                }
            }
            if(count($image) > 0){
                $_POST['image'] = implode(",",$image);
            }

            if($pooja_id != ''){
                $this->db->where('pooja_id',$pooja_id)->update('pooja',$_POST);
            }else{
                $this->db->insert('pooja',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'pooja Saved Successfully');
            redirect($this->controller."pooja");
        }       
    }
    
    public function mandal()
    {
        $auth_type = $this->session->userdata('auth_type');
        $mandal_id = $this->input->get('m');
        $res['data'] = $this->db->where('mandal_id',$mandal_id)->get('mandal')->row_array();

        $res['mandal'] = $this->db->order_by('mandal_id','DESC')->get('mandal')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('mandal',$res);
        $this->load->view('include/footer');
    }
	public function ayojan()
    {
        $auth_type = $this->session->userdata('auth_type');
        $mandal_id = $this->input->get('m');
        $res['data'] = $this->db->where('ayojan_id',$mandal_id)->get('ayojan')->row_array();

        $res['ayojan'] = $this->db->order_by('ayojan_id','DESC')->get('ayojan')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('ayojan',$res);
        $this->load->view('include/footer');
    }
public function ayojan_submit()
    {
        $ayojan_id = $this->input->post('ayojan_id');
        $mandali_name = $this->input->post('ayojan_name');
        $m = $this->db->where('ayojan_id !=',$ayojan_id)->where("ayojan_name",$mandali_name)->get('ayojan');
        if($m->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Ayojan Name Already Exist');
            redirect($this->controller."ayojan");
        }
        else
        {
            $images = $_FILES['image']['name'];
            $image = array();
            foreach($images as $k => $name)
            {
                if($name != '')
                {
                    $img = "uploads/ayojan/".rand(00000,99999).basename($name);
                    if(move_uploaded_file($_FILES['image']['tmp_name'][$k], $img))
                    {
                        $image[] = $img;
                    }
                }
            }
            if(count($image) > 0){
                $_POST['image'] = implode(",",$image);
            }

            if($ayojan_id != ''){
                $this->db->where('ayojan_id',$ayojan_id)->update('ayojan',$_POST);
            }else{
                $this->db->insert('ayojan',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'Ayojan Saved Successfully');
            redirect($this->controller."ayojan");
        }       
    }
    
    public function mandal_submit()
    {
        $mandal_id = $this->input->post('mandal_id');
        $mandali_name = $this->input->post('mandali_name');
        $m = $this->db->where('mandal_id !=',$mandal_id)->where("mandali_name",$mandali_name)->get('mandal');
        if($m->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'Mandali Name Already Exist');
            redirect($this->controller."mandal");
        }
        else
        {
            $images = $_FILES['image']['name'];
            $image = array();
            foreach($images as $k => $name)
            {
                if($name != '')
                {
                    $img = "uploads/mandal/".rand(00000,99999).basename($name);
                    if(move_uploaded_file($_FILES['image']['tmp_name'][$k], $img))
                    {
                        $image[] = $img;
                    }
                }
            }
            if(count($image) > 0){
                $_POST['image'] = implode(",",$image);
            }

            if($mandal_id != ''){
                $this->db->where('mandal_id',$mandal_id)->update('mandal',$_POST);
            }else{
                $this->db->insert('mandal',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'Mandali Saved Successfully');
            redirect($this->controller."mandal");
        }       
    }
    
    public function change_mandal_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $mandal_id = $this->input->get('q');
            $q = $this->db->where('mandal_id',$mandal_id)->get('mandal');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('mandal_id',$mandal_id)->update('mandal',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."mandal"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Bhajan Mandal No Found');
                redirect($this->controller."mandal");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
	
	
	public function change_ayojan_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $ayojan_id = $this->input->get('q');
            $q = $this->db->where('ayojan_id',$ayojan_id)->get('ayojan');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('ayojan_id',$ayojan_id)->update('ayojan',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."ayojan"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Bhavya ayojan No Found');
                redirect($this->controller."ayojan");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }

    public function mandal_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $mandal_id = $this->input->get('q');
        $q = $this->db->where('mandal_id',$mandal_id)->get('mandal');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('mandal_id',$mandal_id)->delete('mandal');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'Mandali Deleted Successfully');
            redirect($this->controller."mandal"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Mandali No Found');
            redirect($this->controller."mandal");
        }
    }
	 public function ayojan_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $ayojan_id = $this->input->get('q');
        $q = $this->db->where('ayojan_id',$ayojan_id)->get('ayojan');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('ayojan_id',$ayojan_id)->delete('ayojan');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'Ayojan Deleted Successfully');
            redirect($this->controller."ayojan"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Ayojan No Found');
            redirect($this->controller."ayojan");
        }
    }

    public function product()
    {
        $auth_type = $this->session->userdata('auth_type');
        $product_id = $this->input->get('q');
        $res['data'] = $this->db->where('product_id',$product_id)->get('product')->row_array();

        $this->db->select('p.*,c.category_name,v.name as "vendor_name", v.id as "vendor_id"');
        $this->db->join('category c',"c.category_id=p.category_id","LEFT");
        $this->db->join('vender v',"v.id =p.vendorId","LEFT");
        $res['product'] = $this->db->order_by('p.product_id','DESC')->get('product p')->result();
        $res['category_list'] = $this->db->where('status','1')->get('category')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('product',$res);
        $this->load->view('include/footer');
    }

    public function product_submit()
    {
        $product_id = $this->input->post('product_id');
        $name = $this->input->post('name');
        $q = $this->db->where('product_id !=',$product_id)->where('name',$name)->get('product');
        if($q->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'product name Already Exist');
            redirect($this->controller."product");
        }
        else
        {
            if($_FILES['image']['name']){
                $image = "uploads/product/".rand(00000,99999).basename($_FILES["image"]["name"]);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                {
                    $_POST['image'] = $image;
                }
            }

            if($product_id != ''){
                $this->db->where('product_id',$product_id)->update('product',$_POST);
            }else{
                $this->db->insert('product',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'product Saved Successfully');
            redirect($this->controller."product");
        }       
    }

    public function change_product_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $product_id = $this->input->get('q');
            $q = $this->db->where('product_id',$product_id)->get('product');
            if($q->num_rows() > 0)
            {
                $oldData = $q->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('product_id',$product_id)->update('product',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."product"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'product No Found');
                redirect($this->controller."product");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }    
    
    public function update_terms_submit()
    { 
        $terms = array('terms'=> $this->input->post('terms'));
       $q = $this->db->get('terms');
        if($q->num_rows() > 0)
        {
             $this->db->update('terms',$terms);
            $this->session->set_flashdata('err_msg', 'Terms Successfully Updated');
            redirect($this->controller."terms"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Terms not Updated');
            redirect($this->controller."terms");
        } 
    }
    
    public function update_privacy_submit()
    { 
        $privacy_policy = array('privacy_policy'=> $this->input->post('privacy_policy'));
       $q = $this->db->get('privacy_policy');
        if($q->num_rows() > 0)
        {
             $this->db->update('privacy_policy',$privacy_policy);
            $this->session->set_flashdata('err_msg', 'Privacy and Policy Successfully Updated');
            redirect($this->controller."privacy_policy"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Privacy and Policy not Updated');
            redirect($this->controller."privacy_policy");
        } 
    }
    
    public function update_dlypandit_for_user()
    { 
        $id=$this->input->post('id');
        $pandit_id = array('pandit_id'=> $this->input->post('pandit_id'));
        $q = $this->db->get('dailypandit_booking');
        if($q->num_rows() > 0)
        {
            $this->db->where('booking_id',$id);
             $this->db->update('dailypandit_booking',$pandit_id);
             
             /////////////////////
            /*  $this->db->where('user_id',$this->input->post('pandit_id'));
            $mobile= $this->db->get('pandit')->row()->mobile;
             $registration_data="kkkkkkkkkkkkkk"
                $registration_data1 = array();
                $registration_data1['data'] = json_encode($registration_data);
              $login=$this->Notification->sendNotification('title' , '$body' , $registration_data1, 'pandit-'.$mobile); */
              ///////////////////
            $this->session->set_flashdata('err_msg', 'Daily Pandit is Assigned Successfully');
            redirect($this->controller."dailypandit_booking"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Daily Pandit not Assigned');
            redirect($this->controller."dailypandit_booking");
        } 
    }
    
    public function product_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $product_id = $this->input->get('q');
        $q = $this->db->where('product_id',$product_id)->get('product');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('product_id',$product_id)->delete('product');
            unlink($oldData['image']);
            $this->session->set_flashdata('err_msg', 'product Deleted Successfully');
            redirect($this->controller."product"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Image No Found');
            redirect($this->controller."product");
        }
    }
    
    public function donation()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $donation_id = $this->input->get('d');
        $do['data'] = $this->db->where('donation_id',$donation_id)->get('donation')->row_array();

        $do['donation'] = $this->db->order_by('donation_id','DESC')->get('donation')->result();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
       
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('donation',$do);
        $this->load->view('include/footer');
    }
	public function enqueries()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $donation_id = $this->input->get('d');
        $do['data'] = $this->db->where('id',$donation_id)->get('contact')->row_array();
        $do['enqueries'] = $this->db->order_by('id','DESC')->get('contact')->result();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
       
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('enqueries',$do);
        $this->load->view('include/footer');
    }
    
    public function assign_pandit()
    {
        $do['q']= $this->input->get('q');
        $do['subscription_id']= $this->input->get('subscription_id');
        $auth_type = $this->session->userdata('auth_type');
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('assign_pandit',$do);
        $this->load->view('include/footer');
    }
    
    public function terms()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $donation_id = $this->input->get('d');
        $do['data'] = $this->db->where('id',$donation_id)->get('terms')->row_array();
        $do['terms'] = $this->db->get('terms')->row();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
       
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('terms',$do);
        $this->load->view('include/footer');
    }
    public function privacy_policy()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $privacy_policy = $this->input->get('d');
        $do['data'] = $this->db->where('id',$privacy_policy)->get('privacy_policy')->row_array();
        $do['privacy_policy'] = $this->db->get('privacy_policy')->row();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
       
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('privacy_policy',$do);
        $this->load->view('include/footer');
    }

    public function donation_submit()
    {
        $donation_id = $this->input->post('donation_id');
        $donation_cause = $this->input->post('donation_cause');
        $d = $this->db->where('donation_id !=',$donation_id)->where("donation_cause",$donation_cause)->get('donation');
        if($d->num_rows() > 0)
        {
            $this->session->set_flashdata('err_msg', 'donation Name Already Exist');
            redirect($this->controller."donation");
        }
        else
        {

            

            if($mandal_id != ''){
                $this->db->where('donation_id',$donation_id)->update('donation',$_POST);
            }else{
                $this->db->insert('donation',$_POST);
            }

            $this->session->set_flashdata('err_msg', 'doantion Saved Successfully');
            redirect($this->controller."donation");
        }       
    }

     public function change_donation_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $donation_id = $this->input->get('d');
            $d = $this->db->where('donation_id',$donation_id)->get('donation');
            if($d->num_rows() > 0)
            {
                $oldData = $d->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('donation_id',$donation_id)->update('donation',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."donation"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Donation Mandal No Found');
                redirect($this->controller."donation");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }  
    
    
    public function dontion_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $donation_id = $this->input->get('d');
        $d = $this->db->where('donation_id',$donation_id)->get('donation');
        if($d->num_rows() > 0)
        {
            $this->db->where('donation_id',$donation_id)->delete('donation');
            $this->session->set_flashdata('err_msg', 'donation Deleted Successfully');
            redirect($this->controller."donation"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Donation No Found');
            redirect($this->controller."donation");
        }
    }
	public function contact_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $donation_id = $this->input->get('d');
        $d = $this->db->where('id',$donation_id)->get('contact');
        if($d->num_rows() > 0)
        {
            $this->db->where('id',$donation_id)->delete('contact');
            $this->session->set_flashdata('err_msg', 'Data Deleted Successfully');
            redirect($this->controller."enqueries"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Data not Found');
            redirect($this->controller."enqueries");
        }
    }
    
    
     public function donationlist()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $donationListing_id = $this->input->get('d');
        $do['data'] = $this->db->where('donationListing_id',$donationListing_id)->get('donationlisting')->row_array();
        $do['donationlisting'] = $this->db->join('donation','donation.donation_id=donationlisting.cause')->get('donationlisting')->result_array();
       // $do['donationlisting'] = $this->db->order_by('donationListing_id','DESC')->get('donationlisting')->result();
       //print_r($do1);exit();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
       
        
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('donationlist',$do);
        $this->load->view('include/footer');
    }

    public function change_donationlisting_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $donationListing_id = $this->input->get('d');
            $d = $this->db->where('donationListing_id',$donationListing_id)->get('donationlisting');
            if($d->num_rows() > 0)
            {
                $oldData = $d->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('donationListing_id',$donationListing_id)->update('donationlisting',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."donationlisting"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Donation Listing No Found');
                redirect($this->controller."donationlisting");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    
    public function virtualservice()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $virtual_id = $this->input->get('d');
        //$do['data'] = $this->db->where('virtual_id',$virtual_id)->get('virtualservice')->row_array();
        $do['virtualservices'] = $this->db->get('virtual_service')->result();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('virtualservice',$do);
        $this->load->view('include/footer');
    }
    public function virtualservice_request()
    {
        
        $auth_type = $this->session->userdata('auth_type');
        $virtual_id = $this->input->get('d');
        $do['data'] = $this->db->where('virtual_id',$virtual_id)->get('virtualservice')->row_array();
        $do['pandit'] = $this->db->where('status',1)->get('pandit')->result();
        $do['virtualservice'] = $this->db->get('paramarsh')->result();
        $do['kundali'] = $this->db->get('kundali')->result();
        $do['form'] = ($auth_type == 'admin')?1:0;
        $do['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('virtualservice_request',$do);
        $this->load->view('include/footer');
    }

public function dontionlisting_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $donationListing_id = $this->input->get('d');
        $d = $this->db->where('donationListing_id',$donationListing_id)->get('donationlisting');
        if($d->num_rows() > 0)
        {
            $oldData = $d->row_array();
            $this->db->where('donationListing_id',$donationListing_id)->delete('donationlisting');
            
            $this->session->set_flashdata('err_msg', 'Donation Listing Deleted Successfully');
            redirect($this->controller."donationlisting"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Donation Listing No Found');
            redirect($this->controller."donationlisting");
        }
    }
    
        public function change_virtual_status()
    {
        $auth_type = $this->session->userdata('auth_type');
        if($auth_type == 'admin')
        {
            $virtual_id = $this->input->get('d');
            $d = $this->db->where('virtual_id',$virtual_id)->get('virtualservice');
            if($d->num_rows() > 0)
            {
                $oldData = $d->row_array();
                $status = $oldData['status'] ? 0 : 1;
                $this->db->where('virtual_id',$virtual_id)->update('virtualservice',array('status'=>$status));
                $this->session->set_flashdata('err_msg', 'Status Has been Changed Successfully');
                redirect($this->controller."virtualservice"); 
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Virtual Service No Found');
                redirect($this->controller."virtualservice");
            }
        }
        else
        {
            echo "<script>alert('You are not Authorized to Access this Link');window.location.href='".site_url()."'</script>";
        }
    }
    
    
    
    

public function virtual_delete()
    {
        $auth_type = $this->session->userdata('auth_type');
        $virtual_id = $this->input->get('d');
        $d = $this->db->where('virtual_id',$virtual_id)->get('virtualservice');
        if($d->num_rows() > 0)
        {
            $oldData = $d->row_array();
            $this->db->where('virtual_id',$virtual_id)->delete('virtualservice');
            
            $this->session->set_flashdata('err_msg', 'Virtual Service Deleted Successfully');
            redirect($this->controller."virtualservice"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Virtual Service No Found');
            redirect($this->controller."virtualservice");
        }
    }
    public function updateRange(){
        if (isset($_POST['distance_range'])) {
            if ($this->db->where('id','1')->where('name','pandit_seach')->update("range_limits",$_POST)) {
                $data['status']=TRUE;
            }else{
                $data['status']=FALSE;
                $data['message']='Range could not be updated.';
            }
        }else{
            $data['status']=FALSE;
            $data['message']='Range not recieved.';
        }
        echo json_encode($data);
        return TRUE;
    }
    
    public function updatecommission(){
        if (isset($_POST['commision'])) {
            if ($this->db->where('id','1')->update("commission",$_POST)) {
                $data['status']=TRUE;
            }else{
                $data['status']=FALSE;
                $data['message']='commision could not be updated.';
            }
        }else{
            $data['status']=FALSE;
            $data['message']='Commision not recieved.';
        }
        echo json_encode($data);
        return TRUE;
    }
    public function slider()
    {
        $auth_type = $this->session->userdata('auth_type');
        $res['slider'] = $this->db->get('carousel_slider')->result();
        $res['form'] = ($auth_type == 'admin')?1:0;
        $res['list'] = ($auth_type == 'admin')?1:0;
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view('slider',$res);
        $this->load->view('include/footer');
    }
    
    public function slider_submit()
    {
        if(isset($_FILES['image']['name'])){
            $image = "uploads/slider/".date("Y-m-d-h-i-s")."-".basename($_FILES["image"]["name"]);
            if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
            {
                $_POST['url'] = $image;
                $_POST['is_display']=1;
                $this->db->insert('carousel_slider',$_POST);
                $this->session->set_flashdata('err_msg', 'Slider Saved Successfully');
            }else{
                $this->session->set_flashdata('err_msg', 'File could not be uploaded.');
            }
        }else{
            $this->session->set_flashdata('err_msg', 'Image file not received.');
        }
        
        redirect($this->controller."slider");   
    }
    public function slider_change_status(){
        $slider_id = $this->input->get('q');
        $sliderData=$this->db->where('id',$slider_id)->get('carousel_slider')->row();
        if ($sliderData !== FALSE) {
            $newStatus = $sliderData->is_display?0:1;
            $this->db->where('id',$sliderData->id)->update("carousel_slider",array('is_display'=>$newStatus));
            $this->session->set_flashdata('err_msg', 'Slider display status updated.');
            redirect($this->controller."slider");
        }
        else{
            $this->session->set_flashdata('err_msg', 'No Slider found.');
            redirect($this->controller."slider");    
        }
    }
    public function slider_delete(){
        $auth_type = $this->session->userdata('auth_type');
        $category_id = $this->input->get('q');
        $q = $this->db->where('id',$category_id)->get('carousel_slider');
        if($q->num_rows() > 0)
        {
            $oldData = $q->row_array();
            $this->db->where('id',$category_id)->delete('carousel_slider');
            $this->session->set_flashdata('err_msg', 'Slider Deleted Successfully');
            redirect($this->controller."slider"); 
        }
        else
        {
            $this->session->set_flashdata('err_msg', 'Slider No Found');
            redirect($this->controller."slider");
        }
    }
	 
}	
?>