<!--<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_helper_add/<?php echo $id;?>');" class="btn btn-primary pull-right">
	<i class="entypo-plus-circled"></i>
	<?php echo get_phrase('Add New Helper');?>
</a> -->
<br><br>	
<table class="table table-bordered datatable" id="table_export">
	<thead>
            <tr>
                <th><div><?php echo get_phrase('Personal No');?></div></th>
                <th><div><?php echo get_phrase('First Name');?></div></th>
                <th><div><?php echo get_phrase('Last Name');?></div></th>
                <th><div><?php echo get_phrase('Email');?></div></th>
                <th><div><?php echo get_phrase('Phone');?></div></th>
<!-- 			<th><div><?php echo get_phrase('Country');?></div></th>		
                     -->			<th><div><?php echo get_phrase('options');?></div></th>
            </tr>
	</thead>
        
	<tbody>
		<?php                 



        if($this->session->userdata('admin_login') == 1){
            $hours =	$this->db->get_where('usertable', array('user_type' => 2))->result_array();
        }else if($this->session->userdata('admin_login') == 2){                    	
            $hours =	$this->db->get_where('usertable', array('user_type' => 3, 'parentId' => $this->session->userdata('admin_id')))->result_array();
        }else if($this->session->userdata('admin_login') == 3){
        	$hours =	$this->db->get_where('usertable', array('user_type' => 3, 'no' => $this->session->userdata('admin_id')))->result_array();
        }

		foreach($hours as $row):?>
		<tr>
			<td><?php echo $row['no'];?></td>
			<td><?php echo $row['name'];?></td>
                        <td><?php echo $row['surname'];?></td>
			<td><?php echo $row['email'];?></td>					
			<td><?php echo $row['phone'];?></td>

			<td>				
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						Action <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-default pull-right" role="menu">
						
						<!-- EDITING LINK -->
			
<!--                                                
                                                <li>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php/modal/popup/modal_customer_edit/<?php echo $row['no']; ?>');">
                                                        <i class="entypo-pencil"></i>
                                                        <?php echo get_phrase('edit'); ?>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>-->
                        
                        
						<!-- DELETION LINK -->
						<li>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/manager_customer/delete/<?php echo $row['no'];?>');">
								<i class="entypo-trash"></i>
									<?php echo get_phrase('delete');?>
								</a>
						</li>
					</ul>
				</div>
				
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>