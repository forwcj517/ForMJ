<?php 
//include ('../common/header.php') 
 $this->load->view('rezdy/common/header');
?>

<body>

    <div class="banner_contact">
        <img src="<?php echo base_url('assets_extra/img/contactus-banner.png');?>" class="img-responsive" style="width: 100%; height: 280px;" >
    </div>

    <div class="contact">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8 col-sm-7">
                    <!-- Start Form -->
                                        
                    <div class="border_con">
                                            
                        <?php echo form_open('user/contact/', array('class' => ' form-groups-bordered validate'));?>
                        <h3>Keep in Touch</h3>
                        <div class="col-sm-12">
                            
                            <div class="row">                                
                                <div class="form-group col-sm-6">
                                    <h6>Full Name</h6>
                                    <input name="name" type="text" class="form-control" style="height:45px" placeholder="Enter your name....">
                                </div>
                                
                                <div class="form-group col-sm-6">
                                    <h6>Email Address</h6>
                                    <input name="email" type="email" class="form-control" style="height:45px" placeholder="Enter your email....">
                                </div>                                
                            </div>                            
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <h6>Subject</h6>
                            <input type="text" name="title" class="form-control" style="height:45px" placeholder="Enter your subject....">
                        </div>

                        <div class="form-group col-sm-12">
                            <h6>Your Message</h6>
                            <textarea class="form-control" name="message" rows="7" placeholder="Enter your message...." required></textarea>
                        </div>
                        
                        <div class="form-group col-sm-3">                            
                            <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">Send Message</button>
                        </div>
                        <?php echo form_close();?>
                    </div>
                    
                   
                </div>
                                
                <div class="col-md-4 col-sm-5">
                    <div class="contact-detail continfo">
                        <div class="contact-sparator"></div>
                        <h3>Contact Us</h3>
                        <ul class="list-unstyled">
                            <li>
                                <h6><i class="fa fa-home fa-primary"></i> <span>Our location</span></h6>
                                <p><?php  echo $this->db->get_where('setting_contact', array('id'=>1))->row()->address;?>
                                </p>
                            </li>
                            
                            <li>
                                <h6><i class="fa fa-phone fa-primary"></i> <span>Call center</span></h6>
                                <p><?php  echo $this->db->get_where('setting_contact', array('id'=>1))->row()->phone;?>
                                </p>
                            </li>
                            
                            <li>
                                <h6><i class="fa fa-envelope fa-primary"></i> <span>Email address</span></h6>
                                <p><?php  echo $this->db->get_where('setting_contact', array('id'=>1))->row()->email;?>
                                </p>
                            </li>                            

                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>





 <?php 
 //include ('../common/footer.php') 
    $this->load->view('rezdy/common/footer');
 ?>

