
<?php $data = $this->db->get_where('room', array('id'=>$id))->row(); ?>

<div class="over-right">
    <img src="<?php echo base_url($data->image_url);?>" class="img-responsive" style="width: 100%; height:220px; position: relative; display: block;margin-left: auto; margin-right: auto;" >
    <h1><i class="fa fa-bolt"></i> Price:  <?php echo "$".$data->price; ?> <small></small></h1>
    <div class="over-right-body">
        
        <?php echo form_open('user/payment/', array('class' => 'form-horizontal form-groups-bordered validate'));?>                                                                
        <div class="row nomargin">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> CheckIn Date </p>
                <input type="text" class="form-control" id="checkInDatePicker" name="date" required>
            </div>            
        </div>
        
        
        <div class="row nomargin">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> CheckOut Date </p>
                <input type="text" class="form-control" id="checkOutDatePicker" name="date" required>
            </div>            
        </div>
                
<!--        <div class="row nomargin" >
            <p class="nomargin">Time</p>    
            <div class="col-sm-12 nopadding">
                <select id="time" name="time" class="form-control time" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" >											                                
                </select>
            </div>
        </div>-->
                
        <div hidden="true">
            <input type="text" id="startDate" name="startDate" value="">
            <input type="text" id="endDate" name="endDate" value="">
        </div>
        
        <div class="row nomargin margintop10">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Guests</p>
                <input class="form-control guest" id="guest" type="number" min="0" name="guest" onkeyup="this.value = minmax(this.value, 1, 100)" required="true"/>
            </div>	
        </div>
                
        <div class="row nomargin margintop10 hidden">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Promo Code</p>
                <input class="form-control" type="text"  name="promocode" placeholder="optional" />
            </div>	
        </div>
        
      
        <div class="row nomargin margintop10" hidden="true">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Guests</p>
                <input class="form-control" type="text" name="tid" value="<?php echo $id; ?>" />
            </div>	
        </div>
        
        <?php if($data->auto_confirm == 1) {?>
            <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">Book</button>
        <?php } else { ?>
            <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">Request to Book</button>
        <?php } ?>       
        <?php echo form_close();?>
        
        <p class="text-center"><small>You won't be charged yet</small></p>
        <hr>
        <div class="row">
            <div class="col-sm-9">
<!--                <h4 style="margin-bottom:0px;">This is a rare find.</h4>
                <p>Bruce's place is usually booked.</p>-->
            </div>
           
        </div>						
    </div>					
</div>	

<div class="ri-ov-bo">
    <p><a href=""><i class="fa fa-flag-o"></i> Save this tour</a></p>
</div>

<script>
    $(document).ready(function () {                
              
        
        $(".guest" ).change(function() {
          var bla = $('#guest').val();            
          var time_id = $('select[name=time]').val()
          
          $.each(sessions,function(i,o){                 
                if(time_id == o.id){
                    maxCount = o.seatsAvailable;
                }                
          });
                    
          if(bla > maxCount){
              alert("Max Count " + maxCount);
          }
          if(bla < 0){
              alert("Input Correct Number");
          }
        });
        
        
        getAvailableDate();

    })
    
    
    
    
    var maxCount = 10;
    var date ;
    var sessions;
    var startDate;
    var endDate;
    function clickDate(check) { 
        date = check;
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/get_times'); ?>",
            dataType: 'json',
            data: {date: check, productCode: "<?php echo $data->product_code; ?>"},
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                
                    units = data.sessions; 
                    sessions = units;
                    $("#time").empty();
                    var toAppend = '';
                    $.each(units,function(i,o){          
                        start = o.startTimeLocal.split(" ");
                        end = o.endTimeLocal.split(" ");
                        toAppend += '<option value=' + o.id +'>'+ start[1] + '-' + end[1] +'</option>';
                        
                        if(i == 0){
                            startTimeLocal = o.startTime;
                            endTimeLocal = o.endTime;
                            
                        }
                        
                    });
                    $("#time").append(toAppend);
                    
                }
            }
        });
    }
              
    function getAvailableDate() {         
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/get_available_date'); ?>",
            dataType: 'json',
            
            data: {id: "<?php echo $id; ?>"},
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                                    
                    date = data.date;  
                    var nowDate = new Date();
                    if(date == 0){                       
                        today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                    }else{
                        //today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                        var nowDate = new Date(date);
                        today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                    }                
                    startDate = nowDate;
                    $('#checkInDatePicker').datepicker({
                                format: 'yyyy-mm-dd',
                                startDate: today                     
                    }); 
                    $('#checkInDatePicker').datepicker()
                        .on("input change", function (e) {                
                        //alert(e.target.value);
                        pickDate = e.target.value;
                        if(pickDate != ""){
                            //clickDate(pickDate);
                            document.getElementById('startDate').value = pickDate;
                            startDate = pickDate;
                            $('#checkInDatePicker').datepicker("hide");                                                        
                        }

                    });
                    
                    $('#checkOutDatePicker').datepicker({
                        format: 'yyyy-mm-dd',
                        startDate: today                             
                    });
                    
                    $('#checkOutDatePicker').datepicker()
                        .on("input change", function (e) {                
                        //alert(e.target.value);
                        pickDate = e.target.value;
                        if(pickDate != ""){                          
                           document.getElementById('endDate').value = pickDate;
                           endDate = pickDate;
                           if(endDate <= startDate){
                               alert("choose correct date");
                           }else{
                                $('#checkOutDatePicker').datepicker("hide");
                           }
                           
                        }
                    });                                               
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