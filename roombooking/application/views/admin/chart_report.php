

<!-- /.modal -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-toolbar">
        <h4>DAY ANALYSIS</h4>
    </div>
    <!-- END PAGE TITLE -->
</div>

<div class="form-horizontal">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">         
                    
                    <i class="icon-bar-chart font-green-haze"></i>
                    
<!--                <span class="caption-subject bold uppercase font-green-haze"> Incident Count</span>
                    <span style="padding-left: 50px;">Period</span>                    
                    <input id="start_incident" type="text" class="form-control input-small input-inline date-picker" value="">
                    <input id="end_incident" type="text" class="form-control input-small input-inline date-picker" value="">                    
                    <button type ="button" class ="btn blue" id="incident_refresh">Refresh</button>  
                    <button type ="button" class ="btn blue" id="incident_print">Print</button> -->
                    <span class="caption-subject bold uppercase font-green-haze"> Analysis</span>
                                                            
                    <select id="filter_type" name="filter_type" class="filter_type" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" style="width:280px;margin-left: 20px;">
                        <option value='0'> Month </option>
                        <option value='1'> Week </option>                        
                    </select>
                    
                    <span style="padding-left: 150px;">Period:</span>
                    <input id="start_date" type="text" class="form-control input-small input-inline date-picker" value="">                    
                    <input id="end_date" type="text" class="form-control input-small input-inline date-picker" value="">
                    <button type ="button" class ="btn blue" id="btn_refresh">Refresh</button>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="fullscreen"></a>
                </div>
            </div>            
            <div class="portlet-body">
                <div class="row">
<!--                    <div class="col-md-6">
                        <div id="line_chart_1" class="chart"></div>
                    </div>-->
                    <div class="col-md-12">
                        <div id="line_chart_2" class="chart"></div>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('Book'); ?></div></th>
            <th><div><?php echo get_phrase('Tickets Count'); ?></div></th>
            <th><div><?php echo get_phrase('Tour price'); ?></div></th>		
            <th><div><?php echo get_phrase('Add ons price'); ?></div></th>		            
            <th><div><?php echo get_phrase('Total Price'); ?></div></th>
        </tr>
</thead>

<tbody>
    <?php
    foreach ($addons as $row):
        ?>
        <tr>
            
            <td><?php echo $row['book']; ?></td>
            <td><?php echo $row['tickets']; ?></td>
            <td><?php echo $row['tour_price']; ?></td>
            <td><?php echo $row['addons_price']; ?></td>	
            <td><?php echo $row['total_price']; ?></td>	
           
        </tr>
<?php endforeach; ?>
</tbody>
</table>


<!--
<div class="form-horizontal">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"> Time Analysis</span>

                    <span style="padding-left: 100px;">Period</span>
                    <input id="start_time" type="text" class="form-control input-small input-inline date-picker" value="">
                    <input id="end_time" type="text" class="form-control input-small input-inline date-picker" value="">
                    <button type ="button" class ="btn blue" id="time_refresh">Refresh</button> 
                    <button type ="button" class ="btn blue" id="time_print">Print</button> 

                </div>
                <div class="tools">
                    <a href="javascript:;" class="fullscreen"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="line_chart_3" class="chart">
                </div>
            </div>
        </div>
    </div>
</div>-->



<!--
<div class="form-horizontal">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"> Annual Comparative Top 5</span>
                    <span style="padding-left: 100px;">Period</span>
                    <input id="start_annual" type="text" class="form-control input-small input-inline date-picker" value="">
                    <input id="end_annual" type="text" class="form-control input-small input-inline date-picker" value="">
                    <button type ="button" class ="btn blue" id="annual_refresh">Refresh</button> 
                    <button type ="button" class ="btn blue" id="annual_print">Print</button> 
                </div>
                <div class="tools">
                    <a href="javascript:;" class="fullscreen"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="line_chart_4" class="chart">
                </div>
            </div>
        </div>
    </div>
</div>



<div class="form-horizontal">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"> Annual Comparative Incident Count</span>
                    <span style="padding-left: 100px;">Period</span>
                    <input id="start_last" type="text" class="form-control input-small input-inline date-picker" value="">
                    <input id="end_last" type="text" class="form-control input-small input-inline date-picker" value="">
                    <button type ="button" class ="btn blue" id="last_refresh">Refresh</button> 
                </div>
                <div class="tools">
                    <a href="javascript:;" class="fullscreen"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="line_chart_5" class="chart">
                </div>
            </div>
        </div>
    </div>
