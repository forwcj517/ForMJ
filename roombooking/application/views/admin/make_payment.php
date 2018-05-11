
<?php
//$this->load->view('rezdy/common/header');
//$tour = $this->db->get_where('tour', array('id' => $tour_id))->row();
$userData = $this->db->get_where('usertable', array('no'=> $this->session->userdata('admin_id')))->row();

?>



<body>
    <div class="Payment">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="payment_border" >
                        <h3>Review and pay</h3>
                    <!-- Start Form -->


                        <?php echo form_open('admin/process_payment', array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                        <div class="border_con" style="padding-left: 20px;">

                            <div class="col-sm-12">
                                <h4><?php echo "Payment"; ?> </h4>
                            </div>

                            <div class="col-sm-12 imgsec">
                                <div class="">
                                                                                                                
                                        <p>User Info</p>
                                        <div class="row">
                                             <div class="col-sm-6">
                                                <input style="height:45px" name="firstName" class="form-control" placeholder="First Name" type="text" value="<?php echo $userData->name;?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="lastName" class="form-control" placeholder="Last Name" type="text" value="<?php echo $userData->surname;?>">
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-top: 10px;">
                                             <div class="col-sm-6">
                                                 <input style="height:45px" name="email" class="form-control" placeholder="Email" type="email"  value="<?php echo $userData->email;?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="phone" class="form-control" placeholder="Phone" type="phone"  value="<?php echo $userData->phone;?>">
                                            </div>
                                        </div>                                        
                                </div>
                            </div>
                            <hr>

                            
                            <div class="col-sm-12" imgsec>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6>Payment type</h6>
                                    </div>                                    
                                                                        
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url('uploads/image/card-logo.png'); ?>" class="img-responsive">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <p>Amount</p>
                                        <div class="input-group" style="height:45px">
                                            <input style="height:45px" name="amount" class="form-control" placeholder="" type="number">
                                            <span class="input-group-addon" style="border-radius:0px;"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <p>Card number</p>
                                        <div class="input-group" style="height:45px">
                                            <input style="height:45px" name="cardNumber" class="form-control" placeholder="" type="text">
                                            <span class="input-group-addon" style="border-radius:0px;"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>Expires on</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input style="height:45px" name="expiryMonth" class="form-control" placeholder="MM" type="text">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="expiryYear" class="form-control" placeholder="YYYY" type="text">
                                            </div>                                                                                                                                    
                                        </div>                                        
                                    </div>                                
                                    <div class="col-sm-3">
                                        <p>Security code</p>
                                        <div class="input-group" style="height:45px">
                                            <input style="height:45px" name="cardSecurityNumber" class="form-control" placeholder="" type="text">                                            
                                            <span class="input-group-addon" style="border-radius:0px;"> <i class="fa fa-question-circle" aria-hidden="true"></i> </span>
                                        </div>
                                    </div>
                                </div>

<!--                                <input hidden="true" name="rsv_id" type="text" value="<?php echo $rsv_id; ?>"/>
                                <input hidden="true" name="tour_id" type="text" value="<?php echo $tour_id; ?>"/>-->
                            </div>




                            <div class="col-sm-12 terms">
                                <h4>Terms of Service</h4>
                                <p>By confirming this booking, you agree to the <span>Surf You To The Moon Terms of Service, Guest Release and Waiver,</span> and the <span>Cancellation Policy</span></p>
                            </div>


                            <div class="form-group col-sm-5 confirm">
                                <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">
                                    Confirm Booking
                                </button>
                            </div>  

                        </div>

                        <?php echo form_close(); ?> 

                    </div>
                </div>

                
                                                                 
            </div>
    </div>   

</body>

