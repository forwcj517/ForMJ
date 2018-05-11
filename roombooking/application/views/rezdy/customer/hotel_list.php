
<?php
//include ('../common/header.php') 
$this->load->view('rezdy/common/header');
$hotel_image = $this->db->get_where('res_image', array('res_id' => $res_id))->row();
?>


<div class="listing">
    <div class="container">       
        <?php   foreach ($suppliers->Option as $row1):?>       
                <!-- first Review-->
                <div class="row">
                    <?php echo form_open('user/open_payment/', array('class' => 'form-horizontal form-groups-bordered validate'));?>
                        <div class="review-section-m">
                                <div class="col-sm-2">
                                        <img src="<?php echo $hotel_image->image;?>" class="img-responsive">									
                                </div>
                                <div class="col-sm-6">
                                        <h2><a href=""> <?php echo $row1->OptGeneral->SupplierName; ?> </a></h2>
                                        <div class="give-review">
                                                <div class="nu-of-review">
                                                <span> <?php echo $row1->OptGeneral->ClassDescription?></span>
<!--                                                <i class="fa fa-star orange" aria-hidden="true"></i>
                                                <i class="fa fa-star orange" aria-hidden="true"></i>
                                                <i class="fa fa-star orange" aria-hidden="true"></i>
                                                <i class="fa fa-star orange" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>-->
                                                </div>
                                                <div class="price-of-proj">
                                                </div>
                                                <div class="clearfix"></div>
                                        </div>
                                        <p><?php  echo $row1->OptGeneral->Description; ?></p>
                                        <p class="client-de"> <h3><?php echo $row1->OptStayResults->TotalPrice."(".$row1->OptStayResults->Currency.")" ; ?></h3></p>
                                </div>            
                                
                                <div hidden="true">
                                   <input type="text" id="code" name="code" value="<?php echo $row1->Opt; ?>"/>    
                                   <input type="text" id="res_id" name="res_id" value="<?php echo $res_id; ?>"/> 
                                   <input type="text" id="adult" name="adult" value="<?php echo $adult; ?>"/> 
                                   <input type="text" id="child" name="child" value="<?php echo $child; ?>"/> 
                                   <input type="text" id="price" name="price" value="<?php echo $row1->OptStayResults->TotalPrice; ?>"/>                                    
                                   <input type="text" id="start_date" name="start_date" value="<?php echo $start_date; ?>"/> 
                                   <input type="text" id="end_date" name="end_date" value="<?php echo $end_date; ?>"/> 
                                               
                                </div>                           
                            
                                <div class="col-sm-4">
                                    <button class="btn btn-warning waves-effect waves-light btn-block btn-lg margintop15" type="submit">
                                        Book
                                    </button>
                                </div>
                                
                        </div>
                    <?php echo form_close(); ?> 
                </div>
                <hr>
                <!-- first Review-->                                                                                
        <?php        endforeach; ?>           
        
    </div>
</div>

                                                                
                                                                
                                                                

 




<?php
$this->load->view('rezdy/common/footer');
?>