<?php 
$edit_data		=	$this->db->get_where('usertable' , array('no' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_provider');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/manager_provider/do_update/'.$row['no'] , array('class' => 'form-horizontal form-groups-bordered validate'));?>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user name');?></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" required data-validate="required" value="<?=$row['name'];?>" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('personalNo');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="personalNo" required data-validate="required" value="<?=$row['personalNo'];?>" autofocus>
						</div>
					</div>
                    

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" required data-validate="required" value="<?=$row['email'];?>" autofocus>
						</div>
					</div>
                    

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="<?=$row['address'];?>" >
						</div>
					</div>


					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('code');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="code" value="<?=$row['code'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('city');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="city" value="<?=$row['city'];?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('country');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="country" value="<?=$row['country'];?>" >
						</div>
					</div>
				

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_provider');?></button>
						</div>
					</div>

                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php
endforeach;
?>