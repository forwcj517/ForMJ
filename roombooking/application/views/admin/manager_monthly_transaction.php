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
            
            <th><div><?php echo get_phrase('Amount'); ?></div></th>
            <th><div><?php echo get_phrase('Date'); ?></div></th>           

        </tr>
</thead>

<tbody>
    <?php   
    foreach ($data as $row):
        ?>
        <tr>
            
            <td><?php echo $row['am']; ?></td>
            <td><?php echo $row['year']."-".$row['dt']; ?></td>                        
        </tr>
<?php endforeach; ?>
</tbody>
</table>