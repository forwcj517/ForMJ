
<?php
$data = $this->db->get_where('tour', array('id' => $tour_id))->row();
$rsv_data = $this->db->get_where('reservation', array('id' => $rsv_id))->row();
$user_data =  $this->db->get_where('usertable', array('no' => $this->session->userdata('admin_id')))->row();
?>

<body>   
    <div class="Payment">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="payment_border" >
                        <h3>Make Payment</h3>
                        <!-- Start Form -->
                        <?php echo form_open('user/make_payment/provider', array('class' => 'form-horizontal form-groups-bordermake_paymented validate'));?>                                                                
                        
                        <div class="border_con" style="padding-left: 20px;">                            
                            <div class="col-sm-12">
                                <h4><?php echo $data->name; ?> </h4>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-md-12">
                                    <p style="margin-top:20px"> 
                                        <?php echo $user_data->name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$user_data->surname; ?> 
                                    </p>
                                    <p style="margin-top:10px"> 
                                        <?php echo $user_data->phone."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$user_data->email; ?> 
                                    </p>
                                </div>
<!--                                <div class="pull-right">
                                    <img src="img/profile.jpg" width="60" class="img-responsive img-circle">
                                </div>-->
                            </div>
                            
                           
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <h6>Payment type</h6>
<!--                                        <select id="selectbasic_tipoatv" style="height:45px" name="selectbasic_tipoatv" class="form-control">
                                            <option value="1">Credit Card</option>
                                            <option value="2">Master Card</option>
                                            <option value="3">VISA</option>
                                        </select>-->
                                    </div>
                                    <div class="col-sm-6">
                                        
                                        <img src="<?php echo base_url('images/card-logo.png'); ?>" class="img-responsive">
                                    </div>
                                </div>
                            </div>

                        

                            <div class="form-group col-sm-12">
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
                            <div class="col-sm-12 form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>Expires on</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input style="height:45px" name="expMonth" class="form-control" placeholder="MM" type="text">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="expYear" class="form-control" placeholder="YYYY" type="text">
                                            </div>                                                                                                                                    
                                        </div>                                        
                                    </div>                                
                                    <div class="col-sm-3">
                                        <p>Security code</p>
                                        <div class="input-group" style="height:45px">
                                            <input style="height:45px" name="cv" class="form-control" placeholder="" type="text">                                            
                                            <span class="input-group-addon" style="border-radius:0px;"> <i class="fa fa-question-circle" aria-hidden="true"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                                                   
                                <input hidden="true" name="amount" type="text" 
                                       value="<?php 
                                       $rate = $this->db->get_where('groupon', array('title'=>$rsv_data->promocode))->row()->discount;
                                                if($rate != null){
                                                    $discount = $rsv_data->real_price * $rate;
                                                }else{
                                                    $discount = 0;
                                                }
                                       echo $rsv_data->real_price- $discount ?>"/>
                                <input hidden="true" name="rsv_id" type="text" value="<?php echo $rsv_id;?>"/>
                                <input hidden="true" name="tour_id" type="text" value="<?php echo $tour_id;?>"/>
                            </div>




                            <div class="col-sm-12 terms">
                                <h4>Terms of Service</h4>
                                <p>By confirming this booking, you agree to the <span>Surf You To The Moon Terms of Service, Guest Release and Waiver,</span> and the <span>Cancellation Policy</span></p>
                            </div>
                           
                                <?php if($rsv_data->state == 2) {?>
                                    <div class="form-group col-sm-5 confirm">
                                        <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">
                                            $<?php 
                                                $rate = $this->db->get_where('groupon', array('title'=>$rsv_data->promocode))->row()->discount;
                                                if($rate != null){
                                                    $discount =  $data->price * $rsv_data->ticket_count*$rate;
                                                }else{
                                                    $discount = 0;
                                                }                                      
                                                echo $rsv_data->real_price - $discount ?>. Confirm Booking
                                        </button>
                                    </div>                            
                                <?php } else { ?>  
                                    <div class="form-group col-sm-12 confirm">
                                        <h4 style="color: red">Please wait for tour guider agreements</h4>
                                    </div>                                    
                                <?php }?>
                                                       
                        </div>
                        <?php echo form_close();?>                        
                    </div>
                </div>
                
                
                <div class="col-md-4 col-sm-5 border" style="margin-bottom: 10px;">
                    <div class="contact-detail continfo">
                        <div class="contact-sparator"></div>
                        <div class="row">
                            <div class="col-sm-8">
                                <p><?php echo $data->name; ?></p>
                                <p><?php echo $data->include; ?></p>
                            </div>
                            <div class="col-sm-4">
                                <img src="<?php echo base_url() . $data->image_url; ?>" class="img-responsive">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <p><?php echo "<span>Date:</span> ".$rsv_data->date ?></p>
                                <p><?php echo "<span>Time:</span> ".$rsv_data->time ?></p>
                                <p><?php echo "<span>Ticket Count:</span> ".$rsv_data->ticket_count ?></p>
                                <p><span>See details</span></p>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">                            
                            <div class="col-sm-12">
                                <div class="pull-left">
                                    <p><?php echo $data->price."$  X ".$rsv_data->ticket_count." Guest" ?></p>
                                    <p><span>Add coupon<span></p>
                                    <p>Total</p>
                                    </div>
                                    <div class="pull-right">
                                        <p>$<?php echo $rsv_data->real_price ?></p>
                                        
                                        <?php if($rsv_data->promocode != null && $rsv_data != ""){?>
                                            <p><?php $rate = $this->db->get_where('groupon', array('title'=>$rsv_data->promocode))->row()->discount; $discount =  $data->price * $rsv_data->ticket_count*$rate;  echo $rsv_data->promocode."(".$discount.")";?></p>
                                        <?php }else {  $discount = 0;?>
                                            <br>
                                        <?php } ?>                                                                                
                                        <p style="font-family:SourceS; margin-top:15px;">$<?php echo $rsv_data->real_price - $discount ;?></p>                                                                                                                        
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


