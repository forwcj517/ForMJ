<?php
$edit_data = $this->db->get_where('room', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row" style = "height:100% ; overflow-y: scroll;">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_city'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/manager_room/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name '); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" required data-validate="required" value="<?= $row['name']; ?>" autofocus>
                        </div>
                    </div>
                   

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('logo'); ?></label>	
                        <div class=" col-sm-5">
                            <input type="file" name="userlogo" size="20"  />
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>							
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id = "description" name="description" value="" required autofocus ><?= $row['description']; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('summary'); ?></label>							
                        <div class="col-sm-5">
                            <textarea type="text" class="form-control" id = "summary" name="summary" value="" required autofocus ><?= $row['summary']; ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select city'); ?></label>
                        <div class="col-sm-5">
                            <select id="city_id" name="city_id" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <?php
                                $tours = $this->db->get_where('city', array('company'=>0))->result_array();
                                foreach ($tours as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>"  <?php  if( $row1['id'] == $row['id']) { echo "selected";} ?>>
                                        <?php echo $row1['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select room type'); ?></label>
                        <div class="col-sm-5">
                            <select id="room_type" name="room_type" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <?php
                                $tours = $this->db->get_where('room_type')->result_array();
                                foreach ($tours as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == $row['id']) { echo "selected";}?> >
                                        <?php echo $row1['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>							
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id = "price" name="price" value="<?= $row['price']; ?>" required autofocus >
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('number of bed'); ?></label>							
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id = "no_of_bed" name="no_of_bed" value="<?= $row['no_of_bed']; ?>" required autofocus >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('capacity'); ?></label>							
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id = "capacity" name="capacity" value="<?= $row['capacity']; ?>" required autofocus >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_room'); ?></button>
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