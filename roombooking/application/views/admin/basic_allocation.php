<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_allocation_add/".$id); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
<?php echo get_phrase('Allocate tour to guider'); ?>
</a> 

<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Tour Name'); ?></div></th>
            <th><div><?php echo get_phrase('Guider Name'); ?></div></th>
            <th><div><?php echo get_phrase('Guider Email'); ?></div></th>
            <th><div><?php echo get_phrase('Start Time'); ?></div></th>			
            <th><div><?php echo get_phrase('End Time'); ?></div></th>            
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
</thead>

<tbody>
    <?php
    
    $hours = $this->db->get_where('tour_guider', array('company' => $this->session->userdata('admin_id')))->result_array();
        
    foreach ($hours as $row):
        ?>
        <tr>
            <td><?php echo $this->db->get_where('tour', array('id' => $row['tour_id']))->row()->name; ?></td>
            <td><?php echo $this->db->get_where('usertable', array('no' => $row['guider_id']))->row()->name; ?></td>
            <td><?php echo $this->db->get_where('usertable', array('no' => $row['guider_id']))->row()->email; ?></td>
            <td><?php echo $row['start_time']; ?></td>
            <td><?php echo $row['end_time']; ?></td>
            
            
                                    
            
    <!--	<td><?php
            if ($row['audioLevel'] == 0) {
                echo "Vip";
            } else if ($row['audioLevel'] == 1) {
                echo "Super";
            } else if ($row['audioLevel'] == 2) {
                echo "Standard";
            } else if ($row['audioLevel'] == 3) {
                echo "Plus";
            } else if ($row['audioLevel'] == 4) {
                echo "Basic";
            } else if ($row['audioLevel'] == 5) {
                echo "Free";
            } else {
                echo "No setting";
            }
            ?></td>
            

            <td><?php
            if ($row['videoLevel'] == 0) {
                echo "Vip";
            } else if ($row['videoLevel'] == 1) {
                echo "Super";
            } else if ($row['videoLevel'] == 2) {
                echo "Standard";
            } else if ($row['videoLevel'] == 3) {
                echo "Plus";
            } else if ($row['videoLevel'] == 4) {
                echo "Basic";
            } else if ($row['videoLevel'] == 5) {
                echo "Free";
            } else {
                echo "No setting";
            }
            ?></td>-->

            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                        <!-- EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php/modal/popup/modal_allocation_edit/<?php echo $row['id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- DELETION LINK -->
                          <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url("admin/basic_allocation/delete/".$row['id']); ?>');">
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                        <?php  if($this->session->userdata("admin_login") != 3){?>
                       
                        <?php } ?>                       
                    </ul>
                </div>

            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>