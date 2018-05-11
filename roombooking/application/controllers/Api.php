<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
	public function index()
	{
		//$this->load->view('welcome_message');

        // if (isset($_GET['s'])) {
               
        // }
         $method = $this->input->post('method');
         $arr = array('response' => $method);  
                header('Content-Type: application/json');                    
                echo json_encode($arr);                        
	}
                
        
      public function sync(){                        
            $tours = json_decode(
                file_get_contents('https://api.rezdy.com/v1/products?apiKey=e8057c57e6844309b8b511012e979c58'), true
            );                        
            $requestStatus = $tours['requestStatus'];
            $success = $requestStatus['success'];                        
            if($success == true){
                // get tours
                $products = $tours['products'];        
                $page_data['tours'] = $products ;                        
                
                // get country and cities
                $country = array();
                foreach($products as $row){
                    $data = array(
                       'name'    =>    $row['locationAddress']['city']);                 
                    if(!in_array( $row['locationAddress']['countryCode'] , $country)  && $row['locationAddress']['countryCode'] != ""){
                         array_push($country,$row['locationAddress']['countryCode']);
                    }      
                }                   
                $results= array();
                foreach($country as $row){               
                    $city = array();
                    foreach($products as $row1){
                        if($row == $row1['locationAddress']['countryCode']){
                            
                            $temp = array('name' =>$row1['locationAddress']['city'], 'image'=>$row1['images'][0]['thumbnailUrl']);                            
                            if(!in_array( $temp , $city)  && $row1['locationAddress']['city'] != ""){
                                $da = array('name' =>$row1['locationAddress']['city'], 'image'=>$row1['images'][0]['thumbnailUrl']);
                                array_push($city, $da);
                            }                                                                                               
                        }
                    }
                    $data = array(
                           'name'    =>    $row, 'city' => $city); 
                    array_push($results,$data);    
                }           
                
                // intialze db.(country and city)
                foreach ($results as $row){                                        
                    $country_name = $row['name'];                    
                    $mydata['name'] = $country_name;  
                    $country_check = $this->db->get_where('country', array('name' => $country_name))->row();
                    if($country_check == null || $country_check == ""){
                        $this->db->insert('country',$mydata);  
                        $insert_id = $this->db->insert_id();                        
                        $res = $row['city'];
                        $myarray = array();
                        foreach ($res as $sub_row){                        
                            $mydata1['name'] = $sub_row['name'];
                            $mydata1['image'] = $sub_row['image'];
                            $mydata1['country_id'] = $insert_id;      
                            $city_check = $this->db->get_where('city', array('name' => $sub_row['name']))->row();
                            if($city_check == null || $city_check == ""){
                                $this->db->insert('city', $mydata1);
                            }                            
                        }
                    }                                                            
                }
                
                // initialize db(tours)
                foreach($products as $row){                                        
                    $product_code = $row['productCode'];                                       
                    $check = $this->db->get_where('tour', array('product_code'=>$product_code))->row();
                    $country_id = $this->db->get_where('country', array('name'=>$row['locationAddress']['countryCode']))->row()->id;
                    $city_id  = $this->db->get_where('city', array('name'=>$row['locationAddress']['city']))->row()->id;
                    if($check == null || $check == ""){
                        $dataa['name'] = $row['name'];
                        $dataa['image_url'] = $row['images'][0]['thumbnailUrl'];
                        $dataa['description'] = $row['description'];
                        //$dataa['video_url'] = $;                         
                        $dataa['city_id'] = $city_id;
                        $dataa['country_id'] = $country_id;                                                
                        $dataa['lat'] = $row['latitude'];
                        $dataa['lon'] = $row['longitude'];
                        $dataa['category_id'] = $row['supplierId'];
                        $dataa['provider_id'] = $row['supplierId'];
                        //$dataa['video_id'] = $this->input->post('video_id');   
                        //$dataa['max_count'] = $this->input->post('max_count');
                        $dataa['price'] = $row['advertisedPrice'];
                        //$dataa['include'] = $this->input->post('include');   
                        //$dataa['know'] = $this->input->post('know');   
                        $dataa['summary'] = $row['shortDescription'];
                        $dataa['location'] = $row['locationAddress']['addressLine'];
                        $dataa['auto_confirm'] = $row['confirmMode'];
                        $dataa['product_code'] = $row['productCode'];
                        $dataa['tour_type'] = 1;
                        try{                                
                            $this->db->insert('tour', $dataa);                        
                        } catch (Exception $ex) {
                            echo 'error';
                        }                    
                    }                    
                }
                $arr = array('response' => 200, 'tours'=> $products, 'country'=>$results);  
                header('Content-Type: application/json');                    
                echo json_encode($arr);                        
            } 
        
        
        }
        
        
        
                
        public function sync_agent(){                        
            $tours = json_decode(
                file_get_contents('https://api.rezdy.com/v1/products/marketplace?apiKey=e8057c57e6844309b8b511012e979c58&search=thailand'), true
            );                        
            $requestStatus = $tours['requestStatus'];
            $success = $requestStatus['success'];                        
            if($success == true){
                // get tours
                $products = $tours['products'];        
                $page_data['tours'] = $products ;                        
                
                // get country and cities
                $country = array();
                foreach($products as $row){
//                    $data = array(
//                       'name'    =>    $row['locationAddress']['city']);   
                    if(!in_array( $row['locationAddress']['countryCode'] , $country)  && $row['locationAddress']['countryCode'] != ""){
                         array_push($country,$row['locationAddress']['countryCode']);
                    }      
                }
                
                $results= array();
                foreach($country as $row){               
                    $city = array();
                    foreach($products as $row1){                   
                            if($row == $row1['locationAddress']['countryCode']){                                                                    
                                if(isset($row1['locationAddress']['city'])){
                                   
                                     try{
//                                        if($row1['locationAddress']['city'] != "" && $row1['locationAddress']['city'] != null){                                    
//                                            $temp = array('name' =>$row1['locationAddress']['city'], 'image'=>$row1['images'][0]['thumbnailUrl']);                            
//                                            if(!in_array( $temp , $city)  && $row1['locationAddress']['city'] != ""){
//                                                $da = array('name' =>$row1['locationAddress']['city'], 'image'=>'image');
//                                                array_push($city, $da);
//                                            }   
//                                        }                                        
                                        if (strpos($row1['locationAddress']['addressLine'], 'Thailand') !== false && $row1['locationAddress']['countryCode'] == "th") {
                                            $pieces = explode(",", $row1['locationAddress']['addressLine']);
                                            if(is_numeric ($pieces[count($pieces) - 2])){
                                                $temp = array('name' =>trim($pieces[count($pieces) - 3]) , 'image'=>'assets_extra/img/city.png');                                                
                                                if(!in_array( $temp , $city)){
                                                    //$da = array( $pieces[count($pieces) - 3] , 'image'=>$row1['images'][0]['thumbnailUrl']);
                                                    array_push($city, $temp);
                                                }
                                            }else{
                                                $temp = array('name' =>  trim($pieces[count($pieces) - 2]) , 'image'=>'assets_extra/img/city.png');
                                                if(!in_array( $temp , $city)){
                                                    //$da = array( $pieces[count($pieces) - 2] , 'image'=>$row1['images'][0]['thumbnailUrl']);
                                                    array_push($city, $temp);
                                                }  
                                            }                                        
                                        }                                    
                                    } catch (Exception $ex) {
                                    }  
                                }                              
                            }                                             
                    }
                    $data = array(
                           'name'    =>    $row, 'city' => $city); 
                    array_push($results,$data);    
                }  
                
                
//                $arr = array('response' => 200, 'res'=> $results);
//                header('Content-Type: application/json');                    
//                echo json_encode($arr);                  
                
                // intialze db.(country and city)
                foreach ($results as $row){                                        
                    $country_name = $row['name'];                    
                    $mydata['name'] = $country_name;  
                    $country_check = $this->db->get_where('country', array('name' => $country_name))->row();
                    if($country_check == null || $country_check == ""){
                        $this->db->insert('country',$mydata);  
                        $insert_id = $this->db->insert_id();                        
                        $res = $row['city'];
                        $myarray = array();
                        foreach ($res as $sub_row){                        
                            $mydata1['name'] = $sub_row['name'];
                            $mydata1['image'] = $sub_row['image'];
                            $mydata1['country_id'] = $insert_id;      
                            $city_check = $this->db->get_where('city', array('name' => $sub_row['name']))->row();
                            if($city_check == null || $city_check == ""){
                                $this->db->insert('city', $mydata1);
                            }                            
                        }
                    }                                                            
                }
                
                
                // initialize db(tours)
                foreach($products as $row){                                        
                    $product_code = $row['productCode'];                                       
                    $check = $this->db->get_where('tour', array('product_code'=>$product_code))->row();
                    $country_id = $this->db->get_where('country', array('name'=>$row['locationAddress']['countryCode']))->row()->id;
                                        
                    $pieces = explode(",", $row['locationAddress']['addressLine']);
                              
                    if((count($pieces) - 2) >= 0){
                        if(is_numeric ($pieces[count($pieces) - 2])){  
                            if((count($pieces) - 3) >= 0){
                                $city_id  = $this->db->get_where('city', array('name'=>trim($pieces[count($pieces) - 3])))->row()->id;
                            }                         
                        }else{                        
                            if((count($pieces) - 2) >= 0){
                                $city_id  = $this->db->get_where('city', array('name'=>trim($pieces[count($pieces) - 2])))->row()->id;          
                            }
                        }
                    }
                                        
                    if($check == null || $check == ""){
                        $dataa['name'] = $row['name'];
                        $dataa['image_url'] = $row['images'][0]['thumbnailUrl'];
                        $dataa['description'] = $row['description'];
                        //$dataa['video_url'] = $;                         
                        $dataa['city_id'] = $city_id;
                        $dataa['country_id'] = $country_id;                                                
                        $dataa['lat'] = $row['latitude'];
                        $dataa['lon'] = $row['longitude'];
                        $dataa['category_id'] = $row['supplierId'];
                        $dataa['provider_id'] = $row['supplierId'];
                        //$dataa['video_id'] = $this->input->post('video_id');   
                        //$dataa['max_count'] = $this->input->post('max_count');
                        $dataa['price'] = $row['advertisedPrice'] * 1.2;
                        //$dataa['include'] = $this->input->post('include');   
                        //$dataa['know'] = $this->input->post('know'); 
                        $dataa['summary'] = $row['shortDescription'];
                        $dataa['location'] = $row['locationAddress']['addressLine'];
                        $dataa['auto_confirm'] = $row['confirmMode'];
                        $dataa['product_code'] = $row['productCode'];
                        $dataa['tour_type'] = 2;
                        try{                                
                            $this->db->insert('tour', $dataa);                        
                        } catch (Exception $ex) {
                            echo 'error';
                        }                    
                    }                    
                }
                $arr = array('response' => 200, 'tours'=> $products, 'country'=>$results);  
                header('Content-Type: application/json');                    
                echo json_encode($arr);                        
            }
        }
        
        
        
        public function getNearBy($param1 = '', $param2 = '', $param3 = ''){
        
        $latitude = 32;
        $longitude = -117;                
        $latitude = $this->input->post('lat');
        $longitude = $this->input->post('lng');
        
        $multiply = 1;
        $distance = 5000;
        $query = "SELECT "
                            . "tour.*, "
                            . "ROUND(" . $multiply . " * 3956 * acos( cos( radians('$latitude') ) * "
                            . "cos( radians(lat) ) * "
                            . "cos( radians(lon) - radians('$longitude') ) + "
                            . "sin( radians('$latitude') ) * "
                            . "sin( radians(lat) ) ) ,8) as distance "
                            . "from tour "
                            . "where "                                                        
                            . "ROUND((" . $multiply . " * 3956 * acos( cos( radians('$latitude') ) * "
                            . "cos( radians(lat) ) * "
                            . "cos( radians(lon) - radians('$longitude') ) + "
                            . "sin( radians('$latitude') ) * "
                            . "sin( radians(lat) ) ) ) ,8) <= $distance "            ;
                            //. "order by distance";
        
        $res = $this->db->query($query)->result_array();
        $arr = array('response'=>200, 'tour' => $res);
        header('Content-Type: application/json');
        echo json_encode($arr);                 
    }
    
        
    public function getReservations($param1 = '', $param2 = '', $param3 = ''){
        
        $name = $this->input->post('name');
        $query = $this->db->query("SELECT * FROM reservation as r LEFT JOIN usertable as u on r.user_id = u.no LEFT JOIN room as ro on r.tour_id = ro.id where  email like '%".$name."%'");
        $tours = $query->result_array();                                            
        //$query = "SELECT * FROM tour WHERE name like '%".$name."%'";
        //$res = $this->db->query($query)->result_array();                
        $arr = array('response'=>200, 'reservations' => $tours);
        header('Content-Type: application/json');
        echo json_encode($arr);                 
    }

  
    public function getTourByCountryId($param1 = '', $param2 = '', $param3 = ''){
                  
        $country_id = $this->input->post('id');        
        $query = $this->db->query("SELECT * FROM tour WHERE country_id='".$country_id."' ORDER BY id DESC");
        $tours = $query->result_array();
                                    
        $arr = array('tours' => $tours);
        header('Content-Type: application/json');
        echo json_encode($arr);                 
    }
    public function getToursByCity(){        
        $country_id = $this->input->post('city_id');        
        $query = $this->db->query("SELECT * FROM tour WHERE city_id='".$country_id."' ORDER BY id DESC");
        $tours = $query->result_array();
                                    
        $arr = array('response'=>200, 'tours' => $tours);
        header('Content-Type: application/json');
        echo json_encode($arr);   
    }
    
    
    function loadBaseData(){        
        $user_id = $this->input->post('user_id');    
        $country_id = $this->input->post('country_id');        
        if($country_id == -1){         
            $country_id = $this->db->get_where('country', array('code'=>'USA'))->row()->id;                                
        }
        
        $country = $this->db->get('country')->result_array();            
        $query = $this->db->query("SELECT * FROM tour WHERE country_id='".$country_id."' ORDER BY id DESC LIMIT 30");                                
        $new_tours = $query->result_array();

        $query = $this->db->query("SELECT * FROM tour WHERE country_id='".$country_id."' and rate >= 4 ORDER BY id DESC LIMIT 30");                     
        $top_tours = $query->result_array();
        $cities = $this->db->get_where('city', array('country_id'=>$country_id))->result_array();

        $reservations = $this->db->get_where('reservation', array('user_id'=>$user_id))->result_array();        
        $MyObjects = array();          
        foreach($reservations as $row){
                $rsv_id = $row['id'];
                $tour_id = $row['tour_id'];
                $tours = $this->db->get_where('tour', array('id'=>$tour_id))->row();
                $item = array('rsv_id'=>$rsv_id, 'tour_id'=>$tour_id,'user_id'=>$row['user_id']);                 
                $MyObject['reservation'] = $row;
                $MyObject['tours'] = $tours;                
                $MyObjects[] = $MyObject;                
        }                 
        $arr = array('response'=> '200', 'new_tours'=>$new_tours,'top_tours'=>$top_tours, 'cities'=>$cities, 'reservations'=>$MyObjects, 'country'=>$country); 
        header('Content-Type: application/json');
        echo json_encode($arr);   
    }
    
    function getCity(){
        $cid = $this->input->post('country_id');
        if($cid == -1){
             $cities = $this->db->get('city')->result_array();
        }else{
             $cities = $this->db->get_where('city', array('id'=>$cid))->result_array();
        }        
        $arr = array('response'=> '200', 'cities'=>$cities); 
        header('Content-Type: application/json');
        echo json_encode($arr);            
    }
     
    function getBlog(){                        
        $itemCount = "30";
        $offset = $this->input->post('offset') * $itemCount;
        $sql = "SELECT * FROM blog ORDER BY id DESC limit ".$itemCount." offset ".$offset."";
        $query = $this->db->query($sql);                  
        $blogs = $query->result_array();
                
        $arr = array('response'=> '200', 'blog'=>$blogs); 
        header('Content-Type: application/json');
        echo json_encode($arr);        
    }
    

    
     function getProductDetails(){          
        $product_code = $this->input->post('product_code');//$this->db->get_where('tour', array('id'=>$tour_id))->row()->product_code;                
        $results = json_decode(
            file_get_contents('https://api.rezdy.com/v1/products/'.$product_code.'?apiKey=e8057c57e6844309b8b511012e979c58'), true
        );
        $requestStatus = $results['requestStatus'];
        $success = $requestStatus['success'];                        
        if($success == true){
            $tour =  $results['product'];            
            if (array_key_exists('videos', $tour)) {
                $tour['video'] = 1;
                $tour['video_id'] = $tour['videos']['0']['id'];
            }else{
                $tour['video'] = 2;
                $tour['images'] = $tour['images'];
            }
            $arr = array('response'=> '200', 'tour'=>$tour); 
            header('Content-Type: application/json');
            echo json_encode($arr);   
        }else{
            $arr = array('response'=> '400'); 
            header('Content-Type: application/json');
            echo json_encode($arr);   
        
        }            
    }
            
     public function login(){        
        //$password  = $this->input->post('password');
        //$email = $this->input->post('email');        
        $password = $_POST["password"];
        $email = $_POST["email"];
        
        
        $row = $this->db->get_where('usertable', array('email'=>$email, 'password'=>$password))->row();
        if($row == null || $row == ""){            
            $arr = array('response'=> '400'); 
            header('Content-Type: application/json');
            echo json_encode($arr);   
        }else{
            $user_id = $row->no;
            $reservations = $this->db->get_where('reservation', array('user_id'=>$user_id))->result_array();        
            $MyObjects = array();
            foreach($reservations as $roww){
                    $rsv_id = $roww['id'];
                    $tour_id = $roww['tour_id'];
                    $tours = $this->db->get_where('tour', array('id'=>$tour_id))->row();                                
                    $MyObject['reservation'] = $roww;
                    $MyObject['tours'] = $tours;                
                    $MyObjects[] = $MyObject;                
            }    
        
            $arr = array('response'=> '200' , 'user'=>$row, 'reservations'=>$MyObjects); 
            header('Content-Type: application/json');
            echo json_encode($arr);   
        }
     }
     
     
     public function register(){
         
        $data['name']        = $this->input->post('fname');
        $data['surname']        = $this->input->post('lname');
        $data['email']        = $this->input->post('email');
        $data['phone']        = $this->input->post('phone');
        $data['password']        = $this->input->post('password');	
        $data['user_type']       = '4'; // customer
        
        $exist = $this->db->get_where('usertable', array('email' => $this->input->post('email')))->row();
        if( ($exist == null) || ($exist == "") ){
            $this->db->insert('usertable', $data);            
            $insert_id = $this->db->insert_id();
            
            $row = $this->db->get_where('usertable', array('no'=>$insert_id))->row();            
            $reservations = $this->db->get_where('reservation', array('user_id'=>$insert_id))->result_array();        
            $MyObjects = array();
            foreach($reservations as $roww){
                    $rsv_id = $roww['id'];
                    $tour_id = $roww['tour_id'];
                    $tours = $this->db->get_where('tour', array('id'=>$tour_id))->row();                                
                     $MyObject['reservation'] = $roww;
                    $MyObject['tours'] = $tours;
                    $MyObjects[] = $MyObject;                
            }
            
            $arr = array('response'=> '200' , 'user'=>$row, 'reservations'=>$MyObject); 
            header('Content-Type: application/json');
            echo json_encode($arr);               
        }else{              
            $arr = array('response'=> '400'); 
            header('Content-Type: application/json');
            echo json_encode($arr); 
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
            $arr = array('response'=>200, 'sessions' => $sessions);
            header('Content-Type: application/json');
            echo json_encode($arr);
        }else{
            $arr = array('response' => 400);
            header('Content-Type: application/json');
            echo json_encode($arr);
        }  
    }
    
    public function getOrders(){
            $tours = json_decode(
                file_get_contents('https://api.rezdy.com/v1/bookings?apiKey=e8057c57e6844309b8b511012e979c58'), true
            );
            $requestStatus = $tours['requestStatus'];
            $success = $requestStatus['success'];                        
            if($success == true){
                $bookings = $tours['bookings'];                 
                $arr = array('response' => 200, 'bookings'=>$bookings);
                header('Content-Type: application/json');
                echo json_encode($arr);
            }else{
                $arr = array('response' => 400);
                header('Content-Type: application/json');
                echo json_encode($arr);
            }                        
    }
    
    
    
    
    
    public function cancelReservation(){
                
        $rsv_id = $this->input->post('rsv_id');
        $product_code = $this->input->post('product_code');        
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rezdy.com/v1/bookings/".$product_code."?apiKey=e8057c57e6844309b8b511012e979c58",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 0324b533-a3e1-bf3a-288f-7d5b30a3c384"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          //echo "cURL Error #:" . $err;
            $arr = array('response'=>400, 'message' => $err);
            header('Content-Type: application/json');
            echo json_encode($arr);
        } else {                         
            $res = json_decode($response, true);                                   
            $requestStatus = $res['requestStatus'];
            $success = $requestStatus['success'];
            if($success == true){                
                $dataa['state'] = 3;
                $this->db->where('id', $rsv_id);
                $this->db->update('reservation', $dataa);
                $arr = array('response'=>200, 'message' => "");
                header('Content-Type: application/json');
                echo json_encode($arr);
            }else{                
                $error = $requestStatus['error'];
                $message = $error['errorMessage'];
                $arr = array('response'=>400, 'message' => $message);
                header('Content-Type: application/json');
                echo json_encode($arr);
            }          
        }        
    }

    
      
}
