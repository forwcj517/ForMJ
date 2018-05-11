<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Surf You To The Moon</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">

        <meta name="author" content="">
       <link href="<?php echo base_url('assets_extra/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets_extra/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets_extra/css/font-awesome.min.css'); ?>" rel="stylesheet">
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
        <nav class="navbar navbar-default custom-heder  navbar-fixed-top">
            <div class="">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed btn btn-warning waves-effect waves-light" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url("user/index"); ?>"><img src="<?php echo base_url('assets_extra/img/logo.png'); ?>"></a>
                </div>
                <script>
                    $(document).ready(function () {
                        $(".main-1").click(function () {
                            $(".main-1").css("width", "50%")
                            $(".main-2").css("width", "25%")
                            $(".main-3").css("width", "25%")
                        });
                        $(".main-2").click(function () {
                            $(".main-2").css("width", "50%")
                            $(".main-1").css("width", "25%")
                            $(".main-3").css("width", "25%")
                        });
                        $(".main-3").click(function () {
                            $(".main-3").css("width", "50%")
                            $(".main-2").css("width", "25%")
                            $(".main-1").css("width", "25%")
                        });
                    });
                </script>
                <script>
                    // This example displays an address form, using the autocomplete feature
                    // of the Google Places API to help users fill in the information.

                    // This example requires the Places library. Include the libraries=places
                    // parameter when you first load the API. For example:
                    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                    function initAutocomplete() {
                        // Create the autocomplete object, restricting the search to geographical
                        // location types.
                        autocomplete = new google.maps.places.Autocomplete(
                                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                                {types: ['geocode']});

                        // When the user selects an address from the dropdown, populate the address
                        // fields in the form.
                        //autocomplete.addListener('place_changed', fillInAddress);
                        google.maps.event.addListener(autocomplete, 'place_changed', function() {
                            var place = autocomplete.getPlace();                            
                            console.log(place.address_components);                            
                            //alert(place.geometry.location.lng())
                            getNearBy(place.geometry.location.lat(), place.geometry.location.lng(), "#mydiv");                            
                        });
                        
                        
//                        var uluru = {lat: -25.363, lng: 131.044};
//                        var map = new google.maps.Map(document.getElementById('map'), {
//                            zoom: 4,
//                            center: uluru
//                        });
//                        var contentString = '<div class="multi-slider-section" style="margin:0px;"><a  href="overview.php"><div class="tour-section"><img src="<?php echo base_url('assets_extra/img/homes.jpg'); ?>" style="width: 291px; height: 150px;" class="img-responsive"></div></a><div class="tour-dec"><a  href="overview.php"><h4><b>₹9,166</b> Secluded Intown Treehouse</h4><p>Entire home/apt - 2 beds</p><div class="fullwidth"><div class="star-home"><i class="fa fa-star yellow"></i><i class="fa fa-star yellow"></i><i class="fa fa-star yellow"></i><i class="fa fa-star yellow"></i><i class="fa fa-star yellow"></i>84 reviews</div></div></a></div></div>';
//
//                        var infowindow = new google.maps.InfoWindow({
//                            content: contentString
//                        });
//
//                        var marker = new google.maps.Marker({
//                            position: uluru,
//                            map: map,
//                            title: 'Uluru (Ayers Rock)',
//                            icon: '<?php echo base_url('assets_extra/img/marker.png'); ?>'
//                        });
//                        marker.addListener('click', function () {
//                            infowindow.open(map, marker);
//                        });

                    }

                    // Bias the autocomplete object to the user's geographical location,
                    // as supplied by the browser's 'navigator.geolocation' object.
                    function geolocate() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function (position) {
                                var geolocation = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                };
                                var circle = new google.maps.Circle({
                                    center: geolocation,
                                    radius: position.coords.accuracy
                                });
                                autocomplete.setBounds(circle.getBounds());
                                if(current == 1){
                                    getNearBy(position.coords.latitude, position.coords.longitude, "#nearby");
                                }                                
                            });
                        }
                    }
                    
                    
                    function getNearBy(lat, lon, mydiv) {        
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo site_url('user/getNearBy'); ?>",
                            dataType: 'json',
                            data: {lat: lat, lon: lon},
                            success: function (data) {
                                if (data)
                                {
                                    // Show Entered Value                           
                                    locations = data.location;        
                                    var toAppend = '';
                                    $i = 0;
                                    $.each(locations,function(i,o){ 
                                        
                                         if ($i % 4 == 0 ) {
                                            toAppend = toAppend + '<div class="multi-slider-section">';
                                         }           
                                            toAppend = toAppend + '<div class="col-sm-3">';
                                                    toAppend = toAppend + '<div id="homes-slider1" class="carousel slide" data-ride="carousel">';
                                                        toAppend = toAppend + '<div class="carousel-inner" role="listbox">';
                                                            toAppend = toAppend + '<div class="item active">';
                                                                toAppend = toAppend + '<a  href="<?php echo site_url('user/overview/')?>'+ o.id + '">';
                                                                    toAppend = toAppend + '<div class="tour-section">';
                                                                        toAppend = toAppend + '<img src="<?php echo base_url(); ?>'+ o.image_url +'" style="width:100%;height: 300px;">';
                                                                    toAppend = toAppend + '</div>';
                                                                toAppend = toAppend + '</a>';
                                                            toAppend = toAppend + '</div>';
                                                        toAppend = toAppend + '</div>';
                                                    toAppend = toAppend + '</div>';

                                                    toAppend = toAppend + '<div class="tour-dec">';
                                                        toAppend = toAppend + '<a  href="<?php echo site_url('user/overview/')?>' +o.id+ '">';
                                                            toAppend = toAppend + '<h4><b>₹' + o.price +'</b> ' +o.name+ '</h4>';
                                                            toAppend = toAppend + '<p>Entire home/apt - 2 beds</p>';
                                                            toAppend = toAppend + '<div class="fullwidth">';
                                                                toAppend = toAppend + '<div class="star-home">';
                                                                    toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
                                                                    toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
                                                                    toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
                                                                    toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
                                                                    toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
                                                                    toAppend = toAppend + '84 reviews';
                                                                toAppend = toAppend + '</div>';
                                                            toAppend = toAppend + '</div>';
                                                        toAppend = toAppend + '</a>';
                                                    toAppend = toAppend + '</div>';
                                                toAppend = toAppend + '</div>';
                                                if (($i % 4 == 3 ) || locations.length == $i + 1) {
                                                    toAppend = toAppend + '</div>                            ';
                                                }                                                 
                                                 $i = $i + 1;
                                    });
//                                    if(locations.length > 0){
                                        $(mydiv).html( toAppend );
//                                    }
                                }
                            }
                        });
                    }        
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCndLJgwOIMsLuT_vzwPCUa9Qp3NZrq-8M &libraries=places&callback=initAutocomplete"
                async defer></script>

                <style>
                    .pac-container
                    {
                        z-index:999999;
                    }
                </style>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav left-nav-bar">                                                             
                        <li class="main-1">
                            <div class="nav-icons">
                                <!--<input type="text" class="form-control input-lg" placeholder="Anywhere" id="autocomplete1" onFocus="geolocate()">-->
                            </div>				
                        </li>                                                           
