<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	30th July, 2014
 *	Creative Item
 *	www.creativeitem.com
 *	http://codecanyon.net/user/joyontaroy
 */
  
class Login extends CI_Controller
{       
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2016 05:00:00 GMT");
    }
	
    //Default function, redirects to logged in user area
    public function index()
    {        
        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('admin_login') == 2|| $this->session->userdata('admin_login') == 3 )
            redirect(site_url('admin'), 'refresh');			
        if ($this->session->userdata('user_login') == 1)
            redirect(site_url('user'), 'refresh');					     
        $this->load->view('login');
        
    }
    
    //Ajax login function 
    function ajax_login()
    {
            $response = array();	
            //Recieving post input of email, password from ajax request
            $email 		= $_POST["email"];
            $password 	= $_POST["password"];
            $response['submitted_data'] = $_POST;		

            //Validating login
            $login_status = $this->validate_login( $email ,  $password );
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                     $response['redirect_url'] = '';
                     //redirect(site_url('admin'), 'refresh');	
            }
            //Replying ajax request with validation response
            echo json_encode($response);
    }
            
    //Validating login from ajax request
    function validate_login($email	=	'' , $password	 =  '')
    {

        $credential = array(	'email' => $email , 'password' => $password);		 		 
		 // Checking login credential for admin
        $query = $this->db->get_where('usertable' , $credential);
        if ($query->num_rows() > 0) {     
        	$row = $query->row();                
        	if($row->user_type == 1){ // admin
                        $this->session->set_userdata('admin_login', '1');
                        $this->session->set_userdata('admin_id', $row->no);
                        $this->session->set_userdata('name', $row->name);
                        $this->session->set_userdata('login_type', 'admin');
                        $this->session->set_userdata('priority', $row->priority);
        	}else if($row->user_type == 2){ // provider                    
                        $this->session->set_userdata('admin_login', '2');
                        $this->session->set_userdata('admin_id', $row->no);
                        $this->session->set_userdata('name', $row->name);
                        $this->session->set_userdata('login_type', 'admin');                        
        	}else if($row->user_type == 3){
                        $this->session->set_userdata('admin_login', '3');
                        $this->session->set_userdata('admin_id', $row->no);
                        $this->session->set_userdata('name', $row->name);
                        $this->session->set_userdata('login_type', 'admin');                    
                }else{                   
                        $this->session->set_userdata('admin_login', '4');
                        $this->session->set_userdata('admin_id', $row->no);
                        $this->session->set_userdata('name', $row->name);
                        $this->session->set_userdata('login_type', 'user');                                        
                }
        	                
			return 'success';
		}
		
		return 'invalid';
    }
    
    /***DEFAULT NOR FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    
	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
	function reset_password()
	{
		$account_type = $this->input->post('account_type');
		if ($account_type == "") {
			redirect(base_url(), 'refresh');
		}
		$email  = $this->input->post('email');
		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
		if ($result == true) {
			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));
		} else if ($result == false) {
			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
		}
		
		redirect(base_url(), 'refresh');		
	}
    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        //$this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(site_url('login') , 'refresh');
    }
    function customer_logout()
    {
        //$this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(site_url('user') , 'refresh');
    }
        
    // register part
    function ajax_register()
    {
            $response = array();	
            //Recieving post input of email, password from ajax request
            $email 		= $_POST["email"];
            $password 	= $_POST["password"];
            
            $response['submitted_data'] = $_POST;		

            //Validating login
            $login_status = $this->validate_login( $email ,  $password );
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                    $response['redirect_url'] = '';
            }

            //Replying ajax request with validation response
            echo json_encode($response);
    }
    
   
    
    public function register()
    {
        $this->load->view('includes_top');        
        $this->load->view('admin/register');        
        $this->load->view('modal');        
        $this->load->view('includes_bottom');        
    }
    
   function register_new($param1 = '', $param2 = '', $param3 = ''){
    
   
    	if ($param1 == 'create') {	
        
            /*$client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];
            $result  = array('country'=>'', 'city'=>'');
            if(filter_var($client, FILTER_VALIDATE_IP)){
                    $ip = $client;
            }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
                    $ip = $forward;
            }else{
                    $ip = $remote;
            }
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
            if($ip_data && $ip_data->geoplugin_countryName != null){
                    $result['country'] = $ip_data->geoplugin_countryCode;
                    $result['city'] = $ip_data->geoplugin_city;
                    $country = $ip_data->geoplugin_countryCode;
            }*/
            
            $data['name']        = $this->input->post('name');
            $data['surname']        = $this->input->post('surname');
            $data['email']        = $this->input->post('email');
            $data['phone']        = $this->input->post('phone');
            $data['address']        = $this->input->post('address');
            $data['password']        = $this->input->post('password');	
            $data['user_type']        = $this->input->post('user_type');
            $data['parentId']        = $this->input->post('saleman_no');     

            if($data['user_type'] == 2){                           
                
                $admin_no = $this->db->get_where('usertable', array('user_type' => 1))->row()->no;
                if($admin_no != null && $admin_no != ""){
                    $data['parentId'] = $admin_no;
                    $this->db->insert('usertable', $data);               
                    $login_status = $this->validate_login( $data['email'] ,  $data['password']);                     
                    if ($login_status == 'success') {
                        redirect(site_url('login/index') , 'refresh');
                    }                                             
                }                
            }else{
                $exist = $this->db->get_where('usertable', array('no' => $this->input->post('saleman_no')))->row()->no;
                if($exist != null && $exist != ""){
                    $this->db->insert('usertable', $data);
                    $login_status = $this->validate_login( $data['email'] ,  $data['password']); 
                    if ($login_status == 'success') {
                        redirect(base_url() . 'index.php/login/index', 'refresh');
                    }
                }
            }            
            redirect(base_url() . 'index.php/login/index', 'refresh');
    	}
    	elseif ($param1 == 'do_update') {
    		$data['name']        = $this->input->post('name');
    		$data['password']        = $this->input->post('email');
    		
    		$this->db->where('no', $param2);
    		$this->db->update('usertable', $data);
    		redirect(base_url() . 'index.php?admin/manager_users/', 'refresh');
    	}
    	elseif ($param1 == 'delete') {
    		$this->db->where('no', $param2);
    		$this->db->delete('usertable');
    		redirect(base_url() . 'index.php?admin/manager_users/', 'refresh');
    	}
    		
    	$page_data['page_name']  = 'manager_customer';
    	$page_data['page_title'] = get_phrase('User Management');
    	$this->load->view('index', $page_data);
    }

    
     function customer_register($param1 = '', $param2 = '', $param3 = ''){             
    	if ($param1 == 'create') {        
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];
            $result  = array('country'=>'', 'city'=>'');
            if(filter_var($client, FILTER_VALIDATE_IP)){
                    $ip = $client;
            }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
                    $ip = $forward;
            }else{
                    $ip = $remote;
            }
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
            if($ip_data && $ip_data->geoplugin_countryName != null){
                    $result['country'] = $ip_data->geoplugin_countryCode;
                    $result['city'] = $ip_data->geoplugin_city;
                    $country = $ip_data->geoplugin_countryCode;
            }
                        
            if($this->input->post('password') == $this->input->post('confirm_password')){
                
                $data['name']        = $this->input->post('fname');
                $data['surname']        = $this->input->post('lname');
                $data['email']        = $this->input->post('email');
                $data['password']        = $this->input->post('password');	
                $data['phone']        = $this->input->post('phone');	            
                $data['user_type'] = 4;

                $exist = $this->db->get_where('usertable', array('email' => $this->input->post('email')))->row()->no;
                if( ($exist == null) || ($exist == "") ){
                    $this->db->insert('usertable', $data);
                    $login_status = $this->validate_login( $data['email'] ,  $data['password']); 
                    if ($login_status == 'success') {
                        redirect(site_url('user'), 'refresh');
                    }
                }
            }
         
            redirect(site_url('user'), 'refresh');
    	}
    	elseif ($param1 == 'do_update') {
    		$data['name']        = $this->input->post('name');
    		$data['password']        = $this->input->post('email');
    		
    		$this->db->where('no', $param2);
    		$this->db->update('usertable', $data);
    		redirect(base_url() . 'index.php?admin/manager_users/', 'refresh');
    	}
    	elseif ($param1 == 'delete') {
    		$this->db->where('no', $param2);
    		$this->db->delete('usertable');
    		redirect(base_url() . 'index.php?admin/manager_users/', 'refresh');
    	}	
    	$page_data['page_name']  = 'manager_users';
    	$page_data['page_title'] = get_phrase('User Management');
    	$this->load->view('backend/index', $page_data);
    }
    
    
    // register part
    function customer_login()
    {
            $response = array();	
            //Recieving post input of email, password from ajax request
            $email 		= $_POST["email"];
            $password 	= $_POST["password"];            
            $response['submitted_data'] = $_POST;		
            //Validating login
            $login_status = $this->validate_login( $email ,  $password );
            $response['login_status'] = $login_status;
            
            if ($login_status == 'success') {                                    
                redirect(site_url("user"), 'refresh');            
            }  
            //Replying ajax request with validation response
            redirect(site_url("user"), 'refresh');
    }
    
        
    function update_profile(){        
        $user_id = $this->session->userdata('admin_id');
        
        if($user_id != null){
            $data['name']        = $this->input->post('fname');
            $data['surname']        = $this->input->post('lname');
            $data['email']        = $this->input->post('email');
            
            if($this->input->post('password') != null && $this->input->post('password') != ""){
                $data['password']        = $this->input->post('password');	
                $confirm      = $this->input->post('confirmpassword');
            }
                        
            $data['phone']        = $this->input->post('phone');	
            $data['birthday']        = $this->input->post('birthday');
            
            if($confirm == $data['password']){
                $this->db->where('no', $user_id);
                $this->db->update('usertable', $data);            
            }
            redirect(site_url("user/my_profile"), 'refresh');
            
        }                        
        
    }
}
