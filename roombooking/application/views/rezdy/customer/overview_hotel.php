<!DOCTYPE html>
<?php    
    $this->load->view('rezdy/common/header');                                                                                        
?>

<?php 
    $data = $this->db->get_where('restaurant', array('id'=>$id))->row();
//    if($type == "0"){            
//        echo "<script type='text/javascript'>
//        $(document).ready(function(){
//        $('#login').modal('show');
//        });
//        </script>";
//    }    
?>

<style>
    .inner-menu ul li.over-menu a
    {
        color: #f24d52;
        border-bottom-color:#f24d52
    }
</style>
<style>
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>


<div class="innerpage overview">
<!--    <div class="main-iiner-img">        
        <div class="banner-button">
            <a href="">View Photos</a>
        </div>
    </div>-->        
<!--    <div class="banner_contact">
        <img src="<?php echo base_url().$this->db->get_where('tour', array('id'=>$id))->row()->image_url; ?>" class="img-responsive" style="height:300px;">
    </div>-->

    <div class="container">
        <div class="inner-wrapper">
            <!-- left-->
            <div class="col-sm-8">
                <div class="inner-menu">
                    <ul>
                        <li class="over-menu" href="<?php echo site_url('user/overview/'.$id);?>"><a>Overview</a></li>
                        <!--<li><a href="<?php echo site_url('user/location/'.$id);?>">Location</a></li>-->
                        <!--<li><a href="<?php echo site_url('user/review/'.$id);?>">Reviews</a></li>-->
                        <!--<li><a href="<?php echo site_url('user/host/'.$id);?>">Tour Guide</a></li>-->
                    </ul>
                </div>
                <div class="head-over">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1> <?php echo $data->name; ?></h1>
                        </div>

                        <div class="clearfix"></div>

                    </div>
                </div>	
                <!--room-info-->
                <div class="room-info-over">
                    <div class="row">
                        <div class="col-sm-3">
                            <h3><i class="fa fa-users" aria-hidden="true"></i></h3>
                            <p>1 Guest</p>
                        </div>
                    </div>
                </div>
                <!--room-info-->
                                          
                <div class="row">                                       
                   <div>
                        <div class="w3-content w3-display-container">

                            <?php            
                                
                                $images  = $this->db->get_where('res_image', array('res_id'=>$id))->result_array();
                                foreach ($images as $row1): ?>
                                     <img class="mySlides img-responsive" src="<?php echo $row1['image'];?>" style="width:100%; height: 480px;" >                                        
                             <?php endforeach; ?>

                            <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                        </div>                                                         
                    </div>                  
                </div>
                                
                
      
                <div class="about-over" >
                    
                    <h3>Description</h3>
                    <p><?php echo $data->details; ?></p>

                    <h3>Summary</h3>
                    <p><?php echo $data->chd; ?></p>                                        

                    <h3>Phone</h3>
                    <p><?php echo $data->phone; ?></p>

                    <h3>Email</h3>
                    <p><?php echo $data->email; ?></p>
                                      
                </div>
                
                 <!-- pingyy-->
                <div class="pingyy">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="<?php echo base_url("assets_extra/img/piggy.png")?>" class="img-responsive"> 
                        </div>
                        <div class="col-sm-10">
                            <h3>100% refundable up to 48 hours before tour</h3>
                            <!--<p>Cancel up to 24 hours before your trip and get a full refund, including service fees.</p>-->
                        </div>
                    </div>
                </div>
                 
            </div>
            <!-- left-->
            <!-- right-->
            <div class="col-sm-4">				
                <?php 
                 //include ('../common/over-right.php')                
                 //echo site_url('user/overright');                    
                $this->load->view('rezdy/common/over-right_hotel'); 
                ?>                
            </div>
            <!-- right-->
        </div>
    </div>
</div>
<?php  $this->load->view('rezdy/common/footer');?>


<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";  
      }
      x[slideIndex-1].style.display = "block";  
    }
</script>


<script>
    $('document').ready(function () {
//        $(".show-ami-over").click(function () {
//            $(".overline").css("display", "block");
//            $(".show-ami-over").css("display", "none");
//        });
    });
</script>

