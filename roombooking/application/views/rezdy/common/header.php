<!DOCTYPE html>
<html lang="en">
    
    <head>        
        <meta charset="utf-8">
        <title>Cabins4crew</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="<?php echo base_url('assets_extra/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets_extra/css/style.css'); ?>" rel="stylesheet">
        
        <!--<link href="<?php echo base_url('assets_extra/css/font-awesome.min.css'); ?>" rel="stylesheet">-->
        
<!--        <link href="<?php echo base_url('assets_extra/css/ionicons.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets_extra/css/ionicons.css'); ?>" rel="stylesheet">-->
        <link rel="shortcut icon" href="<?php echo base_url('assets_extra/img/favicon.png'); ?>">  
        <script type="text/javascript" src="<?php echo base_url('assets_extra/js/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets_extra/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets_extra/js/scripts.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets_extra/js/custom.js'); ?>"></script>                       
    </head>
    
    
    
    
    <body>
        <!-- Menu-->
        <nav nav class="navbar navbar-default"  style=" box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);">
            <div class="container">                
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed btn btn-warning waves-effect waves-light" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets_extra/img/logo.png'); ?>" style="width:60px; height:60px;"></a>
                </div>
                

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    <ul class="nav navbar-nav">                        
                        <li class="" id='home'><a href="<?php echo site_url("user/index"); ?>">Home</a></li>
                        <!--<?php if( $this->session->userdata('admin_login') == 4) { ?> 
                            <li id='reservation' ><a href="<?php echo site_url("user/my_profile"); ?>">My Profile</a></li>
                        <?php } ?> -->
                        <li id='search'><a href="<?php echo site_url("user/tours"); ?>">Rooms</a></li>
                        
<!--                        <li id='search'><a href="<?php echo site_url("user/search"); ?>">Search</a></li>                        
                        <li id='contact'><a href="<?php echo site_url("user/testimonials"); ?>">Testimonials</a></li>-->
                        <li id='contact'><a href="<?php echo site_url("user/my_book"); ?>">My Book</a></li>
                        <li id='contact'><a href="<?php echo site_url("user/blog"); ?>">Faq</a></li>
                        <li id='contact'><a href="<?php echo site_url("user/contactus"); ?>">Contact Us</a></li>                        
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">                                                                                  
                        <?php if( $this->session->userdata('admin_login') == 2) {?>
                            <li><a href="<?php echo site_url('login/customer_logout'); ?>" data-toggle="" data-target="#signup"> Logout </a></li>      
                            <?php } else { ?>
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#signup-form"> Sign Up </a></li>       
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>  <a href="javascript:void(0)" data-toggle="modal" data-target="#login">Customer </a></li>
                                    <li><a href="<?php echo site_url('login'); ?>"> Administrator </a></li>                                
                                </ul>
                            </li>                                                         
                        <?php } ?>       
                            
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- Menu-->
        

        <!-- Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="omb_login">

                            <div class="row  omb_socialButtons">
                                <div class="col-xs-12 col-sm-12">
                                       
<!--                                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                        </fb:login-button>
                                        <div id="status">
                                        </div>-->
                                </div>
<!--                                <div class="col-xs-12 col-sm-12" style="margin-top:10px;">
                                        <a href="#" class="btn btn-lg btn-block omb_btn-google waves-effect waves-light">
                                                <span>Google Plus</span>
                                        </a>
                                </div>-->
                            </div>
                            
                            <div class="row  omb_loginOr">
                                    <div class="col-xs-12 col-sm-12">
                                            <hr class="omb_hrOr">
                                            <span class="omb_spanOr">or</span>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12">                                    
                                    <!--<form class="omb_loginForm" action="" autocomplete="off" method="POST">-->
                                    <?php echo form_open('login/customer_login' , array('class' => 'form-horizontal form-groups-bordered validate'));?>                                        
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="email" placeholder="email address">
                                        </div>
                                        <br>
                                        <div class="input-group" style="margin-top:10px;">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input  type="password" class="form-control" name="password" placeholder="Password">
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="remember-me">Remember Me
                                                </label>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <p class="omb_forgotPwd">
                                                    <a href="#">Forgot password?</a>
                                                </p>
                                            </div>
                                        </div>

                                        <button class="btn btn-warning waves-effect waves-light btn-block btn-lg " type="submit">Login</button>
                                    <?php echo form_close();?>
                                </div>
                            </div>	    	
                        </div>


                    </div>
                    <div class="modal-footer nomargin">
                        <p class="pull-left">Don't have an account?</p>
                        <button type="button"  data-toggle="modal" data-target="#signup-form"  data-dismiss="modal" class="btn btn-default  waves-effect waves-light pull-right btn-sm">Sign Up</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>


        
        
        

        <!-- Modal -->
        <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="omb_login">
                                                                                                                               
                            
