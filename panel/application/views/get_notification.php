<script>
$("#notify_count").html('<?=$count?>');
$("#notify_count2").html('<?php echo $count." New";?>');
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
<?php
foreach($notification as $n)
{
?>
<div style="min-height: 75px;">
    <a href="#" onclick="seen_notification('<?=$n->link?>','<?=$n->notification_id?>');" class="list-group-item" style="<?=$n->seen?'':'background-color: #c4ede7;'?>">
        <div class="list-group-status status-online"></div>
        <img style="height:45px;" src="<?php echo site_url($n->notify_by_image); ?>" class="pull-left" alt="User"/>
        <span class="contacts-title" id="notify_by"><?=$n->notify_by_name?></span>
        <small><?=$n->entrydt?></small>
        <p id="notify_msg" style="padding-left:70px;"><?=$n->message?></p>
    </a>
</div>
<?php
}
?>