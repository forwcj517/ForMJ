<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_faq_title_add"); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Add New faq title'); ?>
</a> 

<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Title'); ?></div></th>
            <th><div><?php echo get_phrase('Option'); ?></div></th>          
        </tr>
    </thead>
    <tbody>
        <?php
        
        if($this->session->userdata('admin_login') == 1){
            $hours = $this->db->get('faq_title')->result_array();
        }else{
            $hours = $this->db->get('faq_title')->result_array();
        }        
        $title_list = $hours;

        foreach ($hours as $row):
            ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- EDITING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_faq_title_edit/".$row['id']); ?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo site_url("admin/basic_faq_title/delete/".$row['id']); ?>');">
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
<a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_faq_add"); ?>');" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('Add New faq'); ?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Title'); ?></div></th>
            <th><div><?php echo get_phrase('Question'); ?></div></th>
            <th><div><?php echo get_phrase('Answer'); ?></div></th>
            <th><div><?php echo get_phrase('Create Date'); ?></div></th>
            <th><div><?php echo get_phrase('Option'); ?></div></th>          
        </tr>
    </thead>
    <tbody>
        <?php
        
        if($this->session->userdata('admin_login') == 1){
            $hours = $this->db->get('faq')->result_array();
        }else{
            $hours = $this->db->get('faq')->result_array();
        }        

        foreach ($hours as $row):
            ?>
            <tr>
                <td>
                    <?php 
                        foreach ($title_list as $title) {
                            if ($title['id']==$row['title_id']){
                                echo $title['title'];
                            }
                        }
                    ?></td>
                <td><?php echo $row['question']; ?></td>
                <td><?php $str = $row['answer'];  if(strlen($str) > 220) {echo substr($str,0,220)."[...]";}else {echo $str;} ?></td>
                <td><?php echo $row['dt']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- EDITING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo site_url("modal/popup/modal_faq_edit/".$row['id']); ?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo site_url("admin/basic_faq/delete/".$row['id']); ?>');">
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