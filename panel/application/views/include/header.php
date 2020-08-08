<?php
error_reporting(0);
//Get current url with query string
$CI =& get_instance();
$url = $CI->config->site_url($CI->uri->uri_string());
$currentURL =  $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
if(@$_SESSION['username'] == '')
{
    $this->session->set_userdata('old_url',$currentURL);
?>
<script>
alert('You must LogIn First');
window.location.href = "<?php echo site_url('site/index'); ?>"; 
</script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>:: PARAMPARA-ADMIN ::</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="<?php echo base_url(); ?>img/company/logo.png" type="image/x-icon" />
        <!-- END META SECTION -->
        <?php
			$q = $this->db->query("select * from `theme_active` where `theme_id` = '1'");
			$res = $q->row_array();
			$theme_actv = $res['theme_name'];			
		?>
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url(); echo $theme_actv; ?>"/>
        <link rel="stylesheet" href="<?=base_url()?>css/common.css">
        <!-- EOF CSS INCLUDE -->
		<style>
			.form-control
			{
				font-size:14px;
			}
			label
			{
				font-size:14px;
			}
			.datatable
			{
				font-size:14px;
			}
		</style>
		
		<style type="text/css">
        .full_loader {
            position: absolute;
            padding: 0;
            margin: 0;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0,0,0,0.6);
            opacity: 1;
        }
        
        .full_loader img {
            position: fixed;
            left: 90px;
            top: 60px;
            margin: auto;
            bottom: 0;
            max-width: 350px;
            right: 0;
            width: 100%;
        }
        </style>
    </head>
    <body>
        
		<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
		<!--  <script src="<?php echo base_url(); ?>/js/ckeditor.js"></script> -->

	<!-- START SCRIPTS -->
		<!-- START PLUGINS -->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap.min.js"></script>
		<!-- END PLUGINS -->
		<!-- START THIS PAGE PLUGINS-->
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/icheck/icheck.min.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/scrolltotop/scrolltopcontrol.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/morris/raphael-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/morris/morris.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/nvd3/nv.d3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/rickshaw/rickshaw.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/knob/jquery.knob.min.js"></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/owl/owl.carousel.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/fullcalendar/fullcalendar.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/daterangepicker/daterangepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/codemirror/codemirror.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/plugins/codemirror/mode/xml/xml.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/plugins/codemirror/mode/javascript/javascript.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/plugins/codemirror/mode/css/css.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/plugins/codemirror/mode/clike/clike.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>js/plugins/codemirror/mode/php/php.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/summernote/summernote.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/dropzone/dropzone.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/fileinput/fileinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/filetree/jqueryFileTree.js"></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/validationengine/jquery.validationEngine.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-validation/jquery.validate.js"></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/jvectormap/jquery-jvectormap-europe-mill-en.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/jvectormap/jquery-jvectormap-us-aea-en.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tocify/jquery.tocify.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/highlight/jquery.highlight-4.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/demo_tables.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tableexport/tableExport.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tableexport/jquery.base64.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tableexport/html2canvas.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tableexport/jspdf/jspdf.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tableexport/jspdf/libs/base64.js"></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/noty/jquery.noty.js'></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/noty/layouts/topCenter.js'></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/noty/layouts/topLeft.js'></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/noty/layouts/topRight.js'></script>
		<script type='text/javascript' src='<?php echo base_url(); ?>js/plugins/noty/themes/default.js'></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/portlet.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/rangeslider/jQAllRangeSliders-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tour/bootstrap-tour.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tour/bootstro.min.js"></script>
        <script type="text/javascript" src='<?php echo base_url(); ?>js/jquery.playSound.js'></script>
            <!-- Selectpicker start -->
				<link rel="stylesheet" href="<?php echo base_url(); ?>/css/selectpicker/select2.min.css">
				<script src="<?php echo base_url(); ?>/css/selectpicker/select2.full.min.js"></script>
				
				
	<div id="full_loader" class="full_loader" style="width: 1080px; display:none; height: 550px; z-index:9999999;"><img src="<?php echo base_url(); ?>img/loaders/newloader.gif"></div>
	<div id="success_loader" class="full_loader" style="width: 1080px; display:none; height: 550px; z-index:9999999;"><img src="<?=base_url()?>/img/loaders/success_loader.gif"></div>
	<style type="text/css">
	.scroller
	{
		max-height: 500px;
		overflow-y: scroll;
	}
	</style>
	
	
	