<!-- Footer -->
<!--
<script type="text/javascript" src="<?php echo base_url('assets_extra/js/scripts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets_extra/js/custom.js'); ?>"></script>                                        
 <link href="<?php echo base_url('assets_extra/css/style.css'); ?>" rel="stylesheet">        

-Chat--
<div class="text-center">
    <div class="row">
        <div class="round hollow">
            <a href="javascript:void(0)" id="addClass"><span class="glyphicon glyphicon-comment"></span> Support Chat </a>
        </div>

    </div>
</div>

<div class="popup-box chat-popup" id="qnimate">
    <div class="popup-head">
        <div class="popup-head-left pull-left">Chat with Support </div>
        <div class="popup-head-right pull-right">

            <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="popup-messages" style="height:308px">


        <div class="chat-form" id="chatfrom1" style=" display:block; ">
            <p> <b>Note:</b> To chat with our Support Team, please enter your information.To help us serve you better, please provide some information before we begin your chat.</p>
            <form class="form-horizontal" method="post" action="#" onSubmit="">
                 Text input
                <div class="form-group">
                    <div class="col-md-12">
                        <input placeholder="Your Email" value="" required class="form-control input-md" id="email" type="email">					
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">			
                        <input placeholder="Your Password" value=" " required class="form-control input-md" id="password" type="password">					
                    </div>
                </div>
                 Text input
                
                 Text input
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button  onclick="startChart()" type="submit" class="btn btn-success">Lets Start</button>					
                    </div>
                </div>
            </form>
        </div>
        <div class="chat-hide" id="chatfrom2" style=" display:none; ">
            <div class="direct-chat-messages" style="height:308px">
                 Message. Default to the left 
                <div class="direct-chat-msg doted-border">
                    <div class="clearfix">
                        <span class="direct-chat-name pull-left">Support</span>
                        <span class="direct-chat-timestamp pull-right">3:05 PM</span>
                    </div>
                     /.direct-chat-info                       
                    <div class="direct-chat-text">
                        Hello, How can i help you today.Please write your query below..
                    </div>
                </div>
                               
                <div id="msg_container">
                    <div id="messages">
                    <?php foreach ($messages as $message): ?>
                    
                        
                    <div class="direct-chat-msg doted-border">
                        <div class="clearfix">
                              <span class="direct-chat-name pull-left"><?php print $message['sender']; ?></span>
                              <span class="direct-chat-timestamp pull-right">[<?php print $message['created_at']; ?>]</span>
                        </div>
                         /.direct-chat-info                       
                        <div class="direct-chat-text">
                             <?php print $message['message']; ?>							  
                        </div>
                    </div>
                    
                    <div class="direct-chat-msg you-border">
                        <div class="clearfix">
                              <span class="direct-chat-name pull-right"><?php print $message['sender']; ?></span>
                              <span class="direct-chat-timestamp pull-left">[<?php print $message['created_at']; ?>]</span>
                        </div>
                         /.direct-chat-info 
                        <div class="direct-chat-text1">
                              <?php print $message['message']; ?>								  
                        </div>
                      </div>                    
                 
                    <?php endforeach; ?>                 
                    </div>
                </div>
                
            </div>
            
            <div class="popup-messages-footer">                
               <?php echo form_open('messages/create', array('id' => 'new-message-form')) ?>
                
                <input hidden="true" type="input" name="sender" class="form-text" value="<?php echo $this->session->userdata('admin_id');?>"/>
                <input hidden="true" type="input" name="receiver" class="form-text" value="<?php echo $this->session->userdata('admin_id');?>"/>
                
                <input type="input" name="msg" class="form-text"/>
                <input type="submit" name="submit" value="Send Message" class="form-submit"/>
              </form>
            </div>
            <div class="popup-messages-footer">
                <textarea onkeyup="if (event.keyCode == 13) {
                            SendLivechatMsg();
                        }" style="border: 1px solid; height: 48px;" id="status_message" placeholder="Type your message..." rows="10" cols="40" name="message"></textarea>
            </div>
        </div>
    </div>
</div>-->

<footer class="main">
<div>
	&copy; 2016 <strong><?php echo $system_name;?></strong>
	<br>
	Developed by 
	<a href="#" target="_blank">wang</a>
	</div>
</footer>

