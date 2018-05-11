<div class="row">
    <div class="col-md-8">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule'); ?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">

            <div class="col-md-12" id="user"> 
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('usertable'); ?>" data-postfix="" data-duration="500" data-delay="0">0</div>                    
                    <h3><?php echo get_phrase('User'); ?></h3>
                    <p>Total Providers</p>
                </div>                
            </div>

            <div class="col-md-12" id="reservation">

                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('usertable'); ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('Reservation'); ?></h3>
                    <p>Reservation Count</p>
                </div>

            </div>
            <div class="col-md-12" id="tour">

                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('usertable'); ?>" data-postfix="" data-duration="800" data-delay="0">0</div>

                    <h3><?php echo get_phrase('Rooms'); ?></h3>
                    <p>Total Tour  Count</p>
                </div>

            </div>

            <div class="col-md-12" id="guider">

                <div class="tile-stats tile-plum">
                    <div class="icon"><i class="entypo-layout"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('usertable'); ?>" 
                         data-postfix="" data-duration="800" data-delay="0">0</div>                    
                    <h3><?php echo get_phrase('Guider'); ?></h3>
                    <p>Total Tour Guider </p>
                </div>

            </div>

            <div class="col-md-12" id="customer">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('usertable'); ?>" 
                         data-postfix="" data-duration="500" data-delay="0">0</div>                    
                    <h3><?php echo get_phrase(' Customers '); ?></h3>
                    <p>Total Coustomers</p>
                </div>

            </div>

        </div>
    </div>

</div>

<script>
    $(document).ready(function () {        
        //initData();
        
        
          
	var calendar = $('#notice_calendar');
					
	$('#notice_calendar').fullCalendar({
		header: {
			left: 'title',
			right: 'today prev,next'
		},

		//defaultView: 'basicWeek',
		editable: false,
		firstDay: 1,
		height: 530,
		droppable: false,
	
	});
        
//        
//        $( "#user" ).click(function() {
//          window.location.href = "<?php echo site_url('admin/manager_provider');?>";
//        });        
//        $( "#reservation" ).click(function() {            
//            window.location.href = "<?php echo site_url('admin/reservations');?>";
//        });        
//        $( "#tour" ).click(function() {
//          window.location.href = "<?php echo site_url('admin/tour_all');?>";
//        });
//        
//        $( "#guider" ).click(function() {
//          window.location.href = "<?php echo site_url('admin/manager_guider');?>";
//        });
//        
//        $( "#customer" ).click(function() {
//            
//          window.location.href = "<?php echo site_url('admin/manager_customer');?>";
//        });
    
    });

    var employees = {
        events: []
    };

    function initData() {     
        check = "";
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/get_events'); ?>",
            dataType: 'json',
            data: {date: check},
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                    
                    units = data.event;
                    count = 0;
                    $.each(units, function (i, o) {                        
                         employees.events.push({ 
                            "title" : o.name + "(" + o.tour_count + ")",
                            "start"  : o.date,
                            "url" : o.date
                        });
                        
                        count = count + 1;
                    });
                    var calendar = $('#notice_calendar');
                    $('#notice_calendar').fullCalendar({
                        header: {
                            left: 'title',
                            right: 'today prev,next'
                        },
                        events: employees,                
                        //defaultView: 'basicWeek',
                        editable: false,
                        firstDay: 1,
                        height: 530,
                        droppable: false,
                        eventClick: function(calEvent, jsEvent, view) {                            
                            //alert('Event: ' + calEvent.start);
                            //window.open("<?php echo site_url('admin/tour_all');?>");
                            window.location.href = "<?php echo site_url('admin/reservations');?>" + "/xx/" + calEvent.url;
                            return false;
//                            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//                            alert('View: ' + view.name);
//                            // change the border color just for fun
//                            $(this).css('border-color', 'red');

                        }
                    });




                }
            }
        });
    }




</script>