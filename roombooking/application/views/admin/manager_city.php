<?php if ($this->session->userdata('admin_login') == 1) { ?>
    <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_city_add/"); ?>');" class="btn btn-primary pull-right">       
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
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
</thead>


<tbody>
    <?php
    if($this->session->userdata('admin_login') == 1){
        $hours = $this->db->get('city')->result_array();
    }else{
        $hours = $this->db->get_where('city', array('company' => $this->session->userdata('admin_id')))->result_array();
    }
    
    foreach ($hours as $row):
        ?>
        <tr>
            <td> <img src="<?php if(strpos($row['image'],'http') == true){ echo $row['image']; }else{  echo  base_url().$row['image']; }; ?>" style="width: 130px; height: 90px;"/></td>
            <td><?php echo $row['name']; ?></td>

            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_city_edit/".$row['id']); ?>');">
                                <i class="entypo-pencil"></i>
    <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url("admin/manager_city/delete/".$row['id']); ?>');">
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