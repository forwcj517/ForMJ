<div class="row" style = "height:100% ; overflow-y: scroll;">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('sell_device'); ?>
                </div>
            </div>
            <div class="panel-body">

<!--                <form action="<?php echo site_url('admin/manager_device/create'); ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data"/>-->
                <?php echo form_open_multipart('admin/manager_device_selled/sell', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>

                <br/>



                <div class="form-group" id="provider">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Client Name'); ?></label>                                        
                    <div class="col-sm-5">
                        <select id="client_id" name="client_id" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>
                                <?php
                                $semesters = $this->db->get_where('usertable', array('user_type'=>3, 'parentId' => $this->session->userdata('admin_id')))->result_array(); //array('company' => $this->session->userdata('admin_id'))
                                foreach ($semesters as $row1):
                                    ?>
                                    <option value="<?php echo $row1['no']; ?>" selected >
                                    <?php echo $row1['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>                
                </div>       
        

                <div class="form-group"  id="provider">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Device Name'); ?></label>                                        
                    <div class="col-sm-5">
                        <select id="device_id" name="device_id" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>
                                <?php
                                $semesters = $this->db->get_where('device', array('by_selled'=>0))->result_array(); //array('company' => $this->session->userdata('admin_id'))
                                foreach ($semesters as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" selected >
                                    <?php echo $row1['device_name']."(".$row1['device_id'].")"; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                
                </div>    





                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('sell_device'); ?></button>
                    </div>
                </div>

                </form>




            </div>
        </div>
    </div>
</div>

