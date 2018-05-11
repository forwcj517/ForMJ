<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_timeschedule_add/".$id); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
<?php echo get_phrase('Add Time Schedule'); ?>
</a> 

<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Tour Name'); ?></div></th>
            <th><div><?php echo get_phrase('Start Time'); ?></div></th>			
            <th><div><?php echo get_phrase('End Time'); ?></div></th>  
            <th><div><?php echo get_phrase('Week Of Day'); ?></div></th>  
            <th><div><?php echo get_phrase('options'); ?></div></th>
        </tr>
</thead>


<tbody>
    <?php    
    $hours = $this->db->get_where('time_schedule', array('company' => $this->session->userdata('admin_id')))->result_array();        
    foreach ($hours as $row):
        ?>
        <tr>
            <td><?php echo $this->db->get_where('tour', array('id' => $row['tour_id']))->row()->name; ?></td>
            <td><?php echo $row['start_time']; ?></td>
            <td><?php echo $row['end_time']; ?></td>                                                                        
            <td><?php
            if ($row['weekofday'] == 0) {
                echo "Sunday";
            } else if ($row['weekofday'] == 1) {
                echo "Monday";
            } else if ($row['weekofday'] == 2) {
                echo "Tuesday";
            } else if ($row['weekofday'] == 3) {
                echo "Wednesday";
            } else if ($row['weekofday'] == 4) {
                echo "Thursday";
            } else if ($row['weekofday'] == 5) {
                echo "Friday";
            } else {
                echo "Saturday";
            }
            ?></td>            
 <!--
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
                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php/modal/popup/modal_timeschedule_edit/<?php echo $row['id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- DELETION LINK -->
                          <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url("admin/basic_time_schedule/delete/".$row['id']); ?>');">
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