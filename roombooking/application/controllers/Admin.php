<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	date	: 1 August, 2014
 * 	University Of Dhaka, Bangladesh
 * 	Ekattor School & College Management System
 * 	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->library('PHPMailer');
        $this->load->library('stripe');  
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {

        if ($this->session->userdata('admin_login') == 1 || $this->session->userdata('admin_login') == 2 || $this->session->userdata('admin_login') == 3) {
            redirect(site_url("admin/manager_customer"), 'refresh');
        }
        //if ($this->session->userdata('admin_login') != 1)
        //    redirect(site_url("admin/dashboard"), 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
            
        }else{
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name'] = 'dashboard page';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('index', $page_data);

    }

    /*     * *Faculty Manager** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if (($this->session->userdata('admin_login') != 1)) {
            if (($this->session->userdata('admin_login') != 2)) {
                redirect(base_url(), 'refresh');
            }
        }
        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('no', $this->session->userdata('admin_id'));
            $this->db->update('usertable', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(site_url("admin/manage_profile"), 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = $this->input->post('password');
            $data['new_password'] = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');

            $current_password = $this->db->get_where('usertable', array('no' => $this->session->userdata('admin_id')))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('no', $this->session->userdata('admin_id'));
                $this->db->update('usertable', array('password' => $data['new_password']));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(site_url("admin/manage_profile"), 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('usertable', array('no' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /** department manager* */
    /*     * hour* */

    function manager_provider($param1 = '', $param2 = '', $param3 = '') {
        if (($this->session->userdata('admin_login') != 1)) {
            if (($this->session->userdata('admin_login') != 2)) {
                redirect(base_url(), 'refresh');
            }
        }
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['personalNo'] = $this->input->post('personalNo');
            $data['code'] = $this->input->post('code');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');

            $data['company'] = $this->session->userdata('admin_id');
            $data['password'] = "000000";
            $data['user_type'] = 1;
            $this->db->insert('usertable', $data);
            redirect(site_url("admin/manager_provider"), 'refresh');
        } elseif ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['personalNo'] = $this->input->post('personalNo');
            $data['code'] = $this->input->post('code');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');

            $this->db->where('no', $param2);
            $this->db->update('usertable', $data);
            redirect(site_url("admin/manager_provider"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('no', $param2);
            $this->db->delete('usertable');
            redirect(site_url("admin/manager_provider"), 'refresh');
        }

        $page_data['page_name'] = 'manager_provider';
        $page_data['page_title'] = get_phrase('Provider');
        $this->load->view('backend/index', $page_data);
    }

    function manager_guider($param1 = '', $param2 = '', $param3 = '') {

        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['code'] = $this->input->post('code');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            $data['surname'] = $this->input->post('surname');
            $data['sex'] = $this->input->post('sex');
            $data['startdate'] = $this->input->post('startdate');
            $data['enddate'] = $this->input->post('enddate');
            $data['agree'] = $this->input->post('agree');
            $data['salary'] = $this->input->post('salary');

            $data['company'] = $this->session->userdata('admin_id');
            $data['user_type'] = 2;
            $this->db->insert('usertable', $data);
            $insert_id = $this->db->insert_id();

            $updatedata['personalNo'] = substr("00000" . $insert_id, -6);
            $this->db->where('no', $insert_id);
            $this->db->update('usertable', $updatedata);

            redirect(site_url("admin/manager_guider"), 'refresh');
        } elseif ($param1 == 'do_update') {

            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['personalNo'] = $this->input->post('personalNo');
            $data['code'] = $this->input->post('code');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            $data['surname'] = $this->input->post('surname');
            $data['sex'] = $this->input->post('sex');
            $data['startdate'] = $this->input->post('startdate');
            $data['enddate'] = $this->input->post('enddate');
            $data['agree'] = $this->input->post('agree');
            $data['salary'] = $this->input->post('salary');

            $this->db->where('no', $param2);
            $this->db->update('usertable', $data);
            redirect(site_url("admin/manager_guider"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('no', $param2);
            $this->db->delete('usertable');
            redirect(site_url("admin/manager_guider"), 'refresh');
        }
        $page_data['page_name'] = 'manager_guider';
        $page_data['page_title'] = get_phrase('Tour Guider');
        $this->load->view('backend/index', $page_data);
    }

    function manager_customer($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
        if ($param1 == 'create') {

            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['code'] = $this->input->post('code');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            $data['surname'] = $this->input->post('surname');
            $data['sex'] = $this->input->post('sex');
            $data['startdate'] = $this->input->post('startdate');
            $data['enddate'] = $this->input->post('enddate');
            $data['agree'] = $this->input->post('agree');
            $data['salary'] = $this->input->post('salary');

            $data['parentId'] = $this->input->post('parentId');
            $data['company'] = $this->session->userdata('admin_id');

            $data['user_type'] = 3;
            $this->db->insert('usertable', $data);
            $insert_id = $this->db->insert_id();

            $updatedata['personalNo'] = substr("00000" . $insert_id, -6);
            $this->db->where('no', $insert_id);
            $this->db->update('usertable', $updatedata);

            redirect(site_url("admin/manager_customer"), 'refresh');
        } elseif ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['personalNo'] = $this->input->post('personalNo');
            $data['code'] = $this->input->post('code');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            $data['surname'] = $this->input->post('surname');
            $data['sex'] = $this->input->post('sex');
            $data['startdate'] = $this->input->post('startdate');
            $data['enddate'] = $this->input->post('enddate');
            $data['agree'] = $this->input->post('agree');
            
            $data['parentId'] = $this->input->post('parentId');
            $this->db->where('no', $param2);
            $this->db->update('usertable', $data);
            redirect(site_url("admin/manager_customer"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('no', $param2);
            $this->db->delete('usertable');
            redirect(site_url("admin/manager_customer"), 'refresh');
        }
        $page_data['page_name'] = 'manager_customer';

        if($this->session->userdata('admin_login') == 1){
            $page_data['page_title'] = get_phrase('Admin');
        }else if($this->session->userdata('admin_login') == 2){
            $page_data['page_title'] = get_phrase('Sale Man');
        }else if($this->session->userdata('admin_login') == 3){
            $page_data['page_title'] = get_phrase('Clients');
        }
        $this->load->view('index', $page_data);
    }
    /** basic data * */
   function manager_category($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
        $this->load->helper('form');
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/category/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|psd|mp3|mp4|doc|csv';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $datas['upload_data'] = '';
        if (!$this->upload->do_upload('userlogo')) {
            $datas = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $datas = array('msg' => "Upload success!");
            $upload_data = $this->upload->data();
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];
        $userfilefull_path = $upload_data['full_path'];
        
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['image'] = "uploads/category/".$file_name;
            $data['company'] = $this->session->userdata('admin_id');
            $this->db->insert('category', $data);
            redirect(site_url("admin/manager_category"), 'refresh');
        } elseif ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            if($file_name != null && $file_name != ""){
                $data['image'] = "uploads/category/".$file_name;
            }            
            $this->db->where('id', $param2);
            $this->db->update('category', $data);
            redirect(site_url("admin/manager_category"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('category');
            redirect(site_url("admin/manager_category"), 'refresh');
        }
        $page_data['page_name'] = 'manager_category';
        $page_data['page_title'] = get_phrase('Category Management');
        $this->load->view('index', $page_data);
    }
       
    
    function manager_transaction($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
             
        $page_data['page_name'] = 'manager_transaction';
        $page_data['page_title'] = get_phrase('Transactions');
        $this->load->view('index', $page_data);
    }

    function manager_room_type($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}

        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');

            $this->db->insert('room_type', $data);
            redirect(site_url("admin/manager_room_type"), 'refresh');
        } elseif ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $this->db->where('id', $param2);
            $this->db->update('room_type', $data);
            redirect(site_url("admin/manager_room_type"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('room_type');
            redirect(site_url("admin/manager_room_type"), 'refresh');
        }
        $page_data['page_name'] = 'manager_room_type';
        $page_data['page_title'] = get_phrase('Room Type');
        $this->load->view('index', $page_data);
    }
        
    function manager_payment($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
        $page_data['page_name'] = 'manager_payment';
        $page_data['page_title'] = get_phrase('Payment Track');
        $this->load->view('index', $page_data);
    }
    
    function manager_monthly_transaction($param1 = '', $param2 = '', $param3 = '') {
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                
        $sql = "SELECT  YEAR(dt) as  year, MONTH(dt) as  dt, sum(amount) as am FROM `transaction` GROUP BY MONTH(dt), YEAR(dt)";
        $query = $this->db->query($sql);
        $q = $query->result_array();
                
        $page_data['page_name'] = 'manager_monthly_transaction';
        $page_data['page_title'] = get_phrase('Payment Monthly Track');
        $page_data['data'] = $q;        
        
        $this->load->view('index', $page_data);               
    }

    
    function make_payment($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
    
        $page_data['page_name'] = 'make_payment';
        $page_data['page_title'] = get_phrase('Make Payment');
        $this->load->view('index', $page_data);
    }
    
    function payment($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}        
        $page_data['page_name'] = 'payment';
        $page_data['rsv_id'] = $param1;
        $page_data['tour_id'] = $param2;
        $page_data['page_title'] = get_phrase('Payment');
        $this->load->view('backend/index', $page_data);
    }
    
    
    function chat($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}      
        $page_data['page_name'] = 'chat';
        $page_data['page_title'] = get_phrase('Chat');
        $this->load->view('backend/index', $page_data);
    }
    
    
     function chart_report($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
//        $q = $this->db->select('sum(real_price) as  price , COUNT(id) as count')
//                      ->from('reservation')
//                      //->join('states', 'continents.id=states.continent_id','left')
//                      ->group_by('month')
//                      //->order_by('states_count', 'desc');
//                      ->get();
        
        
        $SQL = "select * from reservation group by month";
        $query = $this->db->query($SQL);
        $q = $query->result_array();
        
        $company = $this->session->userdata('admin_id');           
        $first = "select rsv.id, rsv.ticket_count, rsv.real_price,tr.price ,rsv.company from reservation as rsv LEFT JOIN transaction as tr ON rsv.id = tr.reservation_id where rsv.company='".$company."'";
        $second = "select  rsv_addons.reservation_id , sum(rsv_addons.price) price from rsv_addons group by reservation_id";
        $third = "select count(rsv.id) as book, sum(rsv.ticket_count) as tickets, sum(rsv.real_price) as tour_price, sum(rsv.price) as total_price, sum(addons.price) as addons_price  from (".$first.") as rsv LEFT JOIN (".$second.") as addons ON rsv.id = addons.reservation_id group by rsv.company";            
        $query = $this->db->query($third);
        $addons = $query->result_array();                            
        
        $page_data['page_name'] = 'chart_report';
        $page_data['data'] = $q;        
        $page_data['addons'] = $addons;
        $page_data['page_title'] = get_phrase('Chart Report');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    function setting_contact($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}

        if ($param1 == 'do_update') {
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $this->db->where('id', $param2);
            $this->db->update('setting_contact', $data);
            redirect(site_url("admin/setting_contact"), 'refresh');
        }         
        $page_data['page_name'] = 'setting_contact';
        $page_data['page_title'] = get_phrase('Setting Contact Us');
        $this->load->view('index', $page_data);
    }
        
   function setting_file($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
        $this->load->helper('form');
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/video/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|psd|mp3|mp4|doc|csv';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $datas['upload_data'] = '';
        if (!$this->upload->do_upload('video_file')) {
            $datas = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $datas = array('msg' => "Upload success!");
            $upload_data = $this->upload->data();
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];
        $userfilefull_path = $upload_data['full_path'];
        
        if ($param1 == 'do_update') {
            
            if($file_name != null && $file_name != ""){
                $data['video_file'] = "uploads/video/".$file_name;
            }            
            $this->db->where('id', $param2);
            $this->db->update('setting_contact', $data);
            redirect(site_url("admin/setting_file"), 'refresh');
        }
                
        $page_data['page_name'] = 'setting_file';
        $page_data['page_title'] = get_phrase('Setting Video File');
        $this->load->view('index', $page_data);
    }
    

    
    function reservations($param1 = '', $param2 = '', $param3 = '') {
          
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                
        if ($param1 == 'create') {
            $data['tour_id'] = $this->input->post('tour_id');
            $data['guider_id'] = $this->input->post('guider_id');
            $data['start_time'] = $this->input->post('startTime');
            $data['end_time'] = $this->input->post('endTime');
            $data['company'] = $this->session->userdata('admin_id');
            $this->db->insert('tour_guider', $data);            
            redirect(site_url("admin/reservations"), 'refresh');
        } elseif ($param1 == 'do_update') {            
            $data['state'] = $param3;
            $this->db->where('id', $param2);
            $this->db->update('reservation', $data);            
            $customer_id = $this->db->get_where('reservation', array('id'=>$param2))->row()->user_id;            
            
            $tour_id =  $this->db->get_where('reservation', array('id'=>$param2))->row()->tour_id;      
            $tour_data = $this->db->get_where('tour', array('id'=>$tour_id))->row(); 
            $rsv_data  = $this->db->get_where('reservation', array('id'=>$param2))->row(); 
            
            $user_data = $this->db->get_where('usertable',array('no'=>$customer_id))->row();   
            $customer_email = $user_data->email;            
            $customer_email = $this->db->get_where('usertable',array('no'=>$customer_id))->row()->email;            
            $messge = "Welcome,  Youre request Accpted !!!";
                                    
            if($param3 == 2){                                              
                $message = $this->db->get_where('email', array('id'=>1))->row();
                $body = $message->body;
                $body = str_replace("{{activity}}",$tour_data->name ,$body);
                $body = str_replace("{{count}}",$rsv_data->ticket_count ,$body);
                $body = str_replace("{{date}}",$rsv_data->date ,$body);
                
                $this->sendMail("kingstarboy@outlook.com", "Hi ".$user_data->name , $body);    //$customer_email
            }else if($param3 == 4){
                $message = "";
                $message = $message."Completed your reservations";
                $message = $message."plz make the review"."http://surfyoutothemoon.co/surfmoon/index.php/user/my_reservation";
                $this->sendMail($customer_email, "Surf to you moon", $messge);                           
            }                                 
            redirect(site_url("admin/reservations"), 'refresh');
            
        } elseif ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('reservation');
            redirect(site_url("admin/reservations"), 'refresh');
        }       
        
        
        
        $tours = json_decode(
            file_get_contents('https://api.rezdy.com/v1/bookings?apiKey=e8057c57e6844309b8b511012e979c58'), true
        );
        $requestStatus = $tours['requestStatus'];
        $success = $requestStatus['success'];                        
        
        if($success == true){
            
            $bookings = $tours['bookings'];                 
            $page_data['page_name'] = 'reservations';
            $page_data['hours'] = $bookings;
            $page_data['page_title'] = get_phrase('Reservations');
            $this->load->view('index', $page_data);
            
        }else{
            
            if($param2 != null){
            $hours = $this->db->get_where('reservation', array('date'=>$param2))->result_array();
            } else {
                $hours = $this->db->get('reservation')->result_array();
            }        
            $page_data['page_name'] = 'reservations';
            $page_data['hours'] = $hours;
            $page_data['page_title'] = get_phrase('Reservations');
            $this->load->view('index', $page_data);
        }                         
    }
    
    
    function reservation_cancel($param1 = '', $param2 = '', $param3 = '') {
          
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                
        if ($param1 == 'do_update') {
            $data['state'] = $param3;
            $this->db->where('id', $param2);
            $this->db->update('reservation', $data);    
            
            $customer_id = $this->db->get_where('reservation', array('id'=>$param2))->row()->user_id;      
            $tour_id =  $this->db->get_where('reservation', array('id'=>$param2))->row()->tour_id;      
            $tour_data = $this->db->get_where('tour', array('id'=>$tour_id))->row();  
            
            $user_data = $this->db->get_where('usertable',array('no'=>$customer_id))->row();   
            $customer_email = $user_data->email;            
            $messge = "Welcome,  Youre request Accpted !!!";                        
            if($param3 == 2){
                                                                
                $message = $this->db->get_where('email', array('id'=>1))->row();
                $body = $message->body;
                $body = str_replace("{{activity}}",$tour_data->name ,$body);
                
                $this->sendMail($customer_email, $message->subject , $body);   //$customer_email
            }else if($param3 == 4){
                $message = "";
                $message = $message."Completed your reservations";
                $message = $message."plz make the review"."http://surfyoutothemoon.co/surfmoon/index.php/user/my_reservation";
                $this->sendMail($customer_email, "Hi ".$user_data->name , $messge);                           
            }                                 
            redirect(site_url("admin/reservations"), 'refresh');            
        }        
        $hours = $this->db->get_where('reservation', array('paid'=>1))->result_array();
        $page_data['page_name'] = 'reservation_cancel';
        $page_data['hours'] = $hours;
        $page_data['page_title'] = get_phrase('Cancel Reservations');
        $this->load->view('index', $page_data);
        
    }
    
    
    
    function reservation_reschedule($param1 = '', $param2 = '', $param3 = '') {
          
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                            
        $hours = $this->db->get_where('reservation', array('state'=>2))->result_array();
        $page_data['page_name'] = 'reservation_reschedule';
        $page_data['hours'] = $hours;
        $page_data['page_title'] = get_phrase('Reschedule Reservations');
        $this->load->view('index', $page_data);        
    }
    
    
    function add_reservation($param1 = '', $param2 = '', $param3 = ''){
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
    
        $page_data['page_name'] = 'add_reservation';        
        $page_data['page_title'] = get_phrase('Add Reservation');
        $this->load->view('index', $page_data);        
    }
    
    function refund($param1 = '', $param2 = '', $param3 = ''){
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
    
        $page_data['rsv_id'] = $param1;        
        $page_data['page_name'] = 'refund';        
        $page_data['page_title'] = get_phrase('Refund');
        $this->load->view('index', $page_data);        
    }
    
    
     function email($param1 = '', $param2 = '', $param3 = ''){
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
            
        $page_data['page_name'] = 'email';
        $page_data['page_title'] = get_phrase('Email Format');
        $this->load->view('index', $page_data);        
    }
    
    
    function reservation_details($param1 = '', $param2 = '', $param3 = ''){
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}    
        
        $rsv_id = $param1;
        $tour_id = $param2;
        $user_id = $param3;
        
        $page_data['rsv_id'] = $rsv_id;
        $page_data['tour_id'] = $tour_id;
        $page_data['user_id'] = $user_id;
        
        $page_data['page_name'] = 'reservation_details';        
        $page_data['page_title'] = get_phrase('Reservation Details');        
        $this->load->view('backend/index', $page_data);        
    }
        
    function reservation_edit($param1 = '', $param2 = '', $param3 = ''){
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
        
        $rsv_id = $param1;
        $tour_id = $param2;
        $user_id = $param3;
        
        $page_data['rsv_id'] = $rsv_id;
        $page_data['tour_id'] = $tour_id;
        $page_data['user_id'] = $user_id;
        
        $page_data['page_name'] = 'reservation_edit';        
        $page_data['page_title'] = get_phrase('Reschedule Reservation ');        
        $this->load->view('backend/index', $page_data);        
    }
    
    
    function tour_all($param1 = '', $param2 = '', $param3 = '') {
        if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
      
        
        if($param1 != null && $param1 != ""){
            $hours = $this->db->get_where('tour', array('date' => $param1))->result_array();     
        }else{
            if($this->session->userdata('admin_login') == 1){
                $hours = $this->db->get('tour')->result_array();        
            }else{
                $hours = $this->db->get_where('tour', array('provider_id' => $this->session->userdata('admin_id')))->result_array();     
            }            
        }
        
        $page_data['page_name'] = 'tour_all';
        $page_data['hours'] = $hours;
        $page_data['page_title'] = get_phrase('All Tours');
        $this->load->view('backend/index', $page_data);
    }
    
    
    function tour_city($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}

        if ($param1 == 'delete') {
            $this->load->helper('file');
            $logo = $this->db->get_where('city', array('id' => $param2))->row()->image;
            unlink($logo);            
            $this->db->where('id', $param2);
            $this->db->delete('city');
            redirect(site_url("admin/tour_city"), 'refresh');
        }
        
        $page_data['page_name'] = 'tour_city';
        $page_data['page_title'] = get_phrase('Tour City ');
        $this->load->view('backend/index', $page_data);
    }

    function tour_city_list($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                
        if ($param1 == 'create') {
           
        } elseif ($param1 == 'do_update') {
            
        } elseif ($param1 == 'delete') {
            $this->load->helper('file');
            $logo = $this->db->get_where('tour', array('id' => $param2))->row()->image_url;
            $file = $this->db->get_where('tour', array('id' => $param2))->row()->video_url;
            unlink($logo);
            unlink($file);            
            delete_files($logo);
            delete_files($file);
            $this->db->where('id', $param2);
            $this->db->delete('tour');
            redirect(site_url("admin/tour_city_list/".$param3), 'refresh');
        }

        //get data with param1
        $page_data['id'] = $param1;
        $page_data['page_name'] = 'tour_city_list';
        $page_data['page_title'] = get_phrase('All tours in city');
        $this->load->view('backend/index', $page_data);
    }
    
    function tour_category($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                    
        if ($param1 == 'delete') {
            
            $this->load->helper('file');
            $logo = $this->db->get_where('category', array('id' => $param2))->row()->image;
            unlink($logo);            
            
            $this->db->where('id', $param2);
            $this->db->delete('category');
            redirect(site_url("admin/tour_category"), 'refresh');
        }
        
        $page_data['page_name'] = 'tour_category';
        $page_data['page_title'] = get_phrase('Tour By Category');
        $this->load->view('backend/index', $page_data);
    }    
        
    function tour_category_list($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}                       
        //get data with param1
        if ($param1 == 'create') {
           
        } elseif ($param1 == 'do_update') {
            
        } elseif ($param1 == 'delete') {
            $this->load->helper('file');
            $logo = $this->db->get_where('tour', array('id' => $param2))->row()->image_url;
            $file = $this->db->get_where('tour', array('id' => $param2))->row()->video_url;
            unlink($logo);
            unlink($file);            
            delete_files($logo);
            delete_files($file);
            $this->db->where('id', $param2);
            $this->db->delete('tour');
            redirect(site_url("admin/tour_category_list/".$param3), 'refresh');
        }
        
        $page_data['id'] = $param1;
        $page_data['page_name'] = 'tour_category_list';
        $page_data['page_title'] = get_phrase('All tours in category');
        $this->load->view('backend/index', $page_data);
    }
    
    
     function manager_city($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                
        $this->load->helper('form');
        //Configure
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/city/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|psd|mp3|mp4|doc|csv';
        //load the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $datas['upload_data'] = '';
        //if not successful, set the error message
        if (!$this->upload->do_upload('userlogo')) {
            $datas = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $datas = array('msg' => "Upload success!");
            $upload_data = $this->upload->data();
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];
        $userfilefull_path = $upload_data['full_path'];
                
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['latitude'] = $this->input->post('lat');
            $data['longitude'] = $this->input->post('lon');
            $data['image'] = "uploads/city/".$file_name;       
            $data['company'] = $this->session->userdata('admin_id');
            $this->db->insert('city', $data);
            redirect(site_url("admin/manager_city"), 'refresh');
        } elseif ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            if($file_name != null && $file_name != ""){
                $data['image'] = "uploads/city/".$file_name;                     
            }            
            $this->db->where('id', $param2);
            $this->db->update('city', $data);
            redirect(site_url("admin/manager_city"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('city');
            redirect(site_url("admin/manager_city"), 'refresh');
        }

        $page_data['page_name'] = 'manager_city';
        $page_data['page_title'] = get_phrase('City Management');
        $this->load->view('index', $page_data);
    }    
    
    function manager_room($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
                
        $this->load->helper('form');
        //Configure
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/room/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|psd|mp3|mp4|doc|csv';
        //load the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $datas['upload_data'] = '';
        //if not successful, set the error message
        if (!$this->upload->do_upload('userlogo')) {
            $datas = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $datas = array('msg' => "Upload success!");
            $upload_data = $this->upload->data();
        }
                
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];
        $userfilefull_path = $upload_data['full_path'];
                        
        if ($param1 == 'create') {
            
            $dataa['name'] = $this->input->post('name');
            $dataa['image_url'] = 'uploads/room/'.$file_name; 
            $dataa['description'] = $this->input->post('description');
            $dataa['city_id'] = $this->input->post('city_id');
            //$dataa['country_id'] = $country_id;                                    
            $dataa['lat'] = $this->input->post('lat');
            $dataa['lon'] = $this->input->post('lon');
            $dataa['tour_type'] = $this->input->post('room_type');
            $dataa['provider_id'] = $this->session->userdata('admin_id');
            //$dataa['video_id'] = $this->input->post('video_id');   
            //$dataa['max_count'] = $this->input->post('max_count');
            $dataa['price'] = $this->input->post('price');    
            
            $dataa['summary'] = $this->input->post('summary'); 
            $dataa['location'] = $this->input->post('summary');               
            //$dataa['product_code'] = $row['productCode'];            
            $dataa['tour_type'] = 1;            
            $dataa['no_of_bed'] = $this->input->post('no_of_bed'); 
            $dataa['capacity'] = $this->input->post('capacity');
            
            $this->db->insert('room', $dataa);                                                            
            redirect(site_url("admin/manager_room"), 'refresh');
        } elseif ($param1 == 'do_update') {
                           
            $dataa['name'] = $this->input->post('name');            
            if($file_name != null && $file_name != ""){
                $dataa['image_url'] = 'uploads/room/'.$file_name; 
            }            
            $dataa['description'] = $this->input->post('description');
            $dataa['city_id'] = $this->input->post('city_id');
            //$dataa['country_id'] = $country_id;                                    
            $dataa['lat'] = $this->input->post('lat');
            $dataa['lon'] = $this->input->post('lon');
            $dataa['tour_type'] = $this->input->post('room_type');
            $dataa['provider_id'] = $this->session->userdata('admin_id');
            //$dataa['video_id'] = $this->input->post('video_id');   
            //$dataa['max_count'] = $this->input->post('max_count');
            $dataa['price'] = $this->input->post('price');    
            
            $dataa['summary'] = $this->input->post('summary'); 
            $dataa['location'] = $this->input->post('summary');               
            //$dataa['product_code'] = $row['productCode'];            
            $dataa['tour_type'] = 1;            
            $dataa['no_of_bed'] = $this->input->post('no_of_bed'); 
            $dataa['capacity'] = $this->input->post('capacity');
                                    
            $this->db->where('id', $param2);
            $this->db->update('room', $dataa);
            redirect(site_url("admin/manager_room"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('room');
            redirect(site_url("admin/manager_room"), 'refresh');
        }
        $page_data['page_name'] = 'manager_room';
        $page_data['page_title'] = get_phrase('Room Management');
        $this->load->view('index', $page_data);
    }
    
    
        
    function contact_message($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}

        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('contact_us');
            redirect(site_url("admin/contact_message"), 'refresh');
        }        
        $page_data['page_name'] = 'contact_message';
        $page_data['page_title'] = get_phrase('Contact Message');
        $this->load->view('index', $page_data);
    }
    
    
     function basic_blog($param1 = '', $param2 = '', $param3 = '') {
          if (($this->session->userdata('admin_login') == 1) || ($this->session->userdata('admin_login') == 2) || ($this->session->userdata('admin_login') == 3)) {           
        }else{redirect(base_url(), 'refresh');}
       
        $this->load->helper('form');
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/blog/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|psd|mp3|mp4|doc|csv';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $datas['upload_data'] = '';
        if (!$this->upload->do_upload('userlogo')) {
            $datas = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $datas = array('msg' => "Upload success!");
            $upload_data = $this->upload->data();
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];
        $userfilefull_path = $upload_data['full_path'];
        
        if ($param1 == 'create') {
            $data['title'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['image'] = "uploads/blog/".$file_name;
            
            $this->db->insert('blog', $data);
            redirect(site_url("admin/basic_blog"), 'refresh');
        } elseif ($param1 == 'do_update') {
            $data['title'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            if($file_name != null && $file_name != ""){
                $data['image'] = "uploads/blog/".$file_name;
            }            
            $this->db->where('id', $param2);
            $this->db->update('blog', $data);
            redirect(site_url("admin/basic_blog"), 'refresh');
        } elseif ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('blog');
            redirect(site_url("admin/basic_blog"), 'refresh');
        }        
        $page_data['page_name'] = 'basic_blog';
        $page_data['page_title'] = get_phrase('Blog');
        $this->load->view('index', $page_data);
    } 
    var $ii = 0;

    //$link = mysql_connect('localhost', 'root', '');
    //mysql_select_db("zebretv", $link);



    /*     * Audio List* */

    function upload($param1 = '', $param2 = '', $param3 = '') {
        $page_data['page_name'] = 'manager_hour';
        $page_data['page_title'] = get_phrase('manager_hour');
        $this->load->view('backend/index', $page_data);
    }

    function getBasicData() {

        $name = $this->input->post('name');
        $pass = $this->input->post('password');
        $currentTime = $this->input->post('currentTime');
        $company = $this->db->get_where('usertable', array('name' => $name, 'user_type' => 2))->row()->company;
        $foremanNo = $this->db->get_where('usertable', array('name' => $name, 'user_type' => 2))->row()->no;

        if ($company != null) {

            $data['name'] = $name;
            $data['dt'] = $currentTime;
            $data['company'] = $company;

            $id = $this->db->insert('task', $data);
            $insert_id = $this->db->insert_id();

            $user = $this->db->get_where('usertable', array('company' => $company))->result_array();
            $work = $this->db->get_where('work', array('company' => $company))->result_array();
            //$fruitplace =  $this->db->get_where('fruitplace' , array('company'=>$company))->result_array();

            $this->db->select('b.name, c.name as quality , a.price');
            $this->db->from('fruitplace a');
            $this->db->join('fruit b', 'b.id=a.name', 'left');
            $this->db->join('quality c', 'c.id =a.quality', 'left');
            $this->db->where('a.company', $company);
            $fruitplace = $this->db->get()->result_array();


            $container = $this->db->get_where('container', array('company' => $company))->result_array();
            $fruit = $this->db->get_where('fruit', array('company' => $company))->result_array();
            $field = $this->db->get_where('field', array('company' => $company))->result_array();
            $quantity = $this->db->get_where('quantity', array('company' => $company))->result_array();


            // success
            $arr = array('user' => $user, 'work' => $work, 'fruitplace' => $fruitplace, 'container' => $container, 'fruit' => $fruit, 'field' => $field, 'quantity' => $quantity, 'taskId' => $insert_id, 'company' => $company, 'foremanNo' => $foremanNo, "response" => "100");
            $response["config"] = $arr;
            // echoing JSON response
            //add the header here
            header('Content-Type: application/json');
            echo json_encode($arr);
        } else {
            $arr = array('response' => $name);
            header('Content-Type: application/json');
            echo json_encode($arr);
        }
    }

    function loginCheck() {

        // $current_password = $this->db->get_where('usertable', array('name' = $this->input->post('name'))->row()->password;

        $name = $this->input->post('name');
        $pass = $this->input->post('password');

        $current_password = $this->db->get_where('usertable', array('name' => $name))->row()->password;
        $response = "as";
        if ($current_password == $pass) {
            $response = array('response' => "100");
        } else {
            $response = array('response' => "200");
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function import() {
        $this->load->helper('form');
        //Configure
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|psd|mp3|mp4|doc|csv';
        //load the upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $data['upload_data'] = '';

        //if not successful, set the error message
        if (!$this->upload->do_upload('userfile')) {
            $data = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $data = array('msg' => "Upload success!");
            $upload_data = $this->upload->data();
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];
        $userfilefull_path = $upload_data['full_path'];

        //-------------for image resize -----------

        $this->load->library('image_lib');

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/' . $file_name;
        $config['create_thumb'] = false;
        $config['new_image'] = $file_name;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 200;
        $config['height'] = 150;
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();



        if ($file_name != "") {
            //  $csv = array_map('str_getcsv', file('csv_file.csv'));
            $res = $this->csvimport->get_array('uploads/' . $file_name);
            foreach ($res as $row) {
                $dataa['name'] = $row['name'];
                if ($dataa['name'] == null) {
                    break;
                }
                $dataa['email'] = $row['email'];
                $dataa['address'] = $row['address'];
                $dataa['code'] = $row['code'];
                $dataa['city'] = $row['city'];
                $dataa['country'] = $row['country'];
                $dataa['surname'] = $row['surname'];
                $dataa['sex'] = $row['sex'];
                $dataa['startdate'] = $row['startdate'];
                $dataa['enddate'] = $row['enddate'];
                $dataa['agree'] = $row['agree'];
                $dataa['salary'] = $row['salary'];
                $dataa['company'] = $row['company'];
                $dataa['user_type'] = $row['user_type'];
                $this->db->insert('usertable', $dataa);
            }
            unlink('uploads/' . $file_name);
        }

        redirect(base_url() . 'index.php?admin/manager_provider/', 'refresh');
    }

    function delete_user($param1 = '') {
        if (($this->session->userdata('admin_login') != 1)) {
            if (($this->session->userdata('admin_login') != 2)) {
                redirect(base_url(), 'refresh');
            }
        }
        $this->db->where('company', $this->session->userdata('admin_id'));
        $this->db->delete('usertable');
        redirect(base_url() . 'index.php?admin/manager_provider/', 'refresh');
    }

    function getTimeline() {

        $company = $_POST["company"];
        //$shifts = $this->db->get_where('shift', array('company' => $company))->result_array();
        $this->db->select('b.name, c.name as work , a.starttime, a.endtime, a.taskId , a.totaltime');
        $this->db->from('shift a');
        $this->db->join('usertable b', 'b.no=a.personalNo', 'left');
        $this->db->join('work c', 'c.id =a.workId', 'left');
        $this->db->where('a.company', $company);
        $shifts = $this->db->get()->result_array();
        echo json_encode($shifts);
    }

   
    public function sendMail($receiver, $title,  $message){
       
        $mail = new PHPMailer();
        $mail->ContentType = "text/html";
        $mail->Charset = "utf-8";
        $mail->Encoding = "base64";
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; //tls    ssl

        $mail->Host = "surfyoutothemoon.com"; //Hostname of the mail server
        $mail->Port = 465;
        $mail->Username = "kingstarboy@surfyoutothemoon.co"; //email account
        $mail->Password = "Ua;[Z*+BKhc)";

        $webmaster_email = "kingstarboy@surfyoutothemoon.co"; //email account
        $mail->From = $webmaster_email;
        $mail->FromName = "Surf You To The Moon"; //admin
        
        
        $mail->AddReplyTo($webmaster_email, "Surf moon");
        $mail->WordWrap = 50;
        $mail->IsHTML(true);

        $mail->Subject = $title;//"subject";
        $mail->Body = $message; //"message";
        $mail->AltBody = "";
        $mail->IsSMTP();
        //$name = "Parent";
        $email = $receiver;//"kingstarboy@outlook.com";
        $mail->AddAddress($email);//, $name);
                     
        if (!$mail->Send()) {
          //  echo "Mailer Error: " . $mail->ErrorInfo;        
        } else {
          //  echo "Message sent!";
        }        
    }
    
    
    public function update_note(){       
        $rsv_id =  $this->input->post('rsv_id');
        $data['note'] = $this->input->post('note');        
        $this->db->where('id', $rsv_id);
        $this->db->update('reservation', $data);                                
        $arr = array('result'=> 'success');                    
        header('Content-Type: application/json');
        echo json_encode($arr);       
    }  
    
}
