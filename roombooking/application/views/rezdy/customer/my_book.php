<?php
//include ('../common/new-header.php') 
$this->load->view('rezdy/common/header');
?>


<script>

    var current = 1;
    $(document).ready(function () {
        
    });

    function getReservations() {
        var name = $('#activities').val();

        if (name != "" && name.length >= 2) {

            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url('api/getReservations'); ?>",
                dataType: 'json',
                data: {name: name},
                success: function (data) {
                    if (data)
                    {
                        // Show Entered Value                           
                        locations = data.reservations;
                        var toAppend = '';
                        $i = 0;
                        $.each(locations, function (i, o) {
                            
                            
                            
                            toAppend = toAppend + '<div class="row">';
                            toAppend = toAppend + '<div class="row border_book" style="margin-top: 10px;">';
                                    toAppend = toAppend + '<div class="col-sm-3" id="homes-slider1" data-ride="carousel">';
                                        toAppend = toAppend + '<div class="carousel-inner" role="listbox">'
                                            toAppend = toAppend + '<div class="item active">'
                                                toAppend = toAppend + '<a href="">';
                                                    toAppend = toAppend + '<div class="tour-section">';
                                                        toAppend = toAppend + '<img src="<?php echo base_url() ?>' + o.image_url + '" style="width:100%;height: 180px;">';
                                                    toAppend = toAppend + '</div>';
                                                toAppend = toAppend + '</a>';
                                            toAppend = toAppend + '</div>';
                                        toAppend = toAppend + '</div>';
                                    toAppend = toAppend + '</div>';
                                    toAppend = toAppend + '<div class="col-sm-9">';
                                        toAppend = toAppend + '<div class="form-group col-sm-12">';
                                            toAppend = toAppend + '<h1>' + o.name + '</h1>';
                                            toAppend = toAppend + '<h4>Start Date : ' + o.checkin + '</h4>';
                                            toAppend = toAppend + '<h4>End Date : ' + o.checkout + '</h4>';
                                            toAppend = toAppend + '<h4>Number of bed : ' + o.no_of_bed + '</h4> ';
                                        toAppend = toAppend + '</div>';
                                    toAppend = toAppend + '</div>';
                                toAppend = toAppend + '</div> ';
                            toAppend = toAppend + '</div>';                                                                        
                                                                                
                            $i = $i + 1;
                        });
                        //                                    if(locations.length > 0){
                        $("#activity").html(toAppend);
                        //                                    }
                    }
                }
            });
        }
    }
</script>
<div class="listing">    
    <div class="container">
        <div class="col-sm-12">
            
            <div class="left-homes result" id='mydiv2'>     
                <div class="row" >
                    <h1>Enter your email address  &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class=" input-lg" placeholder="Activities" id="activities" ><button onclick="getReservations()" class="btn btn-warning waves-effect waves-light" type="submit" style="margin-left:5px;">Get Reservations</button> </h1>
                </div>                                       
                    <div id="activity">
                        <?php
                        $i = 0;
                        if($this->session->userdata('admin_login') == 2){
                            $query = $this->db->query("SELECT * FROM reservation as r LEFT JOIN room as u on r.tour_id = u.id where no_of_bed != 'NULL' && user_id='".$this->session->userdata('admin_id')."'");
                            //$query = $this->db->query("SELECT * FROM reservation as r LEFT JOIN room as u on r.tour_id = u.id");
                            $tours = $query->result_array();
                        }else{
                            $tours = array();                            
                        }                                                
                        foreach ($tours as $row1):
                            ?>                                                                                          
                               <div class="row" >                  
                                    <div class="row border_book" style="margin-top: 10px;">  
                                        <div class="col-sm-3" id="homes-slider1" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <a  href="">
                                                        <div class="tour-section">
                                                            <img src="<?php $image = $this->db->get_where('room', array('id'=>$row1['tour_id']))->row(); if($image != null){ echo base_url($image->image_url);} ?>" style="width:100%;height: 180px;">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-sm-9">                                                     
                                            <div class="form-group col-sm-12">
                                                <h1><?php echo $row1['name']; ?></h1> 
                                                <h4><?php echo "Start Date : ".$row1['checkin']; ?></h4> 
                                                <h4><?php echo "End Date : ". $row1['checkout']; ?></h4> 
                                                <h4><?php echo "Number of bed : ". $row1['no_of_bed']; ?></h4> 
                                            </div>
                                        </div>
                                    </div> 
                                </div>       
                            <?php
                            $i++;
                        endforeach;
                        ?>

                    </div>


                </div>  

            

        </div>

    </div>
</div>

