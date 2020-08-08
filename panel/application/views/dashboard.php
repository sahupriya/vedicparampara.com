<script>
	var actv_pg = "<?php echo $this->uri->segment(2); ?>";
	$("#"+actv_pg).addClass('active');
	
$(document).ready(function (){
    $(".datepicker").datepicker({
        autoclose : true,
    });
});
</script>
<!--<script>-->
<!--$(function(){-->
<!--Morris.Donut({-->
<!--        element: 'dashboard-donut-1',-->
<!--        data: [-->
<!--            {label: "Returned", value: 2513},-->
<!--            {label: "New", value: 764},-->
<!--            {label: "Registred", value: 311}-->
<!--        ],-->
<!--        colors: ['#33414E', '#1caf9a', '#FEA223'],-->
<!--        resize: true-->
<!--    });-->
<!--});-->
<!--</script>-->
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<!-- START WIDGETS -->
	<div class="row">
		<div class="col-md-3">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon">
				<div class="widget-data">
					<div class="widget-int num-count">Send Global Notification</div> 
					<div class="widget-title"><h4 id="err_msg" style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4></div>
					<div class="widget-subtitle" style="padding-right: 30px;">
						<form id="alertFormSubmit">
							<select class="form-control" name="userType">
								<option>Select target audience</option>
								<option value="userAll">User</option>
								<option value="panditAll">Pandit</option>
								<option value="vendAll">Vendor</option>
							</select>
							<br>
							<input type="text" class="form-control" name="heading" placeholder="Alert Heading">
							<br>
							<textarea class="form-control" name="message" placeholder="Alert Message"></textarea>
							<br>
							<center><button class="btn btn-success btn-sm" type="submit">Send Alert</button></center>
						</form>
						<script type="text/javascript">
							$("#alertFormSubmit").submit(function(e) {
					            e.preventDefault();
					            $.ajax({
					                url: '<?=base_url()?>index.php/site/globalAlertFormAction',
					                type: 'post',
					                data: $(this).serialize(),
					                dataType: 'json',
					                success: function(response) {
					                            if (response.status == true) {
					                                $(".preloader").hide();
							                  		$("#err_msg").html(response.html);
					                            }else{
					                                $("#err_msg").html(response.html);
					                            }
					                    }
					            });
					        });
						</script>
					</div>
				</div>
				
			</div>
			<!-- END WIDGET REGISTRED -->
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-4">
					<!-- START WIDGET SLIDER -->
					<div class="widget widget-default widget-carousel">
		                <div class="owl-carousel" id="owl-example">
		                    <div onclick="location.href='<?php echo site_url('site/product'); ?>';"> 
		                        <div class="widget-int"><?=$product->total?></div>
		                        <div class="widget-title">Product<small>s</small></div>
		                        <div class="widget-subtitle">In your <?=($auth_type == 'admin')?'Website':'Store'?></div>
		                    </div>
		                    <?php if($auth_type == 'admin'){ ?>
		                    <div onclick="location.href='<?php echo site_url('site/user'); ?>';">
		                        <div class="widget-int"><?=$user->total?></div>                                    
		                        <div class="widget-title">User'<small>s</small> Registred</div>
		                        <div class="widget-subtitle">On Your Website</div>
		                    </div>
		                    <?php } ?>
		                    <?php if($auth_type == 'admin'){ ?>
		                    <div onclick="location.href='<?php echo site_url('site/pandit'); ?>';">
		                        <div class="widget-int"><?=$pandit->total?></div>                                    
		                        <div class="widget-title">Pandit ji'<small>s</small> Registred</div>
		                        <div class="widget-subtitle">On Your Website</div>
		                    </div>
		                    <?php } ?>
		                </div>                            
		                <div class="widget-controls">                                
		                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
		                </div>                             
		            </div>
					<!-- END WIDGET SLIDER -->
				</div>
				<div class="col-md-4">
					<!-- START WIDGET SLIDER -->
					<div class="widget widget-default widget-carousel">
		                <div class="owl-carousel" id="owl-example">
		                    <div onclick="location.href='<?php echo site_url('site/vendor'); ?>';"> 
		                        <div class="widget-int"><?=$active_vendor->total?></div>
		                        <div class="widget-title">Active Vendor<small>s</small></div>
		                        <div class="widget-subtitle">On your <?=($auth_type == 'admin')?'Website':'Store'?></div>
		                    </div>
		                    <?php if($auth_type == 'admin'){ ?>
		                    <div onclick="location.href='<?php echo site_url('site/vendor'); ?>';">
		                        <div class="widget-int"><?=$inactive_vendor->total?></div>                                    
		                        <div class="widget-title">Inactive Vendor<small>s</small></div>
		                        <div class="widget-subtitle">On Your Website</div>
		                    </div>
		                    <?php } ?>
		                </div>                            
		                <div class="widget-controls">                                
		                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
		                </div>                             
		            </div>
					<!-- END WIDGET SLIDER -->
				</div>
				<div class="col-md-4">
					<!-- START WIDGET REGISTRED -->
					<div class="widget widget-default widget-item-icon">
						<div class="widget-item-left">
							<span class="fa fa-map-marker"></span>
						</div>
						<div class="widget-data">
							<div class="widget-int num-count"><?=$distance_range->distance_range?> <span style="font-size: 25px;">Kms</span></div> 
							<div class="widget-title">Pandit Request Range</div>
							<div class="widget-subtitle">
								<form id="formsubmit">
									<input type="number" name="distance_range">&nbsp;
									<button class="btn btn-success btn-xs" type="submit">Update</button>
								</form>
								<script type="text/javascript">
									$("#formsubmit").submit(function(e) {
							            e.preventDefault();
							            $.ajax({
							                url: '<?=base_url()?>index.php/site/updateRange',
							                type: 'post',
							                data: $(this).serialize(),
							                dataType: 'json',
							                success: function(response) {
							                            if (response.status == true) {
							                                $(".preloader").hide();
									                  		location.reload();
							                            }else{
							                                alert(response.message);
							                            }
							                    }
							            });
							        });
								</script>
							</div>
						</div>
						<div class="widget-controls">
							<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
						</div>
					</div>
					<!-- END WIDGET REGISTRED -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<!-- START WIDGET REGISTRED -->
					<div class="widget widget-default widget-item-icon" style="cursor:pointer;" onclick="location.href='<?php echo site_url('hr/active_employee_list'); ?>';">
						<div class="widget-item-left">
							<span class="fa fa-sitemap"></span>
						</div>
						<div class="widget-data">
							<div class="widget-int num-count"><?=$product_category->total?></div> 
							<div class="widget-title">Category</div>
							<div class="widget-subtitle">On your website</div>
						</div>
						<div class="widget-controls">
							<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
						</div>
					</div>
					<!-- END WIDGET REGISTRED -->
				</div>
				<div class="col-md-4">
					<!--START WIDGET MESSAGES -->
					<div class="widget widget-default widget-item-icon" style="cursor:pointer;"  onclick="location.href='<?php echo site_url('billing/client_list'); ?>';">
						<div class="widget-item-left">
							<span class="fa fa-shopping-cart"></span>
						</div>
						<div class="widget-data">
							<div class="widget-int num-count"><?=$product_sub_category->total?></div>
							<div class="widget-title">Pending Orders</div>
							<div class="widget-subtitle">On your website</div>
						</div>
						<div class="widget-controls">
							<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
						</div>
					</div>
					<!--END WIDGET MESSAGES -->
				</div>
				<div class="col-md-4">
				    	<div class="widget widget-default widget-item-icon">
						<div class="widget-item-left">
							<span class="fa fa-rupee"></span>
						</div>
						<div class="widget-data">
							<div class="widget-int num-count"><?=$commission->commision?> <span style="font-size: 25px;">%</span></div> 
							<div class="widget-title">Update Commission</div>
							<div class="widget-subtitle">
								<form id="formsubmit1">
									<input type="number" name="commision">&nbsp;
									<button class="btn btn-success btn-xs" type="submit">Update</button>
								</form>
								<script type="text/javascript">
									$("#formsubmit1").submit(function(e) {
							            e.preventDefault();
							            $.ajax({
							                url: '<?=base_url()?>index.php/site/updatecommission',
							                type: 'post',
							                data: $(this).serialize(),
							                dataType: 'json',
							                success: function(response) {
							                            if (response.status == true) {
							                                $(".preloader").hide();
									                  		location.reload();
							                            }else{
							                                alert(response.message);
							                            }
							                    }
							            });
							        });
								</script>
							</div>
						</div>
						<div class="widget-controls">
							<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-md-4">
					<!-- START WIDGET SLIDER -->
					<div class="widget widget-default widget-carousel">
		                <div class="owl-carousel" id="owl-example">
		                    <div onclick="location.href='<?php echo site_url('site/today_order'); ?>';"> 
		                        <div class="widget-int"><?=$order_today->total?></div>
		                        <div class="widget-title">Today<small>s</small> order Count</div>
		                        <div class="widget-subtitle">On your <?=($auth_type == 'admin')?'Website':'Store'?></div>
		                    </div>
		                </div>                            
		                <div class="widget-controls">                                
		                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
		                </div>                             
		            </div>
					<!-- END WIDGET SLIDER -->
				</div>
				<div class="col-md-4">
					<!-- START WIDGET SLIDER -->
					<div class="widget widget-default widget-carousel">
		                <div class="owl-carousel" id="owl-example">
		                    <div onclick="location.href='<?php echo site_url('site/today_booking'); ?>';">
		                        <div class="widget-int"><?=$booking_today->total?></div>                                    
		                        <div class="widget-title">Today<small>s</small> Pooja Booking Count</div>
		                        <div class="widget-subtitle">On Your Website</div>
		                    </div>
		                </div>                            
		                <div class="widget-controls">                                
		                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
		                </div>                             
		            </div>
					<!-- END WIDGET SLIDER -->
				</div>
		
	</div>
</div>
	<!-- END DASHBOARD CHART -->
</div>
<!-- END PAGE CONTENT WRAPPER -->