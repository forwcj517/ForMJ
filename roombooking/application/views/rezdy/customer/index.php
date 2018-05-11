
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

<div class="video-secation">
        
    <div class="main-video">
        <video  preload="auto" autoplay="true" loop="loop" muted="muted" volume="0" id="myVideo">
            <source src="<?php $path = $this->db->get_where('setting_contact', array('id' => 1))->row()->video_file; echo base_url($path); ?>" type="video/mp4">
            <source src="<?php $path = $this->db->get_where('setting_contact', array('id' => 1))->row()->video_file; echo base_url($path); ?>" type="video/ogg">
        </video> 
    </div>

    <div class="search-box">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="video-over">
                    <h1>Cabins4Crew</h1>
                    <div class="row">
<!--                        <?php echo form_open('user/home' , array('class' => 'form-horizontal form-groups-bordered validate'));?>                                                                -->
<!--                            <div class="col-xs-2"></div>
                            <div class="col-xs-4">
                                <select id="city_id" name="city_id" class="form-control input-lg" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                    <?php
                                    $country = $this->db->get('country')->result_array(); //array('company' => $this->session->userdata('admin_id'))
                                    foreach ($country as $row1):
                                        ?>
                                        <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == $country_id) echo " selected"?> >
                                            <?php echo $row1['code']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-warning waves-effect waves-light btn-block btn-lg " onclick="changeCountry()" type="submit">Search</button>                                
                            </div>-->
                    <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>


<!-- video section-->
<!-- home-tour-->
<div class="home-tour">
    <div class="container">
        <h1 class="home-title"><font face="verdana" color="gray">Rooms</font></h1>
        <!-- HOme-categories--->
        <div class="new-city-slider">
            <div class="container">
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="carousel slide media-carousel" id="media">
                            <div class="carousel-inner">
                                <?php
                                $i = 0;     
                                //$tours = $this->db->get_where('tours')->result_array();
                                foreach ($tours as $row1):
                                    ?>
                                    <?php if ($i % 5 == 0 && $i == 0) { ?>
                                        <div class="item active">                                                    
                                            <div class="row">
                                            <?php } else if ($i % 5 == 0) { ?>
                                                <div class="item">                                                    
                                                    <div class="row">      
                                                    <?php } ?>

                                                    <div class="col-md-55">
                                                        <a href="">
                                                            <div class="tour-section">
                                                                <a href="<?php echo site_url('user/overview/'.$row1['id'])?>">
                                                                    <img src="<?php 
                                                                    //if(strpos($row1['image'], 'http')){
                                                                    echo base_url($row1['image_url']);
                                                                     ?>" class="img-responsive img-radius" style="height: 200px;"> </a>
                                                                <div class="tour-dec">                    
                                                                    <p> <b> <?php  if(strlen($row1['name']) > 15){ echo $row1['name'].  substr(0, 14); }else{ echo $row1['name'];} ?> </b> </p>
                                                                    <div class="search_page_price">
                                                                        <h2><b> <?php echo currency().$row1['price'];?></b></h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                        
                                                        
                                                    <?php if (($i % 5 == 4 ) || sizeof($tours) == $i + 1) { ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php $i++;
                                        endforeach; ?>

                                    </div>
                                    <a data-slide="prev" href="#media" class="left carousel-control btn-warning btn-floating btn-large waves-effect waves-light red">‹</a>
                                    <a data-slide="next" href="#media" class="right carousel-control btn-warning btn-floating btn-large waves-effect waves-light red">›</a>
                                </div>                          
                       
                        </div>
                    </div>
                </div>
                <!--- Home-categories-->
            </div>
        </div>


        <!-- City-->
        <div class="home-city">
            <div class="container">
                <h1 class="home-title"><font face="verdana" color="gray">New Rooms</font></h1>
                
                
                        <div id="activity">
                             <?php
                                $i = 0;
                                
                                $query = $this->db->query("SELECT * FROM room ORDER BY id DESC LIMIT 12");
                                $tours = $query->result_array();                                
            
                                foreach ($tours as $row1):
                                    ?>                                                                                          
                                    <?php if ($i % 4 == 0 && $i == 0) { ?>                                                                               
                                            <div class="row">
                                    <?php } else if ($i % 4 == 0) { ?>                                                                     
                                            <div class="row">      
                                    <?php } ?>
                                            <div class="col-sm-3">                                    
                                            <a href="<?php echo site_url('user/overview/'.$row1['id'])?>">
                                                <div class="city-section">
                                                    <img src="<?php echo base_url($row1['image_url']); ?>" class="img-responsive" style="height:200px;"> 
                                                    <div class="city-over">
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
                                        
<!--                        <div class="text-center">
                            <button onclick="getTours()" class="btn btn-warning waves-effect waves-light ">See More</a>
                        </div>-->

            </div>
        </div>
        <!-- City-->

       

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
                                         toAppend = toAppend + '<img src="' + o.image_url + '" class="img-responsive" style="height:200px;"> <div class="city-over">';
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