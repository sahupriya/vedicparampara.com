<?php
$auth_type = $this->session->userdata('auth_type');
$auth_id = $this->session->userdata('auth_id');
?>
<script>
$(document).ready(function()
{
    get_notification();
    setInterval(function(){
        get_notification();
    },5000);
    
    var actv_pge = "<?php echo $this->uri->segment(2); ?>";
    if(actv_pge != 'dashboard' && actv_pge != 'user' && actv_pge != 'doctor' && actv_pge != 'category' && actv_pge != 'sub_category')
    {
        // the clicked LI
        var clicked = $("#"+actv_pge);
        // all the LIs above the clicked one
      	var previousAll = clicked.prevAll();
      	// only proceed if it's not already on top (no previous siblings)
      	if(previousAll.length > 0) {
      		// top LI
      		var top = $(previousAll[previousAll.length - 1]);
            // immediately previous LI
            var previous = $(previousAll[0]);
            // how far up do we need to move the clicked LI?
            var moveUp = clicked.attr('offsetTop') - top.attr('offsetTop');
            // how far down do we need to move the previous siblings?
            var moveDown = (clicked.offset().top + clicked.outerHeight()) - (previous.offset().top + previous.outerHeight());
            // let's move stuff
            clicked.css('position', 'relative');
            previousAll.css('position', 'relative');
            clicked.animate({'top': -moveUp});
            previousAll.animate({'top': moveDown}, {complete: function() {
                // rearrange the DOM and restore positioning when we're done moving
                clicked.parent().prepend(clicked);
                clicked.css({'position': 'static', 'top': 0});
                previousAll.css({'position': 'static', 'top': 0}); 
            }});
        }
    }
});

