
<br><br>
<table class="table table-bordered datatable" id="table_export">
<thead>
        <tr>
            <th><div><?php echo get_phrase('Tour Name'); ?></div></th>
            <th><div><?php echo get_phrase('Location'); ?></div></th>
            <th><div><?php echo get_phrase('City'); ?></div></th>
            <th><div><?php echo get_phrase('Category'); ?></div></th>			
            <th><div><?php echo get_phrase('Price'); ?></div></th>            
            <th><div><?php echo get_phrase('Auto Confirm'); ?></div></th> 
            <th><div><?php echo get_phrase('Max Count'); ?></div></th> 
<!--            <th><div><?php echo get_phrase('options'); ?></div></th>-->
        </tr>
</thead>


<tbody>
    <?php    
       
    foreach ($hours as $row):
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $this->db->get_where('city', array('id' => $row['city_id']))->row()->name; ?></td>
            <td><?php echo $this->db->get_where('category', array('id' => $row['category_id']))->row()->name; ?></td>
            <td><?php echo $row['price']; ?></td>                                                                        
            <td><?php
            if ($row['auto_confirm'] == 0) {
                echo "Disabled";
            } else if ($row['auto_confirm'] == 1) {
                echo "Enabled";
            } 
            ?></td>
             <td><?php echo $row['max_count']; ?></td> 
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

<!--            <td>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                         EDITING LINK 
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php/modal/popup/modal_allocation_edit/<?php echo $row['id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                         DELETION LINK 
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

            </td>-->
        </tr>
    <?php endforeach; ?>
</tbody>
</table>