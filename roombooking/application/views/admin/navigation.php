<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style=""> 
            <a href="<?php echo site_url()."/admin"; ?>">
                <img src="<?php echo base_url('assets_extra/img/logoo.png'); ?>"  style="max-height:60px;"/>
            </a>
        </div>
        
        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style="border-top:1px solid rgba(255, 255, 255, 0.9);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url("admin/dashboard"); ?>">
                <i class="entypo-home"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!--user management-->
        <li class="<?php if ($page_name == 'manager_provider' || $page_name == 'manager_guider' || $page_name == 'manager_customer') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('manage_user'); ?></span>
            </a>
            <ul>                                
                <?php if ($this->session->userdata('admin_login') == 1) { ?>                
<!--                    <li class="<?php if ($page_name == 'manager_provider') echo 'active'; ?> ">
                        <a href="<?php echo site_url("admin/manager_provider"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('Provider'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manager_guider') echo 'active'; ?> ">
                        <a href="<?php echo site_url("admin/manager_guider"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('Tour Guide'); ?></span>
                        </a>
                    </li>-->
                
                    <li class="<?php if ($page_name == 'manager_customer') echo 'active'; ?>">
                        <a href="<?php echo site_url("admin/manager_customer"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('Customers'); ?></span>
                        </a>
                    </li>

                <?php } else { ?>
                    <li class="<?php if ($page_name == 'manager_guider') echo 'active'; ?> ">
                        <a href="<?php echo site_url("admin/manager_guider"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('Tour Guider'); ?></span>
                        </a>
                    </li>

                <?php } ?>
            </ul>
        </li>
        

         <?php if ($this->session->userdata('admin_login') == 2 || $this->session->userdata('admin_login') == 3) { ?>      
            <li class="<?php if ($page_name == 'tour_category' || $page_name == 'tour_city' || $page_name == 'tour_all') echo 'opened active'; ?> ">                
                <a href="#">
                    <i class="entypo-lifebuoy"></i>
                    <span><?php echo get_phrase('Tour Management'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'tour_category') echo 'active'; ?> ">
                        <a href="<?php echo site_url("admin/tour_category"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('Tour by Category'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'tour_city') echo 'active'; ?> ">
                        <a href="<?php echo site_url("admin/tour_city"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('Tour by City'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'tour_all') echo 'active'; ?> ">
                        <a href="<?php echo site_url("admin/tour_all"); ?>">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('All tours'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
         <?php }?>
        
        
        
        <?php if ($this->session->userdata('admin_login') != 1) { ?> 
            <li class="<?php if ($page_name == 'basic_allocation') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/basic_allocation"); ?>">
                    <i class="entypo-adjust"></i>
                    <span><?php echo get_phrase('Tour-Guider Allocation'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'basic_question') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/basic_question"); ?>">
                    <i class="entypo-book-open"></i>
                    <span><?php echo get_phrase('Add Questoins'); ?></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'basic_addons') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/basic_addons"); ?>">
                    <i class="entypo-export"></i>
                    <span><?php echo get_phrase('Add Ons'); ?></span>
                </a>
            </li>

             <li class="<?php if ($page_name == 'basic_time_schedule') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/basic_time_schedule"); ?>">
                    <i class="entypo-cc-by"></i>
                    <span><?php echo get_phrase('Add Time Schedule'); ?></span>
                </a>
            </li>
        <?php } ?>  
                
        <li class="<?php if ($page_name == 'reservations' || $page_name == 'reservation_cancel' || $page_name == 'reservation_reschedule' ) echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-retweet"></i>
                <span><?php echo get_phrase('Reservations'); ?></span>
            </a>
            <ul>         
                <li class="<?php if ($page_name == 'reservations') echo 'active'; ?> ">
                    <a href="<?php echo site_url("admin/reservations"); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('My Reservations'); ?></span>
                    </a>
                </li>
                
                <li class="<?php if ($page_name == 'reservation_cancel') echo 'active'; ?> ">
                    <a href="<?php echo site_url("admin/reservation_cancel"); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Cancel Reservation'); ?></span>
                    </a>
                </li>
                
<!--                <li class="<?php if ($page_name == 'reservation_reschedule') echo 'active'; ?> ">
                    <a href="<?php echo site_url("admin/reservation_reschedule"); ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('Rechedule Reservation'); ?></span>
                    </a>
                </li>  -->
                
            </ul>
        </li>
        

                
        <?php if ($this->session->userdata('admin_login') == 1) { ?> 
        
            <li class="<?php if ($page_name == 'manager_city') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/manager_city"); ?>">
                    <i class="entypo-book"></i>
                    <span><?php echo get_phrase('City Management'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'manager_room') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/manager_room"); ?>">
                    <i class="entypo-rocket"></i>
                    <span><?php echo get_phrase('Room Management'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'manager_room_type') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/manager_room_type"); ?>">
                    <i class="entypo-bookmark"></i>
                    <span><?php echo get_phrase('Room Type'); ?></span>
                </a>
            </li>
        
            <li class="<?php if ($page_name == 'setting_contact' || $page_name == 'setting_file' || $page_name == 'email' ) echo 'opened active'; ?> ">
                <a href="#">
                    <i class="entypo-users"></i>
                    <span><?php echo get_phrase('configuration'); ?></span>
                </a>
                <ul>

                        <li class="<?php if ($page_name == 'setting_contact') echo 'active'; ?> ">
                            <a href="<?php echo site_url("admin/setting_contact"); ?>">
                                <span><i class="entypo-dot"></i> <?php echo get_phrase('Contact Us'); ?></span>
                            </a>
                        </li> 

                        <li class="<?php if ($page_name == 'setting_file') echo 'active'; ?> ">
                            <a href="<?php echo site_url("admin/setting_file"); ?>">
                                <span><i class="entypo-dot"></i> <?php echo get_phrase('Setting File'); ?></span>
                            </a>
                        </li>    
<!--                        <li class="<?php if ($page_name == 'email') echo 'active'; ?> ">
                            <a href="<?php echo site_url("admin/email"); ?>">
                                <span><i class="entypo-dot"></i>
                                <span><?php echo get_phrase('Email Format'); ?></span>
                            </a>
                        </li> -->
                </ul>
            </li>

<!--            <li class="<?php if ($page_name == 'contact_message') echo 'active'; ?> ">
                <a href="<?php echo site_url("admin/contact_message"); ?>">
                    <i class="entypo-retweet"></i>
                    <span><?php echo get_phrase('Contact Messages'); ?></span>
                </a>
            </li>    
                 
            <li class="<?php if ($page_name == 'basic_blog') echo 'active'; ?> ">
               <a href="<?php echo site_url("admin/basic_blog"); ?>">
                   <i class="entypo-block"></i>
                   <span><?php echo get_phrase('Blog'); ?></span>
               </a>
           </li>    -->                
        
        <?php } ?>  



        <li class="<?php if ($page_name == 'manager_transaction') echo 'active'; ?> ">
            <a href="<?php echo site_url("admin/manager_transaction"); ?>">
                <i class="entypo-bookmarks"></i>
                <span><?php echo get_phrase('Manager Transaction'); ?></span>
            </a>
        </li>

        <li class="<?php if ($page_name == 'manager_monthly_transaction') echo 'active'; ?> ">
            <a href="<?php echo site_url("admin/manager_monthly_transaction"); ?>">
                <i class="entypo-bookmarks"></i>
                <span><?php echo get_phrase('Manager Monthly Transaction'); ?></span>
            </a>
        </li>
        
        
        
        
    </ul>

</div>