function get_notification()
{
    $.ajax({
        type:"post",
        url:"<?php echo site_url('site/get_notification');?>",
        data:"seen=0",
        success:function(data)
        {
            $("#notify_icon").show();
            $("#notify_li").html(data);
        }
    });
}
</script>
<!-- START PAGE CONTAINER -->
<div class="page-container">
	<!-- START PAGE SIDEBAR -->
	<div class="page-sidebar">
		<!-- START X-NAVIGATION -->
		<ul class="x-navigation">
			<li class="xn-logo">
				<a href="<?php echo site_url('site/dashboard'); ?>" style="font-size: 20px;"> <?=$_SESSION['company']?></a>
				<a href="#" class="x-navigation-control"></a>
			</li>
			<li class="xn-profile">
				<a href="#" class="profile-mini">
					<img src="<?=$this->session->userdata('auth_image')?>" alt="<?=$_SESSION['company']?>" style="height:80px;"/>
				</a>
				<div class="profile">
					<div class="profile-image">
					    <img src="<?=$this->session->userdata('auth_image')?>" alt="<?=$_SESSION['company']?>" style="border:none;"/>
					</div>
				    <div class="profile-data">
						<div class="profile-data-name"><?=$this->session->userdata('auth_name')?><i></i></div>
					</div>
					<!--<div class="profile-controls">-->
					<!--	<a href="#" class="profile-control-left"><span class="fa fa-info"></span></a>-->
					<!--	<a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>-->
					<!--</div>-->
				</div>
			</li>
			
			<!--For Dashboard-->
			<li id="dashboard">
				<a href="<?php echo site_url('site/dashboard'); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
			</li>
			<li id="add_user">
				<a href="<?php echo site_url('site/user'); ?>"><span class="fa fa-users"></span> <span class="xn-text">User</span></a>
			</li>
			<li id="add_vendor">
				<a href="<?php echo site_url('site/vendor'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Vendor</span></a>
			</li>
			<li id="add_pandit">
				<a href="<?php echo site_url('site/pandit'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Pandit</span></a>
			</li>
			<li id="master">
				<a href="<?php echo site_url('site/slider'); ?>"><span class="fa fa-sitemap"></span> <span class="xn-text">App Slider</span></a>
			</li>
			
			
			<!-------->
			
			<li><a><span class="fa fa-sitemap"></span> E-Commerce <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu"> 
                                <li id="category">
                    				<a href="<?php echo site_url('site/category'); ?>"><span class="fa fa-sitemap"></span> <span class="xn-text">Add Category</span></a>
                    			</li>
                    			<li id="add_product">
                    				<a href="<?php echo site_url('site/product'); ?>"><span class="fa fa-shopping-cart"></span> <span class="xn-text">Add Product</span></a>
                    			</li>
                    			<li id="orders">
                    				<a href="<?php echo site_url('site/orders'); ?>"><span class="fa fa-shopping-cart"></span> <span class="xn-text">Orders</span></a>
                    			</li>
                            </ul>
            </li>
            <li><a><span class="fa fa-sitemap"></span> Daily Pandit <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu"> 
                                <li id="dailypandit">
                    				<a href="<?php echo site_url('site/dailypandit'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Add</span></a>
                    			</li>
                    			<li id="dailypandit_sub">
                    				<a href="<?php echo site_url('site/dailypandit_subscription'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Subscribion Detail</span></a>
                    			</li>
                    			<li id="dailypandit_booking">
                    				<a href="<?php echo site_url('site/dailypandit_booking'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Dailypandit Bookings</span></a>
                    			</li>
                        </ul>
            </li>
            <li><a><span class="fa fa-sitemap"></span> Pooja <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu"> 
                                <li id="add_pooja">
                    				<a href="<?php echo site_url('site/pooja'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Add </span></a>
                    			</li>
                    			
                    			<li id="booking">
                    				<a href="<?php echo site_url('site/booking'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Booking list</span></a>
                    			</li>
                        </ul>
            </li>
            <li><a><span class="fa fa-sitemap"></span> Bhavya Ayojan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu"> 
                                <li id="ayojan">
                    				<a href="<?php echo site_url('site/ayojan'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Add Ayojan</span></a>
                    			</li>
                    			<li id="ayojan_booking">
                    				<a href="<?php echo site_url('site/ayojan_booking'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Booking list</span></a>
                    			</li>
                        </ul>
            </li>
            <li><a><span class="fa fa-sitemap"></span> Bhajan Mandal <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu"> 
                    			<li id="mandal">
                    				<a href="<?php echo site_url('site/mandal'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Add Mandal</span></a>
                    			</li>
                    			<li id="mandal_booking">
                    				<a href="<?php echo site_url('site/mandal_booking'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Booking list</span></a>
                    			</li>
                        </ul>
            </li>
            <li><a><span class="fa fa-sitemap"></span> Virtual Service <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu"> 
                    			<li id="virtualservice">
                    				<a href="<?php echo site_url('site/virtualservice'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Virtual Service</span></a>
                    			</li>
                    			<li id="virtualservice_request">
                    				<a href="<?php echo site_url('site/virtualservice_request'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Virtual Service Request</span></a>
                    			</li>
                        </ul>
            </li>
			<!-------->
			
			
			
			
			
			
			<li id="donation">
				<a href="<?php echo site_url('site/donation'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Donation</span></a>
			</li>
			<li id="donation-list">
				<a href="<?php echo site_url('site/donationlist'); ?>"><span class="fa fa-book"></span> <span class="xn-text">Donations Listing</span></a>
			</li>
			<li id="enqueries">
				<a href="<?php echo site_url('site/enqueries'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Enqueries</span></a>
			</li>
			<li id="terms">
				<a href="<?php echo site_url('site/terms'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Terms and Conditions</span></a>
			</li>
            <li id="privacy_policy">
				<a href="<?php echo site_url('site/privacy_policy'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Privacy and Policy</span></a>
			</li>
			
			
			</ul>
			<!--<li id="sub_category">-->
			<!--	<a href="<?php echo site_url('site/sub_category'); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Add Sub Category</span></a>-->
			<!--</li>-->
			
		</ul>
		<!-- END X-NAVIGATION -->
	</div>
	<!-- END PAGE SIDEBAR -->
	
	<!-- PAGE CONTENT -->
	<div class="page-content">
		<!-- START X-NAVIGATION VERTICAL -->
		<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
			<!-- TOGGLE NAVIGATION -->
			<li class="xn-icon-button">
				<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
			</li>
			<!-- END TOGGLE NAVIGATION -->
			
			<!-- SEARCH -->
			<li class="xn-search">
				<form role="form">
					<input type="text" id="search_bar" name="search_bar" onkeyup="get_search_data(this.value);" placeholder="Search  for  pages . . ."/>
					<div id="search_div">
						<ul id="list" style="background: rgb(31, 31, 31); display: block;">
						</ul>
					</div>
				</form>
			</li>
			<!-- END SEARCH -->
			
			
			<!-- SIGN OUT -->
			<li class="xn-icon-button pull-right">
				<a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
			</li>
			<!-- END SIGN OUT -->
			<!-- NOTIFICATION -->
			<!--onclick="get_notification('');"-->
            <li class="xn-icon-button pull-right" id="notify_icon">
                <a href="#"><span class="fa fa-bell"></span></a>
                <div class="informer informer-danger" id="notify_count"></div>
                <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-bell"></span> Notification</h3>                                
                        <div class="pull-right">
                            <span class="label label-danger" id="notify_count2">0 New</span>
                        </div>
                    </div>
                    <div class="panel-body list-group list-group-contacts scroll"  style="height: 291px;">
                        <div id="notify_li" >
                            
                        </div>
                    </div>     
                    <div class="panel-footer text-center">
                        <a href="<?=site_url('site/notification')?>">Show all Notification</a>
                    </div>                            
                </div>                        
            </li>
            <!-- END NOTIFICATION -->
		</ul>
		<!-- END X-NAVIGATION VERTICAL -->
		<div id="header_loader_div" class="panel-refresh-layer" style="width:1109px;height:800px;display:none;"><img src="<?php echo base_url(); ?>/img/loaders/default.gif"></div>