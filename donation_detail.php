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

<?php $id=$_GET['donation_id'];
$sql = "SELECT * FROM donation WHERE `donation_id`=$id ";
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
                    <div class="col-sm-6 col-md-4"> <img src="img/donation_1.png" alt="donation" class="img-rounded img-responsive" style="width: 77%;
    height: 220px;">
                       
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4><?php echo $row["donation_cause"]; ?></h4>
                        <p><b>Description : </b><?php echo $row["donation_discription"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
	
    <form class="well form-horizontal" action="confirm.php" method="post"  id="contact_form">
	
	<input type="hidden" name="user_id" value="<?php echo $row2["user_id"]; ?>">
	<input type="hidden" name="user_name" value="<?php echo $row2["username"]; ?>">
	<input type="hidden" name="product_name" value="<?php echo $row["name"]; ?>">
	<input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
	<input type="hidden" name="latitude" id="latitude" value="0.0">
	<input type="hidden" name="longitude" id="longitude" value="0.0">
	<input type="hidden" name="status" id="status" value="0">
	<input type="hidden" name="entry_date" id="amount" value="<?php echo $d; ?>">
	
<fieldset>
<legend><center><h2><b>Donation Form</b></h2></center></legend><br>
<div class="form-group">
  <label class="col-md-4 control-label">Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="userName" placeholder="Enter Name" class="form-control"  type="text" required="">
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Address</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input  name="address" placeholder="Address" class="form-control"  type="text" required="">
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
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Mobile Number</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="mobile" placeholder="Enter Mobile" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Email</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="email" placeholder="Enter Email" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Donation Amount</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
  <input name="amt" placeholder="Enter Amount" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Note</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
  <textarea name="note" placeholder="Enter Note..." class="form-control"  type="text" required=""></textarea>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">Payment Mode</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
		<select id="payment_mode" name="mode" class="form-control" style="height: 38px;" required="">
		 <option value="">---Select Payment Mode---</option>
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