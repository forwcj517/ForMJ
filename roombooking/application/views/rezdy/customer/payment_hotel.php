<?php
$this->load->view('rezdy/common/header');
$tour = $this->db->get_where('restaurant', array('id' => $res_id))->row();
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

                        <?php echo form_open('user/book_hotel', array('class' => 'form-horizontal form-groups-bordered validate')); ?>

                        <div class="border_con" style="padding-left: 20px;">                            
                            <div class="col-sm-12">
                                <h4><?php echo $tour->name; ?> </h4>
                            </div>

                            <div class="col-sm-12 imgsec">
                                <div class="">
                                                                                                                
                                        <p>User Info</p>
                                        <div class="row">
                                             <div class="col-sm-6">
                                                <input style="height:45px" name="firstName" class="form-control" placeholder="First Name" type="text">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="lastName" class="form-control" placeholder="Last Name" type="text">
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-top: 10px;">
                                             <div class="col-sm-6">
                                                 <input style="height:45px" name="email" class="form-control" placeholder="Email" type="email">
                                            </div>
                                            <div class="col-sm-6">
                                                <input style="height:45px;" name="phone" class="form-control" placeholder="Phone" type="phone">
                                            </div>
                                        </div>                                        
                                </div>
                            </div>
                            <hr>
                            
                            
                            
<!--                            <div hidden="true">
                                <input type="text" id="productCode" name="productCode" value="<?php echo $tour->product_code; ?>"/>
                                <input type="text" id="startTime" name="startTime" value="<?php echo $startTime; ?>"/>
                                <input type="text" id="endTime" name="endTime" value="<?php echo $endTime; ?>"/>     
                                <?php if($quantity == "" || $quantity == null) {?>
                                    <input type="text" id="adult" name="adult" value="<?php echo $adult  ; ?>"/>
                                    <input type="text" id="child" name="child" value="<?php echo $child  ; ?>"/>
                                    <input type="text" id="adult_amount" name="adult_amount" value="<?php echo $adult_price * $adult * (100 - $value)/100; ?>" />
                                    <input type="text" id="child_amount" name="child_amount" value="<?php echo $child_price * $child * (100 - $value)/100; ?>" />
                                    <input type="text" id="amount" name="amount" value="<?php echo $adult_price * $adult * (100 - $value)/100 + $child_price * $child * (100 - $value)/100; ?>" />
                                <?php } else { ?>
                                    <input type="text" id="quantity" name="quantity" value="<?php echo $quantity  ; ?>"/>
                                    <input type="text" id="amount" name="amount" value="<?php echo $tour->price * $quantity * (100 - $value)/100; ?>" />
                                <?php } ?>
                                                                                                                                                                                                
                                <input type="text" id="coupon" name="coupon" value="<?php echo $coupon; ?>" />
                                
                                                                
                            </div>-->
                            
                            
                            <div class="col-sm-12" imgsec>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6>Payment type</h6>
<!--                                        <select id="selectbasic_tipoatv" style="height:45px" name="selectbasic_tipoatv" class="form-control">
                                            <option value="1">Credit Card</option>
                                            <option value="2">Master Card</option>
                                            <option value="3">VISA</option>
                                        </select>-->
                                    </div>
                                    
<!--                                    <label>
                                        <input type="radio" name="fb" value="small" />
                                        <img src="<?php echo base_url('uploads/image/card-logo.png'); ?>">
                                    </label>
                                    <label>
                                        <input type="radio" name="fb" value="small" />
                                        <img src="<?php echo base_url('uploads/image/card-logo.png'); ?>">
                                    </label>
                                    <label>
                                        <input type="radio" name="fb" value="small" />
                                        <img src="<?php echo base_url('uploads/image/card-logo.png'); ?>">
                                    </label>-->
                                                                        
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url('uploads/image/card-logo.png'); ?>" class="img-responsive">
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


                            <div hidden="true">                                                               
                                <input type="text" id="code" name="code" value="<?php echo $code; ?>"/>
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

                
                <div class="col-md-4 col-sm-5 border" style="margin-bottom: 10px;">
                    <div class="contact-detail continfo">
                        <div class="contact-sparator"></div>
                        <div class="row">
                            <div class="col-sm-8">
                                <p><?php echo $tour->name; ?></p>
                                <p><?php echo $tour->email; ?></p>
                            </div>
                            <div class="col-sm-4">
                                <img src="<?php echo $this->db->get_where('res_image', array('res_id'=>$tour->id))->row()->image; ?>" class="img-responsive">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                
                                <p><?php echo "<span>Start Time:</span> " . $startTime; ?></p>
                                <p><?php echo "<span>End Time:</span> " . $endTime; ?></p>
                                
                                <p><?php echo "<span>Ticket Adult Count:</span> " . $adult; ?></p>
                                <p><?php echo "<span>Ticket Child Count:</span> " . $child; ?></p>
                                       
                                <p><span>See details</span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">                            
                            <div class="col-sm-12">
                                <div class="pull-left">
                                    
