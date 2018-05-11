<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_tour_category_add/".$id); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Add New Tour'); ?>
</a> 
<br><br>


<?php
//$hours =	$this->db->get_where('audiochannel', array('name'=>'ttt',))->result_array();
$hours = $this->db->get_where('tour', array('category_id' => $id))->result_array();
foreach ($hours as $row):
    ?>
    <div>
        <div class = "col-lg-2">
            <!-- Page Features -->
            <div class="row text-center">
                <div class=" hero-feature">
                    <div class="thumbnail">

                        <a href="" >
                            <div class = "thumbnail" style="height:100px;width:800px">
                                <img id="image1" src="<?php echo base_url() . $row['image_url']; ?>" style="width:100%; height:100%">
                            </div>


                        </a>
                        <div >
                            <h4>
                                 <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_tour_category_edit/".$row['id']."/".$id); ?>');"><?php echo $row['name']; ?></a> 
                            </h4>

                            <p>
                                 <a href="#" class="btn btn-primary" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_tour_category_edit/".$row['id']."/".$id); ?>');"><?php echo get_phrase('Edit'); ?></a> 

                                <a href="#" class = "btn btn-primary" onclick="confirm_modal('<?php echo site_url("admin/tour_category_list/delete/".$row['id']."/".$id); ?> ');">
    <?php echo get_phrase('Delete'); ?></a> 

                            </p>

                            <hr>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->

            <!-- /.container -->


        </div>



    </div>
<?php endforeach; ?>

