<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public $apiKey  = "e8057c57e6844309b8b511012e979c58234123423";
    
    
    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
         $this->load->library('PHPMailer');
        $this->load->library('stripe');  
    }
    
    public function index() {
        
        $country = $this->db->get_where('country')->result_array();                        
        $res = $this->db->get_where('country', array('name'=>'us'))->row();
        if($res != null){
            $country_id  = $res->id;
            $city = $this->db->get_where('city', array('country_id'=>$country_id))->result_array();            
            //$tours = $this->db->get_where('tour', array('country_id'=>$country_id))->result_array();       
            $query = $this->db->query("SELECT * FROM room  ORDER BY id DESC LIMIT 16");
            $tours = $query->result_array();                                
            $page_data['tours'] = $tours; 
            $page_data['country'] = $country; 
            $page_data['city'] = $city;      
            $page_data['country_id'] = $country_id;
            //$this->load->view('rezdy/common/header');  
            $this->load->view('rezdy/customer/index' , $page_data); 
            //$this->load->view('rezdy/common/footer');
        }        
    }    
    public function home($param1 = ''){        
        $country = $this->db->get_where('country')->result_array();                        
        $res = $this->db->get_where('country', array('id'=>$param1))->row();
        if($res != null){
            $country_id  = $param1;
            $city = $this->db->get_where('city', array('country_id'=>$country_id))->result_array();            
            $query = $this->db->query("SELECT * FROM tour WHERE country_id='".$country_id."' ORDER BY id DESC LIMIT 16");
            $tours = $query->result_array();
            $page_data['tours'] = $tours; 
            $page_data['country'] = $country; 
            $page_data['city'] = $city;     
            $page_data['country_id'] = $country_id;
            $this->load->view('rezdy/customer/index' , $page_data); 
        }
    }
    
    public function city_tours($param1 = ''){
        $tours = $this->db->get_where('tour', array('city_id'=>$param1))->result_array();
        $page_data['tours'] = $tours ;   
        $this->load->view('rezdy/customer/city_tours' , $page_data);
    }
        
    public function overview($param1 = '', $param2 = '', $param3 = ''){        
        $page_data['id'] = $param1;
        $tour_id = $param1;
        //$room = $this->db->get_where('room', array('id'=>$tour_id))->row();        
        $page_data['id'] = $tour_id;      
        $this->load->view('rezdy/customer/overview', $page_data);               
    }
    
    public function location($param1 = '', $param2 = '', $param3 = ''){   
        $page_data['id'] = $param1;
        $tour_id = $param1;        
        $this->load->view('rezdy/customer/location', $page_data);         
    }
    public function review($param1 = '', $param2 = '', $param3 = ''){                                
        $page_data['id'] = $param1;
        $this->load->view('rezdy/customer/review', $page_data);         
    }
    public function host($param1 = '', $param2 = '', $param3 = ''){                                
        $page_data['id'] = $param1;
        $this->load->view('rezdy/customer/host', $page_data);         
    }
        
    public function tours($param1 = '', $param2 = '', $param3 = ''){                                
        $page_data['id'] = $param1;            
        $tours = $this->db->get_where('room')->result_array();        
        //$tours = $this->db->join('tour', 'city.id = tour.city_id')->result_array();        
        $country = $this->db->get_where('city')->result_array();
        
        $page_data['tours'] = $tours;
        $page_data['countries'] = $country;
        $this->load->view('rezdy/customer/tours', $page_data);                        
    
    }
    
    public function search($param1 = '', $param2 = '', $param3 = ''){                                
        $page_data['id'] = $param1;
        $this->load->view('rezdy/customer/search', $page_data);         
    }
    
     public function done($param1 = '', $param2 = '', $param3 = ''){                                        
        $this->load->view('rezdy/customer/done');
    }
        
    
    public function contactus() {                               
        $this->load->database();        
        //$page_data['messages'] = $this->Messages_model->get_latest_messages();        
        $this->load->view('rezdy/customer/contactus');
        
    }
        
    public function contact(){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $title = $this->input->post('title');
        $message = $this->input->post('message');
        
        $data['name'] = $name;
        $data['email'] = $email;
        $data['title'] = $title;
        $data['message'] = $message;
                                
        $this->db->insert('contact_us', $data);                
        $insert_id = $this->db->insert_id();
        $this->contactus();
    }
 
    
    public function blog() {                          
        $this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/blog');
        $this->load->view('rezdy/common/footer');
    }

    public function testimonials() {                          
        $this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/testimonials');
        $this->load->view('rezdy/common/footer');
    }

    public function blog_detail() {      
        $this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/blog_detail');
        $this->load->view('rezdy/common/footer');
    }
    public function privacy_policy() {      
        $this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/privacy_policy');
        $this->load->view('rezdy/common/footer');
    }
    public function terms() {      
        $this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/terms');
        $this->load->view('rezdy/common/footer');
    }
    public function faq() {      
        $this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/faq');
        $this->load->view('rezdy/common/footer');
    }
        
    public function my_book(){
        //$this->load->view('rezdy/common/header');
        $this->load->view('rezdy/customer/my_book');
        //$this->load->view('rezdy/common/footer');
    }

    public function tours_bad($param1 = '', $param2 = '', $param3 = ''){
        
        $page_data['id'] = $param1;   
        //$countries = $this->db->get_where('city')->result_array();        
        $tours = json_decode(
            file_get_contents('https://api.rezdy.com/v1/products?apiKey=e8057c57e6844309b8b511012e979c58'), true
        );
        $requestStatus = $tours['requestStatus'];
        $success = $requestStatus['success'];                        
        if($success == true){
             $products = $tours['products'];        
             $page_data['tours'] = $products ;                                        
            $result = array();
            foreach($products as $row){
                if(!in_array( $row['locationAddress']['city'] , $result)  && $row['locationAddress']['city'] != ""){
                     array_push($result,$row['locationAddress']['city']);
                }      
            }
            $page_data['countries'] = $result;
            $this->load->view('rezdy/customer/tours', $page_data);     
        }        
    }
    
    public function get_times(){  
        $date = $this->input->post('date'); 
        $productCode = $this->input->post('productCode');        
        //echo 'https://api.rezdy.com/v1/availability/?productCode='.$productCode.'&apiKey=e8057c57e6844309b8b511012e979c58&startTime='.$date.'T00:00:00Z&endTime='.$date.'T23:59:00Z';
        $results = json_decode(
            file_get_contents('https://api.rezdy.com/v1/availability?productCode='.$productCode.'&apiKey=e8057c57e6844309b8b511012e979c58&startTime='.$date.'T00:00:00Z&endTime='.$date.'T23:59:00Z'), true
        );
        $requestStatus = $results['requestStatus'];
        $success = $requestStatus['success'];
        if($success == true){
            $sessions = $results['sessions'];
            $arr = array('sessions' => $sessions);
            header('Content-Type: application/json');
            echo json_encode($arr);
        }      
    }
        
    public function get_available_date(){
        
        $room_id = $this->input->post('id'); 
        
        $query = $this->db->query("SELECT * FROM reservation ORDER BY id DESC LIMIT 1");
        $result = $query->row();
        if($result != null && $result != ""){
            $arr = array('date' => $result->checkout);  
        }else{
            $arr = array('date' => 0);  
        }        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    
    
    
    public function payment(){  
        
        $page_data['date']        = $this->input->post('startDate');
        //$page_data['time']        = $this->input->post('time');
        $page_data['startTime']        = $this->input->post('startDate');
        $page_data['endTime']        = $this->input->post('endDate');        
        $page_data['ticket_count']        = $this->input->post('guest');
        $page_data['tour_id']        = $this->input->post('tid');                
        $this->load->view('rezdy/customer/payment', $page_data);
    }
        
    
    public function make_payment($param1 = ''){
        
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');                
        
        // item info
        $room_id = $this->input->post('room_id');
        $startTime = $this->input->post('startTime');
        $endTime = $this->input->post('endTime');
        $amount = $this->input->post('amount');
        $people = $this->input->post('people');
       
        
        $expMonth = $this->input->post('expiryMonth');                              
        $expYear = $this->input->post('expiryYear');
        $cardNumber = $this->input->post('cardNumber');
        $cv = $this->input->post('cv');
        $amount = $this->input->post('amount');        
        $payment_type = $this->input->post('payment_type');        
        
        // get UserID 
        $userCheck = $this->db->get_where('usertable', array('email' => $email))->row();
        if($userCheck != null && $userCheck != ""){
            $userId = $userCheck->no;
        }else{
            $data['name']        = $firstName;
            $data['surname']        = $lastName;
            $data['email']        = $email;
            $data['phone']        = $phone;            
            $data['address']        = "";
            $data['password']        = default_password();	
            $data['user_type']        = "2";           
            $admin_no = $this->db->get_where('usertable', array('user_type' => 1))->row()->no;
            $data['parentId'] = $admin_no;
            $this->db->insert('usertable', $data);  
            $userId = $this->db->insert_id();
        }
        
        if($payment_type == 1){                                                                                               
            $reservationData['user_id'] = $userId;
            $reservationData['tour_id'] = $room_id;
            $reservationData['ticket_count'] = $people;
            $reservationData['checkin'] = $startTime;
            $reservationData['checkout'] = $endTime;
            $reservationData['real_price'] = $amount;                        
            $this->db->insert('reservation', $reservationData); 
            
            $page_data['message']        = "Success"; 
            $this->load->view('rezdy/customer/done', $page_data);
            
        }else{
            $transaction = $this->stripe->checkOut($cardNumber,$expMonth,$expYear,$cv, $amount * 100);                
            if($transaction == false){              
                 redirect(site_url("user/make_payment"), 'refresh');
            }

            if(sizeof($transaction) > 0 && $transaction != '0'){        
                    $data['transaction_id'] = $transaction;
                    $data['amount'] = $amount;
                    $data['status'] = "Success";
                    $data['client_id'] = $this->session->userdata('admin_id');
                    $this->db->insert('transaction', $data);                                                      
            }

            if(sizeof($transaction) > 0 && $transaction != '0'){            
                $page_data['message'] = "Success";
                $page_data['page_name'] = 'done';
                $page_data['page_title'] = get_phrase('results');
                $this->load->view('index', $page_data);

            }else{                
                redirect(site_url('user/make_payment'), 'refresh');                                            
            }
        }
        
        
        
    }

    
    public function make_payment1(){        
        // customer info
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');        
        $customer = array('firstName'=> $firstName, 'lastName'=>$lastName, 'email'=>$email, 'phone'=>$phone);  
        // item info
        $productCode = $this->input->post('productCode');
        $startTime = $this->input->post('startTime');
        $endTime = $this->input->post('endTime');
        $amount = $this->input->post('amount');
        $people = $this->input->post('people');
        $quantities = array('optionLabel'=>'Adult','value'=>$people, 'optionPrice'=>$amount );
        $quantitiesArray = array();
        array_push($quantitiesArray, $quantities);
        
        $items = array('productCode'=>$productCode, 'startTime'=>$startTime,'endTime'=>$endTime, 'amount'=>$amount , 'quantities'=>$quantitiesArray);
        $itemArray = array();
        array_push($itemArray, $items);

        // credit card info  
        $cardName = 'VISA';//$this->input->post('cardName');
        $cardType = 'VISA';//$this->input->post('cardType');
        $expiryMonth = $this->input->post('expiryMonth');                              
        $expiryYear = $this->input->post('expiryYear');
        $cardNumber = $this->input->post('cardNumber');
        $cardSecurityNumber = $this->input->post('cardSecurityNumber');
        
        $creditCard = array('cardName'=>$cardName, 'cardType'=>$cardType, 'expiryMonth'=>$expiryMonth, 'expiryYear'=>$expiryYear, 'cardNumber'=>$cardNumber,'cardSecurityNumber'=>$cardSecurityNumber);               
        $data = array('customer'=>$customer, 'items'=>$itemArray, 'paymentOption'=>'CREDITCARD', 'creditCard'=>$creditCard);               
        //echo json_encode($data);
                
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rezdy.com/v1/bookings?apiKey=e8057c57e6844309b8b511012e979c58",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 507b2faa-dbb0-cca1-2fbd-da99f97f6a67"
          ),
        ));        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          //echo "cURL Error #:" . $err;            
          $page_data['message'] = $err;
          $this->load->view('rezdy/customer/done', $page_data);
        } else {
         
//            $requestStatus = $response['requestStatus'];
//            $success = $requestStatus['success'];                        
//            if($success == true){
//                $page_data['message'] = "Payment was made successfully!!!";
//                $this->load->view('rezdy/customer/done', $page_data);
//            }else{
//                $page_data['message'] = "Errro";
//                $this->load->view('rezdy/customer/done', $page_data);
//            }                      
            
              $page_data['message'] = "Payment was made successfully!!!";
              $this->load->view('rezdy/customer/done', $page_data);
        }
    }

    
    public function reservation(){        
        //collect inputs 
         $start_date = $this->input->post('startDate');
         $start_time = $this->input->post('startTime');
         $end_date = $this->input->post('endDate');
         $end_time = $this->input->post('endTime');
         
         $data['location_id'] = $this->input->post('location_id');
         $data['user_id'] = $this->session->userdata('admin_id');
         $data['start'] = $start_date." ".$start_time;
         $data['end'] = $end_date." ".$end_time;
                  
		//check inputs don't already exist in database 		  
         $sql = "SELECT * FROM reservation WHERE location_id = '".$data['location_id']."' and start <= '".$data['start']."' and end >= '".$data['start']."'";
         $query  = $this->db->query($sql);
         $check1 = $query->result_array();
                  
         $sql2 = "SELECT * FROM reservation WHERE location_id = '".$data['location_id']."' and start <= '".$data['end']."' and end >= '".$data['end']."'";
         $query  = $this->db->query($sql2);//->result_array();
         $check2 = $query->result_array();
             

         
         if($check1 != null || $check2 != null){                          
             $page_datap['id'] = $data['location_id'];
             $location = $this->db->get_where('location', array('id'=> $page_datap['id']))->row();
             $page_datap['location'] = $location;
             $page_datap['status'] = "Failed";
             $this->load->view('backend/user/booking', $page_datap);                               
             
             
         }else{
            //add to database               
            $this->db->insert('reservation', $data);
            $insert_id = $this->db->insert_id();                              
            $this->load->view('backend/user/booking_done');

         }                                  
         //$this->load->view('backend/user/index');  
    }
    
}
