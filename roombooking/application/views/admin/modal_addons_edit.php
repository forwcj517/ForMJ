<?php
$edit_data = $this->db->get_where('addons', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_addons'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/basic_addons/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>

                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select tour'); ?></label>
                        <div class="col-sm-5">
                            <select id="tour_id" name="tour_id" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <?php
                                $tours = $this->db->get_where('tour', array('provider_id'=>$this->session->userdata('admin_id')))->result_array();
                                foreach ($tours as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" <?php if($row['tour_id'] == $row1['id']) { echo "selected";} ?> >
                                        <?php echo $row1['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>                        
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" required data-validate="required" value="<?= $row['name']; ?>" autofocus>
                            </div>
                        </div>
                        
                        
                        <div class="row" style="margin-top: 10px;">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>											
                            <div class="col-sm-5">
                                <input type = "number" class = "form-control" name="price" cols="40" rows="5"  value="<?= $row['price']; ?>" required autofocus/>
                            </div>    
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>											
                            <div class="col-sm-5">
                                <textarea type = "text" class = "form-control" name="description" cols="40" rows="5"  required autofocus><?= $row['description']; ?></textarea>
                            </div>                            
                        </div>   
                        
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('logo'); ?></label>	
                        <div class=" col-sm-5">
                            <input type="file" name="userlogo" size="20" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_addons'); ?></button>
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