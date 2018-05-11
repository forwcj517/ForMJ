<!DOCTYPE html>
<?php    
    $this->load->view('rezdy/common/header');                                                                                        
?>

<?php 
    $data = $this->db->get_where('room', array('id'=>$id))->row(); 
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

            
    <div class="container">
        <div class="inner-wrapper">
            <!-- left-->
            <div class="col-sm-8">
                <div class="head-over">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1> <?php echo $data->name; ?></h1>
                           
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>	
                <!--room-info-->
          
                <!--room-info-->
                                          
                <div class="row">                                        
                        <div>
                           <div class="w3-content w3-display-container">
                               <img class="mySlides img-responsive" src="<?php echo base_url().$data->image_url;?>" style="width:100%; height: 480px;" >                                       
                               <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                               <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                           </div>                                                         
                       </div>                                                                                                 
                </div>
                                
                
      
                <div class="about-over" >
                    
                    <h3>Description</h3>
                    <p><?php echo $data->description; ?></p>


                    
                    <h3>Summary</h3>
                    <p><?php echo $data->summary; ?></p>   
                    
                    
                    <h3>Number of bed</h3>
                    <p><?php echo $data->no_of_bed; ?></p>

                    <h3>Capacity</h3>
                    <p><?php echo $data->capacity; ?></p>

                </div>
                
                 <!-- pingyy-->
                <div class="pingyy">
                    <div class="row">
                        <div class="col-sm-2">
                          
                        </div>
                        <div class="col-sm-10">
                            <h3>100% refundable up to noon </h3>
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
                 $this->load->view('rezdy/common/over-right'); 
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

