<?php if ($this->session->userdata('admin_login') == 1) { ?>
    <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_room_add/"); ?>');" class="btn btn-primary pull-right">       
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('Add New City'); ?>
    </a> 
<?php } ?>


<br><br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Photo'); ?></div></th>
            <th><div><?php echo get_phrase('Name'); ?></div></th>
            <th><div><?php echo get_phrase('No of bed'); ?></div></th>
            <th><div><?php echo get_phrase('Capacity'); ?></div></th>
            <th><div><?php echo get_phrase('Price'); ?></div></th>
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
</thead>


<tbody>
    <?php
    if($this->session->userdata('admin_login') == 1){
        $hours = $this->db->get('room')->result_array();
    }else{
        $hours = $this->db->get('room')->result_array();
    }    
    foreach ($hours as $row):
        ?>
        <tr>
            <td> <img src="<?php if( strpos($row['image_url'],'http') == true){ echo  base_url().$row['image_url']; }else{  echo  base_url().$row['image_url']; }; ?>" style="width: 130px; height: 90px;"/></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['no_of_bed']; ?></td>
            <td><?php echo $row['capacity']; ?></td>
            <td><?php echo $row['price']; ?></td>            
            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_room_edit/".$row['id']); ?>');">
                                <i class="entypo-pencil"></i>
    <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url("admin/manager_room/delete/".$row['id']); ?>');">
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