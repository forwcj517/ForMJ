
<?php 
$reservation = $this->db->get_where('reservation', array('id'=>$rsv_id))->row();
$transaction = $this->db->get_where('transaction', array('reservation_id'=>$rsv_id))->row();
?>

<div class="">        
    
    <div class="col-md-12">    
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">        
                                
                <div class="row">
                    <div class="col-sm-9">
                        <h3 style="margin-bottom:20px;"> Cancel Reservation</h3>
                    </div>
                </div>
                
                <div class="form-group">                      
                    <div class="row" >
                        <div class="col-md-1"></div>
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Enter a custom refund:'); ?></label>										
                        
                        <div class="col-sm-5" hidden="true">
                            <input hidden="true" type="number" class="form-control" id = "transaction_id" name="transaction_id" value="<?php echo $transaction->id;?>">
                        </div>
                        <div class="col-sm-5">
                            
                            <input type="number" class="form-control" id = "fname" name="fname" value="<?php echo $transaction->price;?>" required>                            
                        </div>
                    </div>                                                           
                </div>
                
                <div class="form-group">                      
                    <div class="col-md-6" >
                        <button onclick="window.location.href='<?php echo site_url('user/refund/'.$transaction->id)?>'" class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">Refund Only</button>
                    </div><div class="col-md-6" >
                        <button onclick="window.location.href='<?php echo site_url('admin/reservations/do_update/'.$rsv_id."/3")?>'" class="btn btn-red waves-effect waves-light btn-block btn-lg margintop15" type="submit">Cancel without Refund</button>
                    </div>
                                                           
                </div>
                
            </div>            
        </div>    

       
    </div>
    
</div>


 
