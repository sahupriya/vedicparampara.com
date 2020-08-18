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
elseif($_REQUEST['table']=="bhavya_ayojan"){
if(isset($_REQUEST['payment'])){
	if($_REQUEST['payment']=='cash'){
		$transection_id=substr(md5(date('Y-m-d')),-8);
		$_SESSION['transection_id']=$transection_id;
		$insert= "INSERT INTO bhavya_ayojan set ayojan_id='".$_REQUEST['ayojan_id']."',ayojan_name='".$_REQUEST['ayojan_name']."', user_id='".$_REQUEST['user_id']."', user_name='".$_REQUEST['user_name']."', date='".$_REQUEST['date']."', time='".$_REQUEST['time']."', amount='".$_REQUEST['amount']."',longitude='".$_REQUEST['longitude']."',lattitude='".$_REQUEST['lattitude']."',pincode='".$_REQUEST['pincode']."',entry_date='".$_REQUEST['entry_date']."',pay_type='".$_REQUEST['payment']."',status='".$_REQUEST['status']."', address='".addslashes($_REQUEST['address'])."', city='".addslashes($_REQUEST['city'])."',transection_id='".$transection_id."' ";
		// print_r($insert);exit();
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
	window.location.href="bhavya_ayojan.php";
	</script>
<?php
	}
}
}
elseif($_REQUEST['table']=="donation_detail"){
if(isset($_REQUEST['payment'])){
	if($_REQUEST['payment']=='online'){
		$transection_id=substr(md5(date('Y-m-d')),-8);
		$_SESSION['transection_id']=$transection_id;
		$insert= "INSERT INTO donationlisting set userId='".$_REQUEST['userId']."', userName='".$_REQUEST['userName']."', mobile='".$_REQUEST['mobile']."', email='".$_REQUEST['email']."', longitude='".$_REQUEST['longitude']."', lattitude='".$_REQUEST['lattitude']."',pincode='".$_REQUEST['pincode']."',cause='".$_REQUEST['cause']."',discription='".$_REQUEST['discription']."',amt='".$_REQUEST['amt']."',note='".$_REQUEST['note']."',mode='".$_REQUEST['payment']."',status='".$_REQUEST['status']."',entrydate='".$_REQUEST['entrydate']."',address='".addslashes($_REQUEST['address'])."',city='".addslashes($_REQUEST['city'])."',transection_id='".$transection_id."' ";
		$res=mysqli_query($conn,$insert);
		?>
	<script>
	//alert('online service is not available now')
	window.location.href="temple_donation.php";
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
	}elseif($_REQUEST['payment']=='online'){ ?>
	<script>
	alert('online service is not available now');
	window.location.href="index.php";
	</script>
<?php
	}
}
}


include 'footer.php'; ?>