</div>-->

<!-- END PAGE CONTAINER-->

<!-- Start AmChar -->
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/amcharts.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/serial.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/pie.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/radar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/themes/light.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/themes/patterns.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amcharts/themes/chalk.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/ammap/ammap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/ammap/maps/js/worldLow.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugin/amcharts/amstockcharts/amstock.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/charts_custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/table-custom.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets_extra/css/datepicker3.min.css'); ?>" />
<script src="<?php echo base_url('assets_extra/js/bootstrap-datepicker.min.js'); ?>"></script>

<script type="text/javascript">
        //ComponentsPickers.init();        
        //setStartEndDate("start_incident", "end_incident");
        //setStartEndDate("start_time", "end_time");
        //setStartEndDate("start_annual", "end_annual");
        //setStartEndDate("start_last", "end_last");
        setStartEndDate("start_date", "end_date");


<?php
$inc_color = array('#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98','#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98');
$monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$total_inc = 0;

foreach ($data as $row):
    $total_inc += $row->real_price;
endforeach;
if ($total_inc == 0) {
    $total_inc = 0.01;
}
$i = 0;
?>
     

var incidents = [
<?php foreach ($data as $row): ?>
    {
    "week": "<?php echo $monthNames[$row['month']- 1]; ?>" ,
            "count": <?php echo $row['real_price']/$total_inc; ?> , 
            "color": "<?php echo $inc_color[$i];?>"
    },
    <?php $i++;
endforeach; ?>
];
<?php
$week0 = array_key_exists(0, $weeks) ? $weeks[0] : 0.01;
$week1 = array_key_exists(1, $weeks) ? $weeks[1] : 0.01;
$week2 = array_key_exists(2, $weeks) ? $weeks[2] : 0.01;
$week3 = array_key_exists(3, $weeks) ? $weeks[3] : 0.01;
$week4 = array_key_exists(4, $weeks) ? $weeks[4] : 0.01;
$week5 = array_key_exists(5, $weeks) ? $weeks[5] : 0.01;
$week6 = array_key_exists(6, $weeks) ? $weeks[6] : 0.01;

?>

var weeks = [
{
"week": "Monday",
        "count": 10,
        "color": "<?php echo $inc_color[0]; ?>"
},
{
"week": "Turesday",
        "count": 10,
        "color": "<?php echo $inc_color[1]; ?>"
},
{
"week": "Wednesday",
        "count": 10,
        "color": "<?php echo $inc_color[2]; ?>"
},
{
"week": "Thursday",
        "count": 10,
        "color": "<?php echo $inc_color[3]; ?>"
},
{
"week": "Friday",
        "count": 10,
        "color": "<?php echo $inc_color[4]; ?>"
},
{
"week": "Saturday",
        "count": 10,
        "color": "<?php echo $inc_color[5]; ?>"
},
{
"week": "Sunday",
        "count": 10,
        "color": "<?php echo $inc_color[6]; ?>"
},
        ];        
        //{{round($week6 / $weeks[100] * 100, 1)}}
        
        var hours = [
            
<?php for ($i = 0; $i < 0; $i++): ?>
            {
            "hour": "{{$i.'~'.($i+1).'h'}}",
                    "count": {{round($hours[$i] / $hours[100] * 100, 1)}}
            },
<?php endfor; ?>
    
        ];
        
        
        jQuery(document).ready(function() {
            LineAmcharts.init(incidents, incidents, hours);
            //annual();                
            $('#start_date').datepicker({
                format: 'mm/dd/yyyy'
            });    
             $('#end_date').datepicker({
                format: 'mm/dd/yyyy'
            });
            
            $('.filter_type').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;                  
                //  alert(valueSelected);
                getFilter(valueSelected);
            });
            
            $("#btn_refresh").click(function(){
                                               
                var start = $("#start_date").val();
                var end = $("#end_date").val();
                //alert(filter_type);
                getFilterByDate(start,end )
            }); 

        });
        
        
        
        
    
    Number.prototype.round = function() {
        return Math.round(this);
    }


      
        
        $(document).on('click', '#incident_print', function(){
//chartPrint("#line_chart_1");
//window.myprint("#line_chart_1");
        //  window.print();
        });