<!--                            <div class="row  omb_socialButtons">
                                <div class="col-xs-12 col-sm-12">
                                    <a href="#" class="btn btn-lg btn-block omb_btn-facebook waves-effect waves-light">
                                        <span>Facebook</span>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-12" style="margin-top:10px;">
                                    <a href="#" class="btn btn-lg btn-block omb_btn-google waves-effect waves-light">
                                        <span>Google Plus</span>
                                    </a>
                                </div>
                            </div>-->

                            <div class="row  omb_loginOr">
                                <div class="col-xs-12 col-sm-12">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr">or</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12">	
                                    <form class="omb_loginForm" action="" autocomplete="off" method="POST">	
                                        <button class="btn btn-warning waves-effect waves-light btn-block btn-lg" data-dismiss="modal"   data-toggle="modal" data-target="#signup-form"  type="submit">Sign up with Email</button>
                                    </form>
                                </div>
                            </div>	   

                            <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->		
                        </div>

                    </div>
                    <div class="modal-footer nomargin">
                        <p class="pull-left">Already have an account</p>
                        <button type="button" data-toggle="modal" data-target="#login" class="btn btn-default  waves-effect waves-light pull-right btn-sm" data-dismiss="modal">Sign In</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>


        
        
        <!-- model-->
        <div class="modal fade" id="signup-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="omb_login">

                            <div class="row  omb_socialButtons">
                                <p class="text-center">Sign up with <a href="" style="color:#ff5a5f">Facebook</a> or  <a href="" style="color:#ff5a5f">Google</a></p>
                            </div>

                            <div class="row  omb_loginOr">
                                <div class="col-xs-12 col-sm-12">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr">or</span>
                                </div>
                            </div>		

                            <div class="row">
                                <div class="col-xs-12 col-sm-12">	
                                    <?php echo form_open_multipart('login/customer_register/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" class="form-control" name="email" placeholder="email address" required="true">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="fname" placeholder="First Name" required="true">
                                        </div>
                                        <br>
                                        
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required="true">
                                        </div>
                                        <br>
                                        
                                         <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="number" class="form-control" name="phone" placeholder="Phone Number" required="true">
                                        </div>
                                        <br>                                        
                                        
                                        <div class="input-group" style="margin-top:10px;">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input  type="password" class="form-control" name="password" placeholder="Create Password" required="true">
                                        </div>

                                        <div class="input-group" style="margin-top:10px;">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input  type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="true">
                                        </div>
                                                                                
                                        <br>
                                        
                                        
                           
                                        
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <label class="checkbox" style="font-weight:100">
                                                    <!--<input type="checkbox" value="remember-me">Lorem Ipsum is simply dummy text of the printing and typesetting industry.-->
                                                </label>

                                                <!--<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>-->
                                                <button class="btn btn-warning waves-effect waves-light btn-block btn-lg " type="submit">Login</button>

                                            </div>
                                        </div>

                                    </form>
                                </div>	    	
                            </div>
                           
                        </div>
                    </div>
                    <div class="modal-footer nomargin">
                        <p class="pull-left">Already have an account</p>
                        <button type="button" data-toggle="modal" data-target="#login" class="btn btn-default  waves-effect waves-light pull-right btn-sm" data-dismiss="modal">Sign In</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        
                               


<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker3.min.css'); ?>" />
<script src="<?php echo base_url('assets_extra/js/bootstrap-datepicker.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        
        $(".nav li").on("click", function() {
            $(".nav li").removeClass("active");
            $(this).addClass("active");
        });
    
        $('#datePicker2')
                .datepicker({
                    format: 'mm/dd/yyyy'
                })                
    })
        
    
  
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-63787149-1', 'auto');
    ga('send', 'pageview'); (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-63787149-1', 'auto');
    ga('send', 'pageview');
  
</script>



<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '104976206654615',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>





