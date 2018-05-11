
<?php
$this->load->view('rezdy/common/header');
$tour = $this->db->get_where('room', array('id' => $tour_id))->row();
?>

<body>

    <div class="banner_contact">
        <img src="<?php echo base_url('uploads/image/payment-banner.png'); ?>" class="img-responsive" style="height: 230px;">
    </div>

    <div class="container">

        <div class="col-sm-12 bs-wizard" style="border-bottom:0;">                
            <div class="col-xs-4 bs-wizard-step complete"><!-- complete -->
                <div class="bs-wizard-stepnum">Step 1</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a href="#" class="bs-wizard-dot left"></a>
                <div class="bs-wizard-info text-center"></div>
            </div>

            <div class="col-xs-4 bs-wizard-step complete"><!-- complete -->
                <div class="text-center bs-wizard-stepnum">Step 2</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a href="#" class="bs-wizard-dot"></a>
                <div class="bs-wizard-info text-center"></div>
            </div>

            <div class="col-xs-4 bs-wizard-step active"><!-- active -->
                <div class="text-right bs-wizard-stepnum">Step 3</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a href="#" class="bs-wizard-dot right"></a>
                <div class="bs-wizard-info text-center"></div>
            </div>
        </div>
    </div>


    <div class="Payment">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="payment_border" >
                        <h3>Review and pay</h3>
                        <!-- Start Form -->

                        <?php echo form_open('user/make_payment', array('class' => 'form-horizontal form-groups-bordered validate')); ?>

                        <div class="border_con" style="padding-left: 20px;">                            
                            <div class="col-sm-12">
                                <h4><?php echo $tour->name; ?> </h4>
                            </div>

                            <div class="col-sm-12 imgsec">
                                <div class="">
                                                                                                                
                                        <p>User Info</p>
                                        <div class="row">
                                             <div class="col-sm-6">
                                                 <input style="height:45px" name="firstName" class="form-control" placeholder="First Name" type="text" required="true">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="lastName" class="form-control" placeholder="Last Name" type="text" required="true">
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-top: 10px;">
                                             <div class="col-sm-6">
                                                 <input style="height:45px" name="email" class="form-control" placeholder="Email" type="email" required="true">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="phone" class="form-control" placeholder="Phone" type="phone" required="true">
                                            </div>
                                        </div>                                        
                                </div>
                            </div>
                            <hr>
                            
                            <div hidden="true">                                
                                <input type="text" id="room_id" name="room_id" value="<?php echo $tour->id; ?>"/>
                                <input type="text" id="startTime" name="startTime" value="<?php $startTime ?>"/>
                                <input type="text" id="endTime" name="endTime" value="<?php echo $endTime; ?>"/>                                
                                <input type="text" id="people" name="people" value="<?php echo $ticket_count; ?>"/>
                                <input type="text" id="amount" name="amount" value="<?php echo $tour->price; ?>"/>                                                                
                            </div>
                                                        
                            <div class="col-sm-12" imgsec>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6>Payment type</h6>
                                    </div>
                                                                        
                                    <div class="col-sm-6">                                                                              
                                        <div class="col-xs-6">
                                            <label class="css-input css-radio css-radio-lg css-radio-primary push-10-r">
                                                <input type="radio" name="radio-group12" checked="" value="1"><span></span>  Arrived payment
                                            </label>
                                            <label class="css-input css-radio css-radio-lg css-radio-primary">
                                                <input type="radio" name="radio-group12" value="2"><span></span> Paypal payment
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="row paymentDiv">                                
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
                                                    <input style="height:45px" name="expiryMonth" class="form-control" placeholder="MM" type="text" >
                                                </div>
                                                <div class="col-sm-6">
                                                    <input style="height:45px;" name="expiryYear" class="form-control" placeholder="YYYY" type="text">
                                                </div>                                                                                                                                    
                                            </div>                                        
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <p>Security code</p>
                                            <div class="input-group" style="height:45px">
                                                <input style="height:45px" name="cardSecurityNumber" class="form-control" placeholder="" type="text" > 
                                                <span class="input-group-addon" style="border-radius:0px;"> <i class="fa fa-question-circle" aria-hidden="true"></i> </span>
                                            </div>
                                        </div>
                                    </div>
    <!--                                <input hidden="true" name="rsv_id" type="text" value="<?php echo $rsv_id; ?>"/>
                                    <input hidden="true" name="tour_id" type="text" value="<?php echo $tour_id; ?>"/>-->
                                </div>
                            </div>
                            <input hidden="true" name="amount" type="text" 
                                                                   value="<?php echo $tour->price * abs(strtotime($endTime) - strtotime($startTime))/(3600 * 24); ?>"/>
                            
                            <input hidden="true" name="payment_type" type="text" value="1"/>
                            
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

                
                <div class="col-md-4 col-sm-5 border" style="margin-bottom: 10px;">
                    <div class="contact-detail continfo">
                        <div class="contact-sparator"></div>
                        <div class="row">
                            <div class="col-sm-8">
                                <p><?php echo $tour->name; ?></p>                                
                            </div>
                            <div class="col-sm-4">
                                <img src="<?php echo base_url($tour->image_url); ?>" class="img-responsive">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <p><?php  $start = explode("-", $startTime);  echo "<span>Start Date:</span> " . $start[2]."/".$start[1]."/".$start[0]; ?></p>
                                <p><?php  $start = explode("-", $endTime); echo "<span>End Date:</span> " . $start[2]."/".$start[1]."/".$start[0]; ?></p>
                                <p><?php echo "<span>Guest:</span> " . $ticket_count ?></p>
                                <p><span>See details</span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">                            
                            <div class="col-sm-12">
                                
                                <div class="pull-left">
                                                                    
                                    <p><span>Price per a day<span></p>
                                    <p>All Dates</p>
                                    <p>Total</p>
                                </div>
                                
                                <div class="pull-right">
                                                                        
                                    <p>$<?php echo $tour->price ; ?></p>      
                                    <p><?php echo abs(strtotime($endTime) - strtotime($startTime))/(3600 * 24); ?></p>      
                                    <p style="font-family:SourceS; margin-top:15px;">$<?php echo $tour->price * abs(strtotime($endTime) - strtotime($startTime))/(3600 * 24); ?></p>
                                </div>
                                
                                <br>                                                                                 

                            </div>                                                            
                        </div>                                

                                <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <p><span>Cancellation Policy</span></p>
                                <p>Get a full refund if you cancel within 24 hours of purchase.</p>
                            </div>                                                                                            
                        </div>                   


                                </div>                            
                        </div>				                    
                    </div>            
                </div>                                                    
            </div>
    </div>   

</body>

<?php $this->load->view('rezdy/common/footer'); ?>

<script>
    
   
    $(document).ready(function () {        
        $("input[type='radio']").change(function () {
            var selection=$(this).val();
            if(selection == 1){
                $(".paymentDiv").hide();
                document.getElementById('payment_type').value = '1';
            }else{
                $(".paymentDiv").show();
                document.getElementById('payment_type').value = '2';
            }
        });
        $(".paymentDiv").hide();
        
    });
   
</script>