function getFilter(filter_type) {
    jQuery.ajax({
        type: "POST",
        url: "<?php echo site_url('api/get_report'); ?>",
        dataType: 'json',
        data: {filter_type: filter_type},
        success: function (data) {
            if (data)
            {
                // Show Entered Value                                                        
                var res = data.results;
                var myincident = [];
                var total_inc = 0;
                for (i = 0; i < res.length; i++){
                    total_inc += parseFloat(res[i].real_price);
                }
                if(filter_type == 0){
                    var inc_color = ['#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98','#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98'];
                    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November', 'December'];                        
                    //$monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    for (i = 0; i < res.length; i++){
                        var obj = {
                        "week": monthNames[res[i].month-1],
                                "count": Math.round(parseFloat(res[i].real_price) / parseFloat(total_inc) * 100),
                                "color": inc_color[i]
                        };
                        myincident.push(obj);            
                    }
                    LineAmcharts.init(myincident, myincident, hours);
                }else{
                    var inc_color = ['#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98','#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98'];
                    var monthNames = ['Monday', 'Thuesday', 'Wendesday', 'Thursday', 'Friday', 'Saturday', 'Sundy'];
                    //$monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    for (i = 0; i < res.length; i++){
                        var obj = {
                        "week": monthNames[res[i].weekofday - 1],
                                "count": Math.round(parseFloat(res[i].real_price) / parseFloat(total_inc) * 100),
                                "color": inc_color[i]
                        };
                        myincident.push(obj);            
                    }
                    LineAmcharts.init(myincident, myincident, hours);                            
                }
                
                                                                              
            }
        }
    });    
}
    

function getFilterByDate(start, end) {

   var filter_type = $(".filter_type").val();
   
    jQuery.ajax({
        type: "POST",
        url: "<?php echo site_url('api/get_report_bydate'); ?>",
        dataType: 'json',
        data: {start_date: start, end_date: end, filter_type:filter_type},
        success: function (data) {
            if (data)
            {
                // Show Entered Value                                                        
                var res = data.results;
                var myincident = [];
                var myReports = [];
                var total_inc = 0;
                for (i = 0; i < res.length; i++){
                total_inc += parseFloat(res[i].real_price);
                }
                
                if(filter_type == 0){
                    var inc_color = ['#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98','#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98'];
                    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November', 'December'];                        
                    //$monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    for (i = 0; i < res.length; i++){
                        var obj = {
                        "week": monthNames[res[i].month-1],
                                "count": Math.round(parseFloat(res[i].real_price) / parseFloat(total_inc) * 100),
                                "color": inc_color[i]
                        };
                        myincident.push(obj);            
                    }
                    // incidents  += "]";                                                          
                    LineAmcharts.init(myincident, myincident, hours);
                }else{
                    var inc_color = ['#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98','#e87f24', '#20a185', '#bec3c7', '#ea1b63', '#18bcd5', '#795549', '#923c98'];
                    var monthNames = ['Monday', 'Thuesday', 'Wendesday', 'Thursday', 'Friday', 'Saturday', 'Sundy'];
                    //$monthNames = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                    for (i = 0; i < res.length; i++){
                        var obj = {
                        "week": monthNames[res[i].weekofday - 1],
                                "count": Math.round(parseFloat(res[i].real_price) / parseFloat(total_inc) * 100),
                                "color": inc_color[i]
                        };
                        myReports.push(obj);            
                    }
                    LineAmcharts.init(myincident, myReports, hours);                            
                }
                
                    
            }
        }
    });
    
}
    



    function annual() {

        var start = $("#start_annual").val();
                var end = $("#end_annual").val();
                dataString = "start=" + start + "&end=" + end;
                $.ajax({
                type: "POST",
                        url: "{{ URL::to('Report/AnnualChart') }}",
                        data: dataString,
                        success: function (data) {
                        if (data != null){
                        res = data[10][1]['name'];
                                initChart4(data);
                        }
                        }
                }, "json");
                
    }
                
</script>


