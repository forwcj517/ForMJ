

<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Name'); ?></div></th>
            <th><div><?php echo get_phrase('Email'); ?></div></th>
            <th><div><?php echo get_phrase('Title'); ?></div></th>
            <th><div><?php echo get_phrase('Message'); ?></div></th>
            <th><div><?php echo get_phrase('Option'); ?></div></th>          
        </tr>
    </thead>
    <tbody>
        <?php
                
        $hours = $this->db->get_where('contact_us', array('checked' => 0))->result_array();
        
        foreach ($hours as $row):
            ?>
            <tr>                
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['message']; ?></td>
                
                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- EDITING LINK -->
<!--                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_category_edit/".$row['id']); ?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>-->

                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo site_url("admin/contact_message/delete/".$row['id']); ?>');">
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