<?php if ($this->session->userdata('admin_login') != 1) { ?>
    <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_sell/"); ?>');" class="btn btn-primary pull-right">       
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('Sell Device'); ?>
    </a> 
<?php } ?>


<br><br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Photo'); ?></div></th>
            <th><div><?php echo get_phrase('Device Id'); ?></div></th>
            <th><div><?php echo get_phrase('Device Name'); ?></div></th>
            <th><div><?php echo get_phrase('Url'); ?></div></th>
            <th><div><?php echo get_phrase('Status'); ?></div></th>
             <th><div><?php echo get_phrase('Client Name'); ?></div></th>
             <th><div><?php echo get_phrase('Edit Status'); ?></div></th>
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
</thead>


<tbody>
    <?php
    if($this->session->userdata('admin_login') == 1){
        $hours = $this->db->get('device', array('by_selled != '=>0))->result_array();
    }else{
        $hours = $this->db->get_where('device', array('by_selled != '=>0, 'owner_id' => $this->session->userdata('admin_id')))->result_array();
    }
    
    foreach ($hours as $row):
        ?>
        <tr>
            <td> <img src="<?php if (strpos($row['image'], 'http') !== false) { echo $row['image']; } else { echo base_url().$row['image'];} ?>" style="width: 50px; height: 50px;"/></td>
            <td><?php echo $row['device_id']; ?></td>
            <td><?php echo $row['device_name']; ?></td>
            <td><?php echo $row['url']; ?></td>
            <td><?php 
            if($row['by_selled'] == 0){
                echo "Not sell";
            }else{
                echo "Selled";
            }
            ?></td>
            <td><?php 
            $userData = $this->db->get_where('usertable', array('no'=>$row['by_selled']))->row();
            echo $userData->name; 
            ?></td>

             <td><?php 
            if($row['edit_allow'] == 0){
                echo "Non-Editable";
            }else{
                echo "Editable";
            }
            ?></td>

            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                            
                        <li>
                            <a href="<?php echo base_url("admin/manager_device_selled/do_update/".$row['id']."/".$row['edit_allow']); ?>" onclick="">
                                <i class="entypo-pencil"></i>
                            <?php  if($row['edit_allow'] == '0') { echo "Allow";} else { echo "Disallow";} ; ?>
                            </a>
                        </li>                       
                       <!--
 <li class="divider"></li>
  

                       
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url("admin/manager_city/delete/".$row['id']); ?>');">
                                <i class="entypo-trash"></i>
    <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                        -->


                    </ul>
                </div>

            </td>
        </tr>
<?php endforeach; ?>
</tbody>
</table>