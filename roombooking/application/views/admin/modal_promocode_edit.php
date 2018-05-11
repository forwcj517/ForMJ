<?php
$edit_data = $this->db->get_where('groupon', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_promo_code'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/basic_promocode/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate')); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" required data-validate="required" value="<?= $row['title']; ?>" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="price" required data-validate="required" value="<?= $row['price']; ?>" autofocus>
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount'); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="discount" required data-validate="required" value="<?= $row['discount']; ?>" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_promo_code'); ?></button>
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