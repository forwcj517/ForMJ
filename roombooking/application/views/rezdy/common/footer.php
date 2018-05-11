
<!-- footer-->
<div class="footer">
	<div class="container">
    	<div class="row">
        	<div class="col-md-4 col-sm-6">
				<p><img src="<?php echo base_url('assets_extra/img/logo.png');?>"></p>
<!--                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. 
If you are going to use a passage of Lorem Ipsum middle of text.</p>-->
            </div>
        	<div class="col-md-2 foot-menu col-sm-6">
            	<h2>More Links</h2>
                <p><a href="<?php echo base_url('index.php/user/privacy_policy');?>">Privacy Policy</a></p>
                <p><a href="<?php echo base_url('index.php/user/terms');?>">Terms and Condition</a></p>
                <p><a href="<?php echo base_url('index.php/user/faq');?>">Faq</a></p>
                <p><a href="">Contact Us</a></p>


            </div>
        	<div class="col-md-2 social col-sm-6">
            	<h2>Social</h2>
                
<!--                <a href="https://www.facebook.com/surfyoutothemoon" target="_blank" class="btn-warning btn-floating btn-large waves-effect waves-light red"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--                <a href="#" class="btn-warning btn-floating btn-large waves-effect waves-light red"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#" class="btn-warning btn-floating btn-large waves-effect waves-light red"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <a href="#" class="btn-warning btn-floating btn-large waves-effect waves-light red"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
            </div>
        	<div class="col-md-4 foot-cont col-sm-6">
            	<h2>Contact Us</h2>
                <p><?php  echo $this->db->get_where('setting_contact', array('id'=>1))->row()->address;?></p>	
                <p><?php  echo $this->db->get_where('setting_contact', array('id'=>1))->row()->email;?></p>	
                <p><?php  echo $this->db->get_where('setting_contact', array('id'=>1))->row()->phone;?></p>	
                
            </div>
        </div>
    </div>
</div>
<!-- footer-->
<!-- copyright-->
<!--<div class="copyright">
	<div class="container">
    &copy; Copyright 2017 Web Widers Software Solutions. All Rights Reserved.
    </div>
</div>-->

<!-- copyright-->
</div>

</body>
</html>
