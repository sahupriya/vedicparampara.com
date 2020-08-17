<?php include 'header.php';?>
<?php 
include'config.php';

if($_REQUEST['table']=="product_order"){
	
if(isset($_REQUEST['payment'])){
	if($_REQUEST['payment']=='cash'){
		$transection_id=substr(md5(date('Y-m-d')),-8);
		$_SESSION['transection_id']=$transection_id;
		$insert= "INSERT INTO orders set user_id='".$_REQUEST['user_id']."', vendorId='".$_REQUEST['vendorId']."',user_name='".$_REQUEST['user_name']."', category_id='".$_REQUEST['category_id']."', category_name='".$_REQUEST['category_name']."', product_name='".$_REQUEST['product_name']."', product_id='".$_REQUEST['product_id']."', latitude='".$_REQUEST['latitude']."',longitude='".$_REQUEST['longitude']."',status='".$_REQUEST['status']."',admin_amount='".$_REQUEST['admin_amount']."',amount='".$_REQUEST['amount']."',quantity='".$_REQUEST['quantity']."',entry_date='".$_REQUEST['entry_date']."',payment_mode='".$_REQUEST['payment']."',pincode='".$_REQUEST['pincode']."',user_rating='0',vender_rating='0',vendor_feedback='',user_feedback='', address='".addslashes($_REQUEST['address'])."',state='".addslashes($_REQUEST['state'])."', city='".addslashes($_REQUEST['city'])."',transection_id='".$transection_id."' ";
		// print_r($insert);
		$res=mysqli_query($conn,$insert);
		if($res){
	?>
	<script>
	window.location.href="thank.php";
	</script>
<?php
		}else{
	?>
	<script>
	window.location.href="error.php";
	</script>
<?php		
		}
?>

<?php
	}elseif($_REQUEST['payment']=='online'){?>
	<script>
	alert('online service is not available now')
	window.location.href="index.php";
	</script>
<?php
	}
}
}
elseif($_REQUEST['table']=="bhavya_ayojna"){
if(isset($_REQUEST['payment'])){
	if($_REQUEST['payment']=='cash'){
		$transection_id=substr(md5(date('Y-m-d')),-8);
		$_SESSION['transection_id']=$transection_id;
		$insert= "INSERT INTO orders set user_id='".$_REQUEST['user_id']."', vendorId='".$_REQUEST['vendorId']."',user_name='".$_REQUEST['user_name']."', category_id='".$_REQUEST['category_id']."', category_name='".$_REQUEST['category_name']."', product_name='".$_REQUEST['product_name']."', product_id='".$_REQUEST['product_id']."', latitude='".$_REQUEST['latitude']."',longitude='".$_REQUEST['longitude']."',status='".$_REQUEST['status']."',admin_amount='".$_REQUEST['admin_amount']."',amount='".$_REQUEST['amount']."',quantity='".$_REQUEST['quantity']."',entry_date='".$_REQUEST['entry_date']."',payment_mode='".$_REQUEST['payment']."',pincode='".$_REQUEST['pincode']."',user_rating='0',vender_rating='0',vendor_feedback='',user_feedback='', address='".addslashes($_REQUEST['address'])."',state='".addslashes($_REQUEST['state'])."', city='".addslashes($_REQUEST['city'])."',transection_id='".$transection_id."' ";
		// print_r($insert);
		$res=mysqli_query($conn,$insert);
		if($res){
	?>
	<script>
	window.location.href="thank.php";
	</script>
<?php
		}else{
	?>
	<script>
	window.location.href="error.php";
	</script>
<?php		
		}
?>

<?php
	}elseif($_REQUEST['payment']=='online'){?>
	<script>
	alert('online service is not available now')
	window.location.href="index.php";
	</script>
<?php
	}
}
}
elseif($_REQUEST['table']=="mandal_booking"){
if(isset($_REQUEST['payment'])){
	if($_REQUEST['payment']=='cash'){
		$transection_id=substr(md5(date('Y-m-d')),-8);
		$_SESSION['transection_id']=$transection_id;
		$insert= "INSERT INTO  mandal_booked set mandal_id='".$_REQUEST['mandal_id']."',mandali_name='".$_REQUEST['mandali_name']."', user_id='".$_REQUEST['user_id']."', user_name='".$_REQUEST['user_name']."',date='".$_REQUEST['date']."',time='".$_REQUEST['time']."', latitude='".$_REQUEST['latitude']."',longitude='".$_REQUEST['longitude']."',status='".$_REQUEST['status']."',amount='".$_REQUEST['amount']."',quantity='".$_REQUEST['quantity']."',payment_mode='".$_REQUEST['payment']."',pincode='".$_REQUEST['pincode']."',user_rating='0',vender_rating='0',vendor_feedback='',user_feedback='', address='".addslashes($_REQUEST['address'])."',state='".addslashes($_REQUEST['state'])."', city='".addslashes($_REQUEST['city'])."',transection_id='".$transection_id."' ";
		// print_r($insert);
		$res=mysqli_query($conn,$insert);
		if($res){
	?>
	<script>
	window.location.href="thank.php";
	</script>
<?php
		}else{
	?>
	<script>
	window.location.href="error.php";
	</script>
<?php		
		}
?>

<?php
	}else($_REQUEST['payment']=='online'){?>
	<script>
	alert('online service is not available now')
	window.location.href="index.php";
	</script>
<?php
	}
}
}

include 'footer.php';?>