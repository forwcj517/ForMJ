

<br><br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            
            <th><div><?php echo get_phrase('Client Name'); ?></div></th>
            <th><div><?php echo get_phrase('Transactin Id'); ?></div></th>
            <th><div><?php echo get_phrase('Amount'); ?></div></th>
            <th><div><?php echo get_phrase('Date'); ?></div></th>

        </tr>
</thead>


<tbody>
    <?php
    if($this->session->userdata('admin_login') == 1 ){
        $hours = $this->db->get('transaction')->result_array();
    }else if($this->session->userdata('admin_login') == 3){
        $hours = $this->db->get_where('transaction', array('client_id'=>$this->session->userdata('admin_id')))->result_array();
    }
        
    foreach ($hours as $row):
        ?>
        <tr>
            <td><?php $userdata = $this->db->get_where('usertable', array('no'=>$row['client_id']))->row(); echo $userdata->name; ?></td>
            <td><?php echo $row['transaction_id']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['dt']; ?></td>            
        </tr>
<?php endforeach; ?>
</tbody>
</table>