	



<link rel="stylesheet" href="<?php echo base_url('assets_extra/js/datatables/responsive/css/datatables.responsive.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets_extra/js/select2/select2-bootstrap.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets_extra/js/select2/select2.css');?>">

   	<!-- Bottom Scripts -->
	<script src="<?php echo base_url('assets_extra/js/gsap/main-gsap.js');?>"></script>
	<script src="<?php echo base_url('assets_extra/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js');?>"></script>
	<script src="<?php echo base_url('assets_extra/js/bootstrap.js');?>"></script>
	<script src="<?php echo base_url('assets_extra/js/joinable.js');?>"></script>
	<script src="<?php echo base_url('assets_extra/js/resizeable.js');?>"></script>
	<script src="<?php echo base_url('assets_extra/js/neon-api.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/jquery.validate.min.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/fullcalendar/fullcalendar.min.js');?>"></script> 

    <script src="<?php echo base_url('assets_extra/js/fileinput.js');?>"></script>
    
    <script src="<?php echo base_url('assets_extra/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/datatables/TableTools.min.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/dataTables.bootstrap.js');?>"></script>   
    <script src="<?php echo base_url('assets_extra/js/datatables/jquery.dataTables.columnFilter.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/datatables/lodash.min.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/datatables/responsive/js/datatables.responsive.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/select2/select2.min.js');?>"></script>
    
    <script src="<?php echo base_url('assets_extra/js/neon-calendar.js');?>"></script>	
    <script src="<?php echo base_url('assets_extra/js/neon-chat.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/neon-custom.js');?>"></script>
    <script src="<?php echo base_url('assets_extra/js/neon-demo.js');?>"></script>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>