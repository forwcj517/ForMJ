<?php 

$user = $this->db->get_where('usertable', array('no'=>$user_id))->row();
$tour = $this->db->get_where('tour', array('id'=>$tour_id))->row();
$reservation  = $this->db->get_where('reservation', array('id'=>$rsv_id))->row();
?>


<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker3.min.css'); ?>" />
<script src="<?php echo base_url('assets_extra/js/bootstrap-datepicker.min.js'); ?>"></script>


<div class="">    
    
    <h1><i class="fa fa-bolt"></i> Price: <label for="myalue" style="vertical-align: middle"></label><small></small></h1>
            
    <?php echo form_open('user/reschedule/'.$rsv_id , array('class' => 'form-horizontal form-groups-bordered validate'));?>
     
    <div class="col-md-6">    
        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-body">        
                                
                <div class="row">
                    <div class="col-sm-9">
                        <h3 style="margin-bottom:20px;">Input User Information.</h3>    
                    </div>                   
                </div>	
                
                <div class="form-group">
                    
                    <div class="row" >
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('First Name'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "fname" name="fname" value="<?php echo $user->name;?>"  disabled >
                        </div>
                    </div>   
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last Name'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "lname" name="lname" value="<?php echo $user->surname;?>" disabled >
                        </div>                                        
                    </div>
                    
                     
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Email'); ?></label>										
                        <div class="col-sm-5">
                            <input class="form-control email" id="email" type="email" name="email" value="<?php echo $user->email;?>" disabled />                            
                        </div>                                        
                    </div>                    
                    
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Phone Number'); ?></label>										
                        <div class="col-sm-5">
                            <input class="form-control phone" type="number" id="phone"  name="phone" value="<?php echo $user->phone;?>" disabled/>
                        </div>                                        
                    </div>  
                    
                    
                </div>
                                				
            </div>
            
        </div>     
    </div>
    
    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">        
                
                
                <div class="row">
                    <div class="col-sm-9">
                        <h3 style="margin-bottom:20px;">Make reservations.</h3>    
                    </div>
                   
                </div>	
                
                <div class="form-group">
                    
                    <div class="row" >
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Tour'); ?></label>										
                        <div class="col-sm-5">
                            <select id="tour_id" name="tid" class="form-control" required data-validate="required"  >											
                                <?php
                                $semesters = $this->db->get_where('tour', array('provider_id' => $this->session->userdata('admin_id')))->result_array();
                                foreach ($semesters as $row1):
                                    ?>
                                <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == $tour_id) { echo "selected";}?>  >
                                    <?php echo $row1['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                                    
                        </div>                                        
                    </div>
                                                            
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "datePicker" name="date" value="<?php echo $reservation->date;?>" required >
                        </div>
                    </div>   
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Time'); ?></label>										
                        <div class="col-sm-5">
                            <select id="time" name="time" class="form-control time" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" >
                                <option value="<?php echo $reservation->time;?>"><?php echo $reservation->time;?></option>
                            </select>   
                        </div>                                        
                    </div>                    
                     
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Guests'); ?></label>										
                        <div class="col-sm-5">
                            <input class="form-control guest" id="guest" type="number" name="guest" onkeyup="this.value = minmax(this.value, 1, 100)" value="<?php echo $reservation->ticket_count;?>" required/>                            
                        </div>                                        
                    </div>
                    
                    
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Promo Code'); ?></label>										
                        <div class="col-sm-5">
                            <input class="form-control" type="text"  name="promocode" placeholder="optional" value="<?php echo $reservation->p;?>" />
                        </div>                                        
                    </div>                   
                </div>
                
                                                
                <div class="row nomargin margintop10" hidden="true">
                    <div class="col-sm-12 nopadding">
                        <p class="nomargin"> Guests</p>
                        <input class="form-control" type="text" name="tour_id" value="<?php echo $id; ?>" />
                    </div>	
                </div>
                                
                <div class="form-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">Reschedule</button>  
                        
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                

                

                <p class="text-center"><small>You won't be charged yet</small></p>
                <hr>
                <div class="row">
                    <div class="col-sm-9">
                        <h4 style="margin-bottom:0px;">This is a rare find.</h4>
                        <p>Bruce's place is usually booked.</p>
                    </div>
<!--                    <div class="col-sm-3">
                        <i class="fa fa-diamond fa-3x" aria-hidden="true"></i>
                    </div>-->
                </div>						
            </div>
        </div>
        
     </div>   
     
     
     <?php echo form_close();?>
</div>


 
<script>
    $(document).ready(function () {
        $('#datePicker').datepicker({
                    format: 'yyyy-mm-dd'
                })          
        $('#datePicker').datepicker()
            .on("input change", function (e) {                
            //alert(e.target.value);
            date = e.target.value;
            if(date != ""){
                clickDate();
            }            
        });
        
        $(".email" ).change(function() {          
            email = $('#email').val();         
            phone = $('#phone').val();            
            if(phone != null && phone != ""){
                checkUser();
            }            
        });
        
        $(".phone" ).change(function() {          
            email = $('#email').val();         
            phone = $('#phone').val();           
            if(email != null && email != ""){
                checkUser();
            }
        });
        
        $('.time').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            getPeopleCount(valueSelected);            
        });
        
        $('#tour_id').change(function() {
            var val = $("#tour_id option:selected").text();
            var value = $("#tour_id option:selected").val();       
            tour_id = value;
            
            if(date != null && date != ""){
                clickDate();
            }
        });  
          
        tour_id = $( "#tour_id option:selected" ).val();
        date = $('#datePicker').val();

    })    
            
    var maxCount = 10;
    var date ;
    var tour_id;
    var email;
    var phone;
    
    
    function clickDate() {        
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/get_times'); ?>",
            dataType: 'json',
            data: {date: date, id: tour_id},
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                    
                    units = data.times;   
                    var price = data.price;
                    jQuery("label[for='myalue']").html(price + "$");
                    
                    maxCount = data.count;                    
                    $("#time").empty();
                    var toAppend = '';
                    $.each(units,function(i,o){                
                        toAppend += '<option value=' + o.start_time +'>'+ o.start_time +'</option>';                               
                    });
                    $("#time").append(toAppend);                    
                }
            }
        });
    }
        
    
    function checkUser() {        
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/checkUser'); ?>",
            dataType: 'json',
            data: {email: email, phone: phone},
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                    
                    units = data.result;   
                    if(units != 1){
                        alert("You should input correct user info or register new user.");
                    }
                                 
                }
            }
        });
    }
    
    
    
    function getPeopleCount(time) { 
        
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/get_people_count'); ?>",
            dataType: 'json',
            data: {date: date, id: "<?php echo $id; ?>", time: time },
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                                        
                    maxCount = data.count;                                                  
                }
            }
        });
    }
    
    
    function minmax(value, min, max) 
    {
        max = maxCount;
        if(parseInt(value) < min || isNaN(parseInt(value))) 
            return 1; 
        else if(parseInt(value) > max) 
            return max; 
        else return value;
    }
    
</script>