<!--                        <li class="main-2">
                            <div class="nav-icons anytime demo">
                                <div class="nav-icon-ab">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control input-lg" placeholder="Anytime" id="config-demo">
                            </div>					
                        </li>            
                        <li class="main-3">
                            <div class="nav-icons anytime">
                                <div class="nav-icon-ab">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control input-lg" placeholder="1 guest">
                            </div>			
                        </li>-->
                    </ul>


<!--                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Become a Host</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#signup">Sign Up </a></li>
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login">Log in </a></li>              
                    </ul>-->
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <!-- Menu-->        
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('assets_extra/css/daterangepicker.css'); ?>" />
        <script type="text/javascript" src="<?php echo base_url('assets_extra/js/moment.js'); ?>"></script>  
        <script type="text/javascript" src="<?php echo base_url('assets_extra/js/daterangepicker.js'); ?>"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                updateConfig();
                function updateConfig() {
                    var options = {};
                    if ($('#ranges').is(':checked')) {
                        options.ranges = {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        };
                    }

                    if ($('#locale').is(':checked')) {
                        $('#rtl-wrap').show();
                        options.locale = {
                            direction: $('#rtl').is(':checked') ? 'rtl' : 'ltr',
                            format: 'MM/DD/YYYY HH:mm',
                            separator: ' - ',
                            applyLabel: 'Apply',
                            cancelLabel: 'Cancel',
                            fromLabel: 'From',
                            toLabel: 'To',
                            customRangeLabel: 'Custom',
                            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            firstDay: 1
                        };
                    } else {
                        $('#rtl-wrap').hide();
                    }


                    $('#config-text').val("$('#demo').daterangepicker(" + JSON.stringify(options, null, '    ') + ", function(start, end, label) {\n  console.log(\"New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')\");\n});");

                    $('#config-demo').daterangepicker(options, function (start, end, label) {
                        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
                    });

                }

            });
        </script>

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
                                    <a href="#" class="btn btn-lg btn-block omb_btn-facebook waves-effect waves-light">
                                        <span>Facebook</span>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-12" style="margin-top:10px;">
                                    <a href="#" class="btn btn-lg btn-block omb_btn-google waves-effect waves-light">
                                        <span>Google Plus</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row  omb_loginOr">
                                <div class="col-xs-12 col-sm-12">
                                    <hr class="omb_hrOr">
                                    <span class="omb_spanOr">or</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12">	
                                    <form class="omb_loginForm" action="" autocomplete="off" method="POST">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="username" placeholder="email address">
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
                                    </form>
                                </div>
                            </div>	    	
                        </div>


                    </div>
                    <div class="modal-footer nomargin">
                        <p class="pull-left">Don't have an account?</p>
                        <button type="button"  data-toggle="modal" data-target="#signup"  data-dismiss="modal" class="btn btn-default  waves-effect waves-light pull-right btn-sm">Sign Up</button>
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
                            <div class="row  omb_socialButtons">
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
                            </div>

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

                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>		
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
                                    <form class="omb_loginForm" action="" autocomplete="off" method="POST">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" class="form-control" name="username" placeholder="email address">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="" placeholder="First Name">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="" placeholder="Last Name">
                                        </div>
                                        <br>
                                        <div class="input-group" style="margin-top:10px;">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input  type="password" class="form-control" name="password" placeholder="Create Password">
                                        </div>

                                        <div class="form-group">
                                            <p style="margin:15px 0px 0px"><b>Birth</b></p>
                                            <p>Lorem Ipsum is simply dummy text of the </p>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <select class="form-control">
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control">
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <label class="checkbox" style="font-weight:100">
                                                    <input type="checkbox" value="remember-me">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                </label>

                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>

                                                <button class="btn btn-warning waves-effect waves-light btn-block btn-lg " type="submit">Login</button>
                                                </form>
                                            </div>
                                        </div>
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
</script>