<?php
$edit_data = $this->db->get_where('faq', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_faq'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('admin/basic_faq/do_update/' . $row['id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select title'); ?></label>                                       
                        <div class="col-sm-5">
                            <select name="title_id">
                                <?php 
                                    $title_list = $this->db->get('faq_title')->result_array();
                                    foreach ($title_list as $title) {
                                        if ($title['id']==$row['title_id']){
                                            echo '<option selected="selected" value="'.$title['id'].'">'.$title['title'].'</option>';
                                        }else{
                                            echo '<option value="'.$title['id'].'">'.$title['title'].'</option>';
                                        }                                        
                                    }
                                ?>
                            </select>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('question'); ?></label>                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" required data-validate="required" value="<?= $row['question']; ?>" autofocus>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('answer'); ?></label>											
                        <div class="col-sm-5">
                            <textarea type = "text" class = "form-control" name="description" cols="40" rows="5"  required autofocus><?= $row['answer']; ?></textarea>
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_faq'); ?></button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
endforeach;
?>