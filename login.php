<?php 
include 'header.php';
include 'config.php';
//if($_GET){$id=$_GET['id'];}else{ }


if(isset($_SESSION['mobile']) && $_GET['id']){
	$id=$_GET['id'];
echo '<script>window.location.href="product_order.php?id='.$id.'";</script>';
}else if(isset($_SESSION['mobile']) && $_GET['mandal_id']){
	$id=$_GET['mandal_id'];
echo '<script>window.location.href="mandal_booking.php?mandal_id='.$id.'";</script>';
}else if(isset($_SESSION['mobile']) && $_GET['ayojan_id']){
	$id=$_GET['ayojan_id'];
echo '<script>window.location.href="ayojan_booking.php?ayojan_id='.$id.'";</script>';
}else if(isset($_SESSION['mobile']) && $_GET['donation_id']){
	$id=$_GET['donation_id'];
echo '<script>window.location.href="donation_detail.php?donation_id='.$id.'";</script>';
}
if(isset($_POST['submit']))
{

$email 		= $_POST['mobile'];
$password	= $_POST['password'];
$sql="SELECT * from user where mobile='".$email."' and password='".$password."' and otp_verified=1";
$result = $conn->query($sql);
// echo $sql;
$row=mysqli_num_rows($result);
if ($row>0) {
	$_SESSION["mobile"] = $email;
	// var_dump($_SESSION);
	//echo '<script>window.location.href="product_order.php?id='.$id.'";</script>';
	if(isset($_SESSION['mobile']) && $_GET['id']){
	$id=$_GET['id'];
echo '<script>window.location.href="product_order.php?id='.$id.'";</script>';
}else if(isset($_SESSION['mobile']) && $_GET['mandal_id']){
	$id=$_GET['mandal_id'];
echo '<script>window.location.href="mandal_booking.php?mandal_id='.$id.'";</script>';
}else if(isset($_SESSION['mobile']) && $_GET['ayojan_id']){
	$id=$_GET['ayojan_id'];
echo '<script>window.location.href="ayojan_booking.php?ayojan_id='.$id.'";</script>';
}else if(isset($_SESSION['mobile']) && $_GET['donation_id']){
	$id=$_GET['donation_id'];
echo '<script>window.location.href="donation_detail.php?donation_id='.$id.'";</script>';
}
} else {
    echo "<span style='text-align:center; color:red;'>Invalid  mobile or password</span>";
}

$conn->close();
}

//session_destroy();
 ?>
<div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>User Login </b></h2></center></legend><br>
  <div class="form-group">
  <label class="col-md-4 control-label">Mobile</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="mobile" placeholder="Mobile Number" class="form-control"  type="number">
    </div>
  </div>
</div>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Password</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="password" placeholder="Password" class="form-control"  type="password">
    </div>
  </div>
</div>

<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4 text-center"><br>
    <!--<button type="submit" class="btn btn-warning" >
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLogin <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	</button>-->
	<input type="submit" value="LOG IN" name="submit" class="btn btn-warning">
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
<?php include 'footer.php';?>