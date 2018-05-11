<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_category_add".$id); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Add New Category'); ?>
</a> 


<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Photo'); ?></div></th>
            <th><div><?php echo get_phrase('Name'); ?></div></th>
            <th><div><?php echo get_phrase('Create Date'); ?></div></th>
            <th><div><?php echo get_phrase('Option'); ?></div></th>          
        </tr>
    </thead>
    <tbody>
        <?php
        
        if($this->session->userdata('admin_login') == 1){
            $hours = $this->db->get('category')->result_array();
        }else{
            $hours = $this->db->get_where('category', array('company' => $this->session->userdata('admin_id')))->result_array();
        }
        

        foreach ($hours as $row):
            ?>
            <tr>
                <td> <img src="<?php echo base_url().$row['image']; ?>" style="width: 130px; height: 90px;"/></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['dt']; ?></td>


                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- EDITING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_category_edit/".$row['id']); ?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>

                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo site_url("admin/manager_category/delete/".$row['id']); ?>');">
                                    <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>