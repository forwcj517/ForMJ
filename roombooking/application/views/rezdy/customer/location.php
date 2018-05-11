<?php    
    $this->load->view('rezdy/common/header');                                                                                        
?>
<?php $data = $this->db->get_where('tour', array('id'=>$id))->row(); ?>
<style>
.inner-menu ul li.location-menu a
{
    color: #f24d52;
	border-bottom-color:#f24d52
}
</style>
<div class="innerpage overview">
<!--<div class="main-iiner-img">
	<div class="banner-button">
		<a href="">View Photos</a>
	</div>
</div>-->
    
    <!--<img src="<?php echo base_url($data->image_url);?>" class="img-responsive" style="height:300px; position: relative; display: block;margin-left: auto; margin-right: auto;" >-->
    
	<div class="container">
		<div class="inner-wrapper">
		<!-- left-->
			<div class="col-sm-8">
				<div class="inner-menu">
                                    <ul>                                            
                                        <li><a href="<?php echo site_url('user/overview/'.$id);?>">Overview</a></li>
                                        <li class="location-menu"><a href="<?php echo site_url('user/location/'.$id);?>">Location</a></li>
                                        <!--<li><a href="<?php echo site_url('user/review/'.$id);?>">Reviews</a></li>-->
                                        <!--<li><a href="<?php echo site_url('user/host/'.$id);?>">Tour Guide</a></li>-->
                                    </ul>
				</div>
				<div class="head-over">
					<div class="row">
						<div class="col-sm-12">
							<h3> <?php echo  $data->location;?> </h3>
							<p><?php echo  $data->name;?>'s home is located in <?php echo  $data->location;?></p>						
						</div>
						<div class="clearfix"></div>
					</div>
				</div>	
				
				<!-- Location-->                                
				<div class="location">
                                    <iframe src="https://www.google.com/maps/embed/v1/view?key=AIzaSyAdFzIWI5bmnwrOGMMpAF7TsMF_RhgBrbs&center=<?php echo $data->lat.",".$data->lon?>&zoom=18" style="border:0" width="100%" height="500" frameborder="0"></iframe>                                        
				</div>
				<!--Location-->
				
				
			</div>
		
                
			<div class="col-sm-4">
				 <?php $this->load->view('rezdy/common/over-right'); ?>			
			</div>
		<!-- right-->
		</div>
	</div>
</div>


<?php  $this->load->view('rezdy/common/footer');?>
<script>
$('document').ready(function(){
	$(".show-ami-over").click(function(){
		$(".overline").css("display", "block");
		$(".show-ami-over").css("display", "none");
	});
});
</script>