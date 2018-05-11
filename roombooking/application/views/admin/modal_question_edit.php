<?php
$edit_data = $this->db->get_where('question', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_customer_type'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/basic_question/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate')); ?>

                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select tours'); ?></label>
                        <div class="col-sm-6">
                            <select id="tour_id" name="tour_id" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <?php
                                $semesters = $this->db->get_where('tour', array('provider_id'=>$this->session->userdata('admin_id')))->result_array(); //array('company' => $this->session->userdata('admin_id'))
                                foreach ($semesters as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" selected >
                                    <?php echo $row1['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Question'); ?></label>										
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id = "title" name="title" value="<?= $row['title']; ?>" required autofocus >
                        </div>
                    </div>
                    
                    


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_question'); ?></button>
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