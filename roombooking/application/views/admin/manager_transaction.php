<?php if ($this->session->userdata('admin_login') != 1) { ?>
    <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_city_add/"); ?>');" class="btn btn-primary pull-right">       
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('Add New Device'); ?>
    </a> 
<?php } ?>


<br><br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Transaction Id'); ?></div></th>
            <th><div><?php echo get_phrase('Amount'); ?></div></th>
            <th><div><?php echo get_phrase('Date'); ?></div></th>
            <th><div><?php echo get_phrase('Room Name'); ?></div></th> 
            <th><div><?php echo get_phrase('User Name'); ?></div></th> 
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
</thead>


<tbody>
    <?php
    if($this->session->userdata('admin_login') == 1){
        $hours = $this->db->get('transaction')->result_array();
    }else{
        $hours = $this->db->get('transaction')->result_array();
    }
    
    foreach ($hours as $row):
        ?>
        <tr>
            
            <td><?php echo $row['transaction_id']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['dt']; ?></td>
            <td><?php $data = $this->db->get_where('reservation', array('id'=>$row['reservation_id']))->row()->tour_id; echo $this->db->get_where('room', array('id'=>$data))->row()->name; ?></td>
            <td><?php $data = $this->db->get_where('reservation', array('id'=>$row['reservation_id']))->row()->user_id; echo $this->db->get_where('usertable', array('no'=>$data))->row()->name; ?></td>
            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- EDITING LINK -->
<!--                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_city_edit/".$row['id']); ?>');">
                                <i class="entypo-pencil"></i>
    <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>-->

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