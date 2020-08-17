<?php include 'header.php';?>
<?php 
include'config.php';
if(isset($_POST['submit']))
{
	$name=$_POST['username'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$otp = rand(1000,9999);
	$insert= "INSERT INTO user (username,mobile,email,logitude,lattitude,password,otp,otp_verified,type,status,approved) VALUES ('$name','$mobile','$email',0.0,0.0,
	'$password','$otp',0,'USER',1,1)";
	mysqli_query($conn,$insert);
	?>
	<script>
	swal('your message send successfully');
	</script>
<?php	
}
?>

<?php $id=$_GET['id'];
		$sql = "SELECT `p`.*, `c`.`category_name`, `v`.`name` as 'vendor_name', `v`.`id` as 'vendor_id' FROM `product` `p` LEFT JOIN `category` `c` ON `c`.`category_id`=`p`.`category_id` LEFT JOIN `vender` `v` ON `v`.`id` =`p`.`vendorId` WHERE `p`.`product_id`=$id " ;

		$result = mysqli_query($conn,$sql);
		
		if (mysqli_num_rows($result) > 0) {$row=$result->fetch_assoc();}
			?>
		<style>
		.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo $base_url."/panel/".$row["image"] ?>" alt="" class="img-rounded img-responsive" style="width: 77%;
    height: 220px;"/>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4><?php echo $row["name"]; ?></h4>
                        <small><cite title="San Francisco, USA">
						Price : <?php echo $row["price"]; ?> </cite></small>
                        <p>
                            Gst % : <?php echo $row["gst_no"]; ?> %
                            <br />
                            Delivery Charge : <?php echo $row["delivery_charge"]; ?>
                            <br />
                            Quentity : <?php echo $row["qty"]; ?><?php echo $row["qty_type"]; ?>
						</p>
                        <p><b>Description : </b><?php echo $row["description"]; ?></p>
						<p><b>Total : </b><?php 
						 $gst=$row["price"]*$row["gst_no"]/100;
						echo $amount=$row["price"]+$gst+$row["delivery_charge"]; ?></p>
						<p>1</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
	
    <form class="well form-horizontal" action="confirm.php" method="post"  id="contact_form">
	<?php 
		$sql1 = "SELECT * from commission" ;
		$result1 = mysqli_query($conn,$sql1);
		if (mysqli_num_rows($result1) > 0) {
			$row1=$result1->fetch_assoc(); 
		$commission=$row1['commision'];
		}
		
		$mobile=$_SESSION['mobile'];
		$sql2 = "SELECT * from user where mobile=$mobile" ;
		$result2 = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result2) > 0) {
			$row2=$result2->fetch_assoc(); 
		
		}
		
		date_default_timezone_set('Asia/Kolkata'); 
		$d= date("Y-m-d h:i:sa"); 
	?>
	<input type="hidden" name="user_id" value="<?php echo $row2["user_id"]; ?>">
	<input type="hidden" name="vendorId" value="<?php echo $row["vendorId"]; ?>">
	<input type="hidden" name="user_name" value="<?php echo $row2["username"]; ?>">
	<input type="hidden" name="category_id" value="<?php echo $row["category_id"]; ?>">
	<input type="hidden" name="category_name" value="<?php echo $row["category_name"]; ?>">
	<input type="hidden" name="product_name" value="<?php echo $row["name"]; ?>">
	<input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
	<input type="hidden" name="latitude" id="latitude" value="0.0">
	<input type="hidden" name="longitude" id="longitude" value="0.0">
	<input type="hidden" name="status" id="status" value="0">
	
	
	<input type="hidden" name="admin_amount" id="admin_amount" value="<?php echo $admin_amount=$amount*$commission/100; ?>">
	<input type="hidden" name="amount" id="amount" value="<?php echo $amount-$admin_amount; ?>">
	<input type="hidden" name="quantity" id="quantity" value="1">
	<input type="hidden" name="entry_date" id="amount" value="<?php echo $d; ?>">
	
<fieldset>
<legend><center><h2><b>Order Product</b></h2></center></legend><br>
<div class="form-group">
  <label class="col-md-4 control-label">Address</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input  name="address" placeholder="Address" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" >State</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input name="state" placeholder="state" class="form-control"  type="state" required="">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >City</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input name="city" placeholder="City" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Pin Code</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input name="pincode" placeholder="(639)" class="form-control" type="number" required="" >
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">Payment Mode</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
		<select id="payment_mode" name="payment" class="form-control" style="height: 38px;" required="">
		 <option value="">---Select Payment Mode---</option>
		  <option value="cash">Cash</option>
		  <option value="online">Online</option>
		</select>
    </div>
  </div>
</div>

<!-- Select Basic -->

<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" name="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
<?php include 'footer.php';?>