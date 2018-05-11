<!--<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_audio_add"); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Add New Audio Album'); ?>
</a> -->
<br><br>


<?php
$hours = $this->db->get_where('category', array('company'=>$this->session->userdata('admin_id')))->result_array();
foreach ($hours as $row):
    ?>
    <div>
        <div class = "col-lg-3">
            <!-- Page Features -->
            <div class="row text-center">
                <div class=" hero-feature">
                    <div class="thumbnail">

                        <a href="<?php echo site_url("admin/tour_category_list/". $row['id']); ?>" >
                            <div class = "thumbnail" style="height:150px;width:800px">
                                <img id="image1" src="<?php echo base_url() . $row['image']; ?>" style="width:100%; height:100%">
                            </div>
                        </a>

                        <div style = "height:115px;">
                            <h3>												
                                <a href="#"  onclick=""><?php echo $row['name']; ?></a> 												
                            </h3>
                            <p>
                                <a href="<?php echo site_url("admin/tour_category_list/". $row['id']); ?>" class="btn btn-primary"> <?php echo get_phrase('Edit'); ?></a> 

                                <a href="#" class = "btn btn-primary" onclick="confirm_modal('<?php echo base_url(); ?>index.php/admin/tour_category/delete/<?php echo $row['id']; ?>');">
    <?php echo get_phrase('Delete'); ?></a> 

                            </p>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->


            <!-- /.container -->


        </div>

    </div>
<?php endforeach; ?>

