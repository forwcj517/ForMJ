<?php    
    $this->load->view('rezdy/common/header');                                                                                        
?>
<?php $data = $this->db->get_where('tour', array('id'=>$id))->row(); ?>

<style>
    .inner-menu ul li.host-menu a
    {
        color: #f24d52;
        border-bottom-color:#f24d52
    }
</style>
<div class="innerpage overview">
    <div class="center" style="background:center">
        <!--<img src="<?php echo base_url($data->image_url);?>" class="img-responsive" style="height:300px; position: relative; display: block;margin-left: auto; margin-right: auto;" >-->
<!--        <div class="banner-button">
            <a href="">View Photos</a>
        </div>-->
    </div>
    <div class="container">
        <div class="inner-wrapper">
            <!-- left-->
            <div class="col-sm-8">
                <div class="inner-menu">
                    <ul>
                        <li><a href="<?php echo site_url('user/overview/'.$id);?>">Overview</a></li>                            
                        <li><a href="<?php echo site_url('user/location/'.$id);?>">Location</a></li>
                         <li><a href="<?php echo site_url('user/review/'.$id);?>">Reviews</a></li>
                        <li class="host-menu"><a href="<?php echo site_url('user/host/'.$id);?>">Tour Guide</a></li>                   
                    </ul>
                </div>
                
                <div class="head-over">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3>Hosted by <?php $user = $this->db->get_where('usertable', array('no' => $data->provider_id))->row(); echo $user->name."  ".$user->surname;?> </h3>
                            <p> <?php echo $user->email; ?> </p>
                            <p> <?php echo $data->location; ?> </p>                            
                            <div class="star-rating client-veri">
                                <a href="" class="cli-re-sp"><span>195</span> Reviews</a>
                                <a href="" class="cli-re-sp"><b><i class="fa fa-check-square-o"></i></b> Verified</a>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center">
                            <!--<a href=""><img src="<?php echo base_url('assets_extra/img/original.jpg');?>" class="img-circle img-responsive"></a>-->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>	

                <!-- about-over-->
                <div class="about-over margintop20" style="border:none;">
                    <p><?php echo $data->description; ?> </p>                    
                    <p><a href="" class="btn btn-warning waves-effect waves-light" style="color:#fff">Contact Tour Guider</a></p>
<!--, Français-->
                    <p>Languages: English<br> 
                        Response rate: <b>100%</b><br>
                        Response time: <b>within an hour</b></p>
                </div>
                <!-- about-over-->



            </div>
            <!-- left-->
            <!-- right-->
            <div class="col-sm-4">
               <?php $this->load->view('rezdy/common/over-right'); ?>
            </div>
            <!-- right-->
        </div>
    </div>
</div>

<?php  $this->load->view('rezdy/common/footer');?>

<script>
    $('document').ready(function () {
        $(".show-ami-over").click(function () {
            $(".overline").css("display", "block");
            $(".show-ami-over").css("display", "none");
        });
    });
</script>