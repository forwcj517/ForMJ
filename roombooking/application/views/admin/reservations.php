<!--<a href="<?php echo site_url('admin/add_reservation');?>" onclick="" class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
<?php echo get_phrase('Add Booking'); ?>
</a> -->

<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <!--<th><div><?php echo get_phrase('User Name'); ?></div></th>-->
            <!--<th><div><?php echo get_phrase('More'); ?></div></th>-->
            <th><div><?php echo get_phrase('User Email'); ?></div></th>
            <th><div><?php echo get_phrase('User Phone'); ?></div></th> 
            <th><div><?php echo get_phrase('Tour Name'); ?></div></th>
            <th><div><?php echo get_phrase('Ticket Count'); ?></div></th>
            <th><div><?php echo get_phrase('Date Time'); ?></div></th>			            
<!--            <th><div><?php echo get_phrase('Rsv Type'); ?></div></th> -->
            <th><div><?php echo get_phrase('Status'); ?></div></th>            
            <!--<th><div><?php echo get_phrase('options'); ?></div></th>-->
        </tr>
    </thead>
<tbody>
    
    
    <?php

    foreach ($hours as $row):
        ?>
        <tr>
<!--            <td>
                <div class="btn-group">
                    <a href="<?php echo site_url('admin/reservation_details/'.$row['id']."/".$row['tour_id']."/".$row['user_id']) ?>" class="btn btn-primary pull-right">
                        More...
                    </a>                                         
                </div>
            </td>            -->
            <td><?php echo $row['customer']['name']; ?></td>
            <td>
                <?php 
                    try{
                        if (array_key_exists('email', $row['customer'])) {
                            echo $row['customer']['email'];        
                        }                        
                    } catch (Exception $ex) {
                        echo "";
                    }
                ?>
            </td>
            <td>
                <?php 
                    try{
                        //if (array_key_exists('phone', $row['customer'])) {
                            echo $row['items'][0]['productName'];
                        //}                        
                    } catch (Exception $ex) {
                        echo "";
                    }
                ?>
            </td>
            <td><?php echo $row['items'][0]['totalQuantity']; ?></td>
            <td><?php echo $row['dateCreated']; ?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn  btn-sm dropdown-toggle" data-toggle="dropdown" >              
                    <?php echo $row['status']; ?>
                    </button>
                </div>
            </td> 
            
<!--            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    
                    <?php if($row['state'] == 1) { ?>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                             EDITING LINK 
                            <li>
                                <a href="<?php echo site_url('admin/reservations/do_update/'.$row['id']."/2")?>" onclick="">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('accept'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>                            
                            <li>
                                <a href="<?php echo site_url('admin/reservations/do_update/'.$row['id']."/3")?>" onclick="">
                                    <i class="entypo-trash"></i>
                                    <?php echo get_phrase('reject'); ?>
                                </a>
                            </li>                                        
                        </ul>
                    <?php } ?>
                                        
                    <?php if($row['state'] == 2) { ?>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                             EDITING LINK 
                            <li>
                                <a href="<?php echo site_url('admin/reservations/do_update/'.$row['id']."/4")?>" onclick="">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('complete'); ?>
                                </a>
                            </li>                                          
                        </ul>
                    <?php } ?>
                    
                    <?php if($row['state'] == 3 || $row['state'] == 4) { ?>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                             EDITING LINK 
                            <li>
                                <a href="<?php echo site_url('admin/reservations/delete/'.$row['id'])?>" onclick="">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>                                          
                        </ul>
                    <?php } ?>
                                        
                </div>

            </td>-->
        </tr>
    <?php endforeach; ?>
</tbody>



</table>


<script>
    
    $(document).ready(function() {
    $('#table_export').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
} );
</script>