
<?php
//include ('../common/header.php') 
$this->load->view('rezdy/common/header');
?>

<!-- video-secation-->
<!--<script>
    $(document).ready(function () {
        $('video').get(0).play();    
    });
</script>

<script> document.getElementById('myVideo').play();</script>-->
<script src="https://www.jscache.com/wejs?wtype=cdsscrollingravenarrow&uniq=95&locationId=10049979&lang=en_US&border=true&shadow=false&backgroundColor=gray&display_version=2"></script>



        <!-- City-->
        <div class="home-city"  style="background: black">
            <div class="container">
                <h1 class="home-title"><font face="verdana" color="gray">Philippines Hotels</font></h1>
                                
                        <div id="activity">
                             <?php
                                $i = 0;
                                foreach ($tours as $row1):
                                    ?>                                                                                          
                                    <?php if ($i % 4 == 0 && $i == 0) { ?>                                                                               
                                            <div class="row">
                                    <?php } else if ($i % 4 == 0) { ?>                                                                     
                                            <div class="row">      
                                    <?php } ?>
                                            <div class="col-sm-3">                                    
                                            <a href="<?php echo site_url('user/overview_hotel/'.$row1['id'])?>">
                                                <div class="city-section">
                                                    <img src="<?php if (strpos($row1['image'], 'http') !== false) { echo $row1['image'];  }else{ echo base_url($row1['image']); };?>" class="img-responsive" style="height:200px;"> <div class="city-over">
                                                        <h2><?php echo $row1['name']; ?> </h2>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>  
                                    <?php if (($i % 4 == 3 ) || sizeof($tours) == $i + 1) { ?>
                                        </div>                                
                                    <?php } ?>
                                    <?php $i++;
                                    endforeach; ?>                                               
                        </div>
                       
                                        
                        <div class="text-center">
                            <button onclick="getTours()" class="btn btn-warning waves-effect waves-light ">See More</a>
                        </div>

            </div>
        </div>
        <!-- City-->

        <div class="home-about" style="background: black">
            <div class="container">
                
                <!--<h1 class="home-title">About Us</h1>-->        
                <p>                    
                    <div id="TA_cdsscrollingravenarrow95" class="TA_cdsscrollingravenarrow " style="width: 300px;">
                        <ul id="C3qYLs1A6w" class="TA_links mNf6cAqE">
                          <li id="H6F3BxAcE" class="HVUy9VNS"><a href="https://www.tripadvisor.com/" target="_blank" rel="noopener"><img id="CDSWIDEXCLOGO" class="widEXCIMG" src="https://static.tacdn.com/img2/t4b/Stacked_TA_logo.png" alt="TripAdvisor" /></a></li>
                        </ul>
                    </div>           
                </p>
                
            </div>
        </div>
        <!-- home-about-->
        

<script>
    $('document').ready(function () {
        //window.location.replace("http://www.w3schools.com");
    });
          
    function changeCountry() {                  
        var pathArray = location.href.split( '/' );
        var protocol = pathArray[0];
        var host = pathArray[2];
        var url = protocol + '//' + host;        
        window.location.replace(url + '/rezdy/index.php/user/home/' + $('select[name=city_id]').val() );
    }
    function gotoHotel(){
        var pathArray = location.href.split( '/' );
        var protocol = pathArray[0];
        var host = pathArray[2];
        var url = protocol + '//' + host;        
        window.location.replace(url + '/rezdy/index.php/user/hotel_flight');
    }
    
   function getTours() {
        var id = <?php echo $country_id; ?>;

        

            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url('api/getTourByCountryId'); ?>",
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    if (data)
                    {
                        // Show Entered Value                           
                        locations = data.tours;
                        var toAppend = '';
                        $i = 0;
                        $.each(locations, function (i, o) {

                            if ($i % 4 == 0) {
                                toAppend = toAppend + '<div class="multi-slider-section">';
                            }                            
                             toAppend = toAppend + '<div class="col-sm-3">';
                                toAppend = toAppend + '<a  href="<?php echo site_url('user/overview/') ?>' + o.id + '">';
                                     toAppend = toAppend + '<div class="city-section">';
                                         if(o.image_url.includes("http")){
                                             toAppend = toAppend + '<img src="' + o.image_url + '" class="img-responsive" style="height:200px;"> <div class="city-over">';
                                         }else{                                        
                                            var base_url = "<?php echo base_url();?>";
                                            toAppend = toAppend + '<img src="' +  base_url + "/" + o.image_url + '" class="img-responsive" style="height:200px;"> <div class="city-over">';
                                         }
                                         
                                            toAppend = toAppend + '<h2>' + o.name +'</h2>';
                                        toAppend = toAppend + '</div>';
                                    toAppend = toAppend + '</div>';
                                toAppend = toAppend + '</a>'
                            toAppend = toAppend + '</div>'
                    
                            
                            
//                            toAppend = toAppend + '<div class="col-sm-3">';
//                            toAppend = toAppend + '<div id="homes-slider1" class="carousel slide" data-ride="carousel">';
//                            toAppend = toAppend + '<div class="carousel-inner" role="listbox">';
//                            toAppend = toAppend + '<div class="item active">';
//                            toAppend = toAppend + '<a  href="<?php echo site_url('user/overview/') ?>' + o.id + '">';
//                            toAppend = toAppend + '<div class="tour-section">';
//                            toAppend = toAppend + '<img src="' + o.image_url + '" style="width:100%;height: 300px;">';
//                            toAppend = toAppend + '</div>';
//                            toAppend = toAppend + '</a>';
//                            toAppend = toAppend + '</div>';
//                            toAppend = toAppend + '</div>';
//                            toAppend = toAppend + '</div>';
//
//                            toAppend = toAppend + '<div class="tour-dec">';
//                            toAppend = toAppend + '<a  href="<?php echo site_url('user/overview/') ?>' + o.id + '">';
//                            toAppend = toAppend + '<h4><b>$' + o.price + '</b> ' + o.name + '</h4>';
//                            //toAppend = toAppend + '<p>Entire home/apt - 2 beds</p>';
//                            toAppend = toAppend + '<div class="fullwidth">';
//                            toAppend = toAppend + '<div class="star-home">';

//                            if (o.rate_count == 5) {
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//
//                            } else if (o.rate_count == 4) {
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                            } else if (o.rate_count == 3) {
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                            } else if (o.rate_count == 2) {
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                            } else {
//                                toAppend = toAppend + '<i class="fa fa-star yellow"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                                toAppend = toAppend + '<i class="fa fa-star gray"></i>';
//                            }

//                            toAppend = toAppend + o.rate + ' reviews';
//                            toAppend = toAppend + '</div>';
//                            toAppend = toAppend + '</div>';
//                            toAppend = toAppend + '</a>';
//                            toAppend = toAppend + '</div>';
//                            toAppend = toAppend + '</div>';
                            
                            
                            if (($i % 4 == 3) || locations.length == $i + 1) {
                                toAppend = toAppend + '</div>                            ';
                            }
                            $i = $i + 1;
                        });
                        //                                    if(locations.length > 0){
                        $("#activity").html(toAppend);
                        //                                    }
                    }
                }
            });
        
    }
    
</script>

<?php
$this->load->view('rezdy/common/footer');
?>