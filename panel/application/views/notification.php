<script>
$( document ).ready(function() {
    $(".datepicker").datepicker({
        format : 'yyyy-mm-dd',
        autoclose : true,
});   
</script>

<script>
function seen_notification(url,notification_id)
{
    window.location.href = url;
    $.ajax({
		type:"post",
		url:"<?php echo site_url('site/seen_notification');?>",
		data:"notification_id="+notification_id,
		success:function(data)
		{
		    $("#notify_li").show();
			$("#notify_li").html(data);
		}
	});
}
</script>

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li><a href="#"> View All Notification</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Notification</strong> List</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div id="table_div">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body list-group list-group-contacts" id="notification_list">
                                    <?php
                                    $i = 0;
                                    foreach($notification as $n)
                                    {
                                        $i++;
                                    ?>
                                    <div style="min-height: 75px;<?=$n->seen?'':'background-color: #c4ede7;'?>">
                                        <a href="#" onclick="seen_notification('<?=$n->link?>','<?=$n->notification_id?>');" class="list-group-item" style="<?=$n->seen?'':'background-color: #c4ede7;'?>">
                                            <div class="list-group-status status-online"></div>
                                            <img src="<?php echo site_url($n->notify_by_image); ?>" class="pull-left" style="height:50px;" alt="User"/>
                                            <span class="contacts-title" id="notify_by_user<?=$i?>"><?=$n->notify_by_name?></span>&nbsp;&nbsp;&nbsp;<span><small><?php echo $n->entrydt; ?></small></span>
                                            <p id="notify_msg<?=$i?>"><?=$n->message?></p>
                                        </a><br/>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- END panel-body -->
            </div> <!-- END panel panel-default -->
        <!-- end default -->
        </div> <!-- END col-md-6 -->
    </div> <!-- END row -->
</div> <!-- END page-content-wrap -->
<!-- END PAGE CONTENT WRAPPER -->      

    
<!-- Modal -->