
<!--<row>
<?php echo form_open_multipart('admin/import', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>            
    
    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/delete_user');"  class="btn btn-primary">
        <i class=""></i>
<?php echo get_phrase(' Delete User Data'); ?>
    </a> 


    <a href="<?php echo base_url(); ?>index.php?admin/get_report"  class="btn btn-primary">
        <i class=""></i>
<?php echo get_phrase(' Export User Data'); ?>
    </a> 

    <a href="#"  class="btn">	
        <input type="file" class="inline" name="userfile" id="userfile"  size="10" />
    </a> 
    <button type="submit" class="btn btn-info"><?php echo get_phrase('Import User Data'); ?></button>
</form>


<?php if ($this->session->userdata('admin_login') != 2) { ?>






        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_harvester_add/<?php echo $id; ?>');" class="btn btn-primary pull-right">
            <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Add New Harvester'); ?>
        </a> 
<?php
} else {
    
}
?>
</row>-->



<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('User Name'); ?></div></th>
<th><div><?php echo get_phrase('User Email'); ?></div></th>
<th><div><?php echo get_phrase('Android Id'); ?></div></th>
<th><div><?php echo get_phrase('Address'); ?></div></th>
<th><div><?php echo get_phrase('Create Date'); ?></div></th>
<th><div><?php echo get_phrase('Country'); ?></div></th>		
<th><div><?php echo get_phrase('options'); ?></div></th>
</tr>
</thead>

<tbody>
    <?php
    if ($this->session->userdata('admin_login') == 1) {
        $hours = $this->db->get_where('usertable', array('user_type' => 2))->result_array();
    } else {
        $hours = $this->db->get_where('usertable', array('user_type' => 1, 'company' => $this->session->userdata('admin_id')))->result_array();
    }


    foreach ($hours as $row):
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['androidid']; ?></td>			
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['create_date']; ?></td>
            <td><?php echo $row['country']; ?></td>


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
                            <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_harvester_edit/".$row['no']); ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url("admin/manager_provider/delete/".$row['no']); ?>');">
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