<!--                                    <p><?php echo $adult_price . "$  X  ".$adult ?></p>                                        
                                    <p><?php echo $child_price . "$  X  ".$child ?></p>-->

                                                                                                            
                                    <p><span> Price <span></p>
                                    <p><span>Add coupon<span></p>
                                    <p>Total</p>
                                </div>
                                                
                                    <div class="pull-right">
                                                    
                                                    <p>$<?php echo $adult_price * $adult ?></p>                                                        
<!--                                                    <p>$<?php echo $child_price * $child ?></p>                                                         -->
                                                        
                                                    <p style="font-family:SourceS; margin-top:15px;"><?php echo "(%)" ; ?></p>                                                           
                                                    <p>$<?php echo $adult_price * $adult * (100 - $value)/100 + $child_price * $child * (100 - $value)/100;?></p>
                                                         
                                                    <!--<p>$<?php echo $tour->price * $ticket_count * (100 - $value)/100?></p>-->
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
    function makePayment() {
        var customer = JSON.stringify({"firstName": "Wang", "lastName": "Chengzhen", "email": "kingstarboy@outlook.com", "phone": "0282443060"});
        var items = JSON.stringify([
            {
                "productCode": "PQ2LQU",
                "startTime": "2014-11-02T22:00:00Z",
                "amount": 200,
                "quantities": [
                    {
                        "optionLabel": "Adult",
                        "value": "2"
                    }
                ],
                "participants": [
                    {
                        "fields": [
                            {
                                "label": "First Name",
                                "value": "Hugo"
                            },
                            {
                                "label": "Last Name",
                                "value": "Sterin"
                            }
                        ]
                    },
                    {
                        "fields": [
                            {
                                "label": "First Name",
                                "value": "Simon"
                            },
                            {
                                "label": "Last Name",
                                "value": "Lenoir"
                            }
                        ]
                    }
                ]
            }
        ]);
        var payments = JSON.stringify([
            {
                "type": "CREDITCARD",
                "amount": "200",
                "currency": "USD",
                "date": "2014-11-01T10:26:00Z",
                "label": "Payment processed by RezdyDemoAgent"
            }
        ]);

        //        jQuery.ajax({
        //            type: "POST",
        //            url: "<?php echo 'https://api.rezdy.com/v1/products/bookings'; ?>",
        //            dataType: 'json',
        //            data: {customer: customer , items: items, payments:payments},
        //            success: function (data) {
        //                if (data)
        //                {
        //                    // Show Entered Value                                        
        //                    maxCount = data.count;                                                  
        //                }
        //            }
        //        });

        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://api.rezdy.com/v1/bookings?apiKey=e8057c57e6844309b8b511012e979c58",
            "method": "POST",
            "headers": {
                "content-type": "application/json",
                "cache-control": "no-cache",
                "postman-token": "b2a6862a-5a25-2603-6ffe-d005c1fdbcef"
            },
            "processData": false,
            "data": "{\r\n\"customer\": {\r\n    \"firstName\": \"Hugo\",\r\n    \"lastName\": \"Sterin\",\r\n    \"email\": \"noreply@rezdy.com\",\r\n    \"phone\": \"0282443060\"\r\n},\r\n\"items\": [ \r\n   {\r\n      \"productCode\": \"PQ2LQU\",\r\n      \"startTime\": \"2014-11-02T22:00:00Z\",\r\n      \"amount\": 200,\r\n      \"quantities\": [\r\n    {\r\n      \"optionLabel\": \"Adult\",\r\n      \"value\": \"2\"\r\n    }\r\n      ],\r\n       \"participants\": [\r\n    {\r\n        \"fields\": [\r\n        {\r\n            \"label\": \"First Name\",\r\n            \"value\": \"Hugo\"\r\n        },\r\n        {\r\n            \"label\": \"Last Name\",\r\n            \"value\": \"Sterin\"\r\n        }\r\n        ]\r\n    },\r\n    {\r\n        \"fields\": [\r\n        {\r\n            \"label\": \"First Name\",\r\n            \"value\": \"Simon\"\r\n        },\r\n        {\r\n            \"label\": \"Last Name\",\r\n            \"value\": \"Lenoir\"\r\n        }\r\n        ]\r\n    }\r\n      ]\r\n   }\r\n],\r\n\"fields\": [\r\n   {\r\n      \"label\": \"Do you have any dietary requirements?\",\r\n      \"value\": \"No, I have no requirements. \"\r\n   }\r\n],\r\n\"comments\": \"Special requirements go here\",\r\n\"resellerComments\": \"Your Agent voucher/redemption code should go here\",\r\n\"payments\": [\r\n    {\r\n      \"type\": \"CREDITCARD\",\r\n      \"amount\": \"200\",\r\n      \"currency\": \"USD\",\r\n      \"date\": \"2014-11-01T10:26:00Z\",\r\n      \"label\": \"Payment processed by RezdyDemoAgent\"\r\n    }\r\n  ]\r\n}"
        }

        $.ajax(settings).done(function (response) {
            console.log(response);
        });
    }

</script>
