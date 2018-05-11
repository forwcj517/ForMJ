
<?php 
$data = $this->db->get_where('restaurant', array('id'=>$id))->row();
$hotel_image = $this->db->get_where('res_image', array('res_id'=>$id))->row();   ?>

<div class="over-right">
    <img src="<?php echo $hotel_image->image;?>" class="img-responsive" style="width: 100%; height:220px; position: relative; display: block;margin-left: auto; margin-right: auto;" >
    <h1><i class="fa fa-bolt"></i> <small></small></h1>
    <div class="over-right-body">
        
        <?php echo form_open('user/payment_hotel/', array('class' => 'form-horizontal form-groups-bordered validate'));?>
        <div class="row nomargin">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Start Date </p>
                <input type="text" class="form-control" id="startDatePicker" name="start_date" required>
            </div>            
        </div>        
        
        <div class="row nomargin">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> End Date </p>
                <input type="text" class="form-control" id="endDatePicker" name="end_date" required>
            </div>            
        </div>
        
                         
        <div class="row nomargin margintop10">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Adult </p>
                <input class="form-control" type="number" id="adult" name="adult" placeholder="optional" value="0" />
            </div>	
        </div>
        
        <div class="row nomargin margintop10">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Children </p>
                <input class="form-control" type="number" id="child" name="child" placeholder="optional" value="0"/>
            </div>	
        </div>                
                
        
        <div hidden="true">
            <input type="text" id="res_id" name="res_id" value="<?php echo $data->id; ?>">
            <input type="text" id="supplier_code" name="supplier_code" value="<?php echo $data->supplier_code; ?>">
            <input type="text" id="endDate" name="endDate" value="">
        </div>

                
        <div class="row nomargin margintop10" hidden="true">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Promo Code</p>
                <input class="form-control" type="text" id="coupon" name="coupon" placeholder="optional" />
            </div>	
        </div>
                            
        <div class="row nomargin margintop10" hidden="true">
            <div class="col-sm-12 nopadding">
                <p class="nomargin"> Guests</p>
                <input class="form-control" type="text" name="tid" value="<?php echo $id; ?>" />
            </div>	
        </div>
        
        
        <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">Book</button>
        
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
            var nowDate = new Date();
            var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
            //format: 'yyyy-mm-dd',
            $('#startDatePicker').datepicker({
                        format: 'yyyy-mm-dd',
                        startDate: today                     
            });      

            $('#startDatePicker').datepicker()
                .on("input change", function (e) {                
                //alert(e.target.value);
                pickDate = e.target.value;
                if(pickDate != ""){                    
                    $('#startDatePicker').datepicker("hide");
                }
            });
                    


            $('#endDatePicker').datepicker({
                        format: 'yyyy-mm-dd',
                        startDate: today                     
            });      

            $('#endDatePicker').datepicker()
                .on("input change", function (e) {                
                //alert(e.target.value);
                pickDate = e.target.value;
                if(pickDate != ""){
                    //clickDate(pickDate);
                    $('#endDatePicker').datepicker("hide");
                }
            });
            
            
        })
    
    
    
    </script>