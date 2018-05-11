<?php
$edit_data = $this->db->get_where('faq_title', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit faq title'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/basic_faq_title/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>
                    
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>											
                        <div class="col-sm-5">
                            <textarea type = "text" class = "form-control" name="description" cols="40" rows="5"  required autofocus><?= $row['title']; ?></textarea>
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_faq_title'); ?></button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
endforeach;
?>