<?php
$edit_data = $this->db->get_where('usertable', array('no' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_foreman'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/manager_guider/do_update/' . $row['no'], array('class' => 'form-horizontal form-groups-bordered validate')); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user name'); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" required data-validate="required" value="<?= $row['name']; ?>" autofocus>
                        </div>
                    </div>
              

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('sex'); ?></label>
                        <div class="col-sm-5">

                            <select id="sex" name="sex" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>
                                <option value="0" <?php if ($row['sex'] == 0) echo 'selected'; ?> > Male </option>
                                <option value="1"  <?php if ($row['sex'] == 1) echo 'selected'; ?> > Female </option>

                            </select>
                        </div>
                    </div>




             

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="email" required data-validate="required" value="<?= $row['email']; ?>" autofocus>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="address" value="<?= $row['address']; ?>" >
                        </div>
                    </div>


               

<!--
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('active'); ?></label>
                        <div class="col-sm-5">

                            <select id="agree" name="agree" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>
                                <option value="0" <?php if ($row['agree'] == 0) echo 'selected'; ?> > Deactive </option>
                                <option value="1"  <?php if ($row['agree'] == 1) echo 'selected'; ?> > Active </option>
                            </select>
                        </div>
                    </div>-->
                    
                    

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_guider'); ?></button>
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


<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker3.min.css'); ?>" />
<script src="<?php echo base_url('assets_extra/js/bootstrap-datepicker.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('#start_date').datepicker({
                    format: 'yyyy-mm-dd'
                })
        $('#start_date').datepicker('setDate', new Date());                        
        $('#end_date').datepicker({
                    format: 'yyyy-mm-dd'
                })
        $('#end_date').datepicker('setDate', new Date());                        
    })
</script>
