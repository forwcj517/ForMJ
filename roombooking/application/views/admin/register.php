<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$text_align = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$account_type = $this->session->userdata('login_type');
?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl'; ?>">
    <head>

        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Arab Open university Tutors Management System" />
        <meta name="author" content="korcstar"/>

        

        <script>
            function check_email(param)
            {
                var myregexp = new RegExp('^[A-Za-z0-9+_.-]+@(?:[A-Za-z0-9-]+\\.)+[A-Za-z]{2,6}\\b');
                if (!myregexp.test(param))
                    return false;
                else
                    return true;
            }
            var base_url = '<?php echo base_url(); ?>';
        </script>
    </head>


    <body class="" >
        <div class="" >

            <div class="row" style = "margin-top: 100px; margin-bottom: 100px;">
                <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;" style = "margin-top :100px;">
                    <h1 style="font-weight:200; margin:0px;"><?php echo $system_name; ?></h2>
                        <h3 style="font-weight:200; margin:0px;"><?php echo "Register"; ?></h2>
                            </div>
                            </div>

                            <div class="row" style = "height:100%;">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="panel panel-primary" data-collapsed="0">
                                        
                                        <div class="panel-heading">
                                            <div class="panel-title" >
                                                <i class="entypo-plus-circled"></i>
                                                <?php echo get_phrase('register'); ?>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="panel-body">

                                            <?php echo form_open_multipart('login/register_new/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('First Name'); ?></label>										
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id = "name" name="name" value="" required autofocus >
                                                </div>
                                            </div>
                                                  
                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last Name'); ?></label>                                       
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id = "surname" name="surname" value="" required autofocus >
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>										
                                                <div class="col-sm-5">
                                                    <input type="email" class="form-control" id = "email" name="email" value="" required autofocus >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>                                      
                                                <div class="col-sm-5">
                                                    <input type="phone" class="form-control" id = "phone" name="phone" value="" required autofocus >
                                                </div>
                                            </div>

                                            
                                            
                                             <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>										
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id = "address" name="address" value="" required autofocus >
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password'); ?></label>										
                                                <div class="col-sm-5">
                                                    <input type="password" class="form-control" id = "password" name="password" value="" required autofocus >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('User Type'); ?></label>
                                                <div class="col-sm-5">
                                                    <select id="user_type" name="user_type" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											                                                                
                                                        <option value="2" selected > Sale Man </option>                                                                    
                                                        <option value="3" > Local Business(Client) </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" hidden="true" id="provider">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Provider Id'); ?></label>										
                                                <div class="col-sm-5">
                                                    <select id="saleman_no" name="saleman_no" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>
                                                            <?php
                                                            $semesters = $this->db->get_where('usertable', array('user_type'=>2))->result_array(); //array('company' => $this->session->userdata('admin_id'))
                                                            foreach ($semesters as $row1):
                                                                ?>
                                                                <option value="<?php echo $row1['no']; ?>" selected >
                                                                <?php echo $row1['name']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            
                                            </div>                                            

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-5">
                                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('add_user'); ?></button>
                                                </div>
                                            </div>																									
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>	

                            </div>


     

                            </body>
                            </html>

                                                        
<script>
$('#user_type').change(function() {    
        var provider = document.getElementById('provider');
        if ($(this).val() === '2') {
            // Do something for option "b"
            provider.style.display = 'none'; 
        }else if($(this).val() === '3'){
            provider.style.display = 'block';
        }
});
</script>


