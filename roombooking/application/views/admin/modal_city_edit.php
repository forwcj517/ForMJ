<?php
$edit_data = $this->db->get_where('city', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_city'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/manager_city/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name '); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" required data-validate="required" value="<?= $row['name']; ?>" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('logo'); ?></label>	
                        <div class=" col-sm-5">
                            <input type="file" name="userlogo" size="20"   />
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_city'); ?></button>
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