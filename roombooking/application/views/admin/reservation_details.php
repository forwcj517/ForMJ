
<?php 

$user = $this->db->get_where('usertable', array('no'=>$user_id))->row();
$tour = $this->db->get_where('room', array('id'=>$tour_id))->row();
$reservation  = $this->db->get_where('reservation', array('id'=>$rsv_id))->row();
?>

<div class="">        
    
    <div class="col-md-6">    
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">        
                                
                <div class="row">
                    <div class="col-sm-9">
                        <h3 style="margin-bottom:20px;">User Information.</h3>
                    </div>
                </div>
                
                <div class="form-group">  
                    
                    <div class="row" >
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('First Name'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "fname" name="fname" value="<?php echo $user->name;?>" required >
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last Name'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "lname" name="lname" value="<?php echo $user->surname;?>" required >
                        </div>                                        
                    </div>
                    
                     
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Email'); ?></label>										
                        <div class="col-sm-5">
                            <input class="form-control email" id="email" type="email" name="email" value="<?php echo $user->email;?>" />                            
                        </div>                                        
                    </div>                    
                    
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Phone Number'); ?></label>										
                        <div class="col-sm-5">
                            <input class="form-control phone" type="number" id="phone"  name="phone" placeholder="optional" value="<?php echo $user->phone;?>"/>
                        </div>                                        
                    </div>  
                    
                    
                </div>
                                				
            </div>            
        </div>    
        
        
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">        
                                
                <div class="row">
                    <div class="col-sm-9">
                        <h3 style="margin-bottom:20px;">Reservation Info.</h3>    
                    </div>                   
                </div>	
                
                <div class="form-group">
                    
                    <div class="row" >
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date'); ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id = "fname" name="fname" value="<?php echo $reservation->date;?>" required >
                        </div>                         
                        <div class="col-sm-5">
                            <label for="field-1" control-label"><?php echo get_phrase('Reservation Type:  '); ?></label>
                            <?php if($reservation->reservation_type == 0) {?>
                            <button type="button" class="btn btn-green btn-sm dropdown-toggle" data-toggle="dropdown" >Automatical</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-green btn-sm dropdown-toggle" data-toggle="dropdown">Manual</button>
                            <?php }?>                                                                                  
                        </div>
                    </div>
                                        
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Time'); ?></label>										
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id = "lname" name="lname" value="<?php echo $reservation->time;?>" required >
                        </div>        
                        <div class="col-sm-5">
                            <label for="field-1" control-label"><?php echo get_phrase('Reservation Status:  '); ?></label>
                            <button type="button" class="btn <?php echo $this->db->get_where('order_state', array('id'=>$reservation->state))->row()->button; ?> btn-sm dropdown-toggle" data-toggle="dropdown" >              
                            <?php echo $this->db->get_where('order_state', array('id'=>$reservation->state))->row()->name; ?>
                            </button>
                        </div>                                                
                    </div>
                    
                     
                    <div class="row" style="margin-top: 20px;">
                        <label fo r="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Guest'); ?></label>										
                        <div class="col-sm-4">
                            <input class="form-control email" id="email" type="email" name="email"  value="<?php echo $reservation->ticket_count;?>"/> 
                        </div>      
                        <div class="col-sm-5">aj
                            <label for="field-1" control-label"><?php echo get_phrase('Payment Status:  '); ?></label>
                            <?php
                            $code = $this->db->get_where('transaction', array('reservation_id' => $reservation->id))->row()->code;                 
                            if ($code != null && $code != '0') {                
                                echo "<span><font color='black'>Paid</font></span>";  
                            } else  {
                                echo "<span><font color='black'>Non-Paid</font></span>";    
                            } 
                            ?>
                        </div>
                    </div>                    
                    
                    <div class="row" style="margin-top: 20px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Promocode'); ?></label>										
                        <div class="col-sm-4">
                            <input class="form-control phone" type="text" id="phone"  name="phone" placeholder="optional" value="<?php echo $reservation->promocode;?>"/>
                        </div>     
                        <div class="col-sm-5">
                            <label for="field-1" control-label"><?php echo get_phrase('Reservation Code:  '); ?></label>
                            <?php echo "<span><font color='black'>".$reservation->code."</font></span>"; ?>
                        </div>
                    </div>                                          
                </div>                                				
            </div>            
        </div>    
                        
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">                                
                <div class="row">
                    <div class="col-sm-9">
                        <h3 style="margin-bottom:20px;">Note for reservation</h3>    
                    </div>                   
                </div>                
                <div class="form-group">                    
                    <div class="row" >
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('note'); ?></label>										
                        <div class="col-sm-6">
                             <textarea type = "text" id="note" class = "form-control" name="description" cols="40" rows="3"  required autofocus><?php echo $reservation->note; ?></textarea>
                        </div>
                        <div class="col-sm-3" >
                            <button type="button" onclick="updateNote()" class="btn btn-blue btn-large dropdown-toggle" data-toggle="dropdown" >Note</button>                            
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
                        <h3 style="margin-bottom:20px;">Tour Information.</h3>    
                    </div>
                   
                </div>	
                
                <div class="form-group">
                    <h4><?php echo $tour->name; ?></h4>
                    <div class="row">	
                        <div class="col-sm-6">
                            <img src="<?php echo base_url($tour->image_url); ?>" class="img-responsive" style="height:250px;width: 100%">
                        </div>
                        <div class="col-sm-6">
                            <iframe width="100%" height="250px" src="https://www.youtube.com/embed/<?php echo $tour->video_id?>?ecver=1" frameborder="0" allowfullscreen></iframe>						                           
                        </div>
                    </div>
                    
                    <div class="about-over">
                        <h4>Description</h4>
                        <p><?php echo $tour->description; ?></p>

                        <h4>Include</h4>
                        <p><?php echo $tour->include; ?></p>


                        <h4>Know</h4>
                        <p><?php echo $tour->know; ?></p>

                        <h4>Summary</h4>
                        <p><?php echo $tour->summary; ?></p>

                        <a href="">Contact host</a>
                    </div>                                                                                                                      
                </div>
                
                                                
                
               
                <p class="text-center"><small>You won't be charged yet</small></p>
                <hr>
                					
            </div>
        </div>
        
     </div>   
     
     
</div>

<script>    
    
    $(document).ready(function () {
        
    })

    function updateNote() { 
        
        var note = document.getElementById("note").value;
        
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/update_note'); ?>",
            dataType: 'json',
            data: {rsv_id: "<?php echo $rsv_id; ?>", note: note},
            success: function (data) {
                if (data)
                {
                    // Show Entered Value                                        
                    results = data.result;
                    if(results == "success"){
                        alert("success");
                    }else{
                        alert("failed");
                    }
                }
            }
        });
    }
    
</script>


 
