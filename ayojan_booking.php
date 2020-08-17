<?php 
include 'header.php';
include'config.php';
date_default_timezone_set('Asia/Kolkata'); 
/*
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
*/
 
$id=$_REQUEST['ayojan_id'];

		$sql = "Select * from ayojan where ayojan_id='$id'" ;
		$result = mysqli_query($conn,$sql);	
		// Numeric array
		while($row = mysqli_fetch_assoc($result)){
		?>
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
                        <h4><?php echo $row["ayojan_name"]; ?></h4>
						
                        <p><b>Description : </b><?php if(!empty($row["description"])){ ?><?php echo $row["description"]; ?></p>
						<?php  } else echo 'no data found'; ?>
						<p><b>Price : </b> <?php echo $row["price"]; ?></p>
						<p><b>Convenience Fee : </b> <?php echo $row["Convenience_Fee"]; ?></p>
						<p><b>GST % : </b> <?php echo $row["GST"]; ?> %</p>
						<p style="color:green;"><b>Total : </b> <?php  $g=$row["price"]*$row["GST"]/100; 
						echo $g+$row["price"]+$row["Convenience_Fee"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
	
    <form class="well form-horizontal" action="confirm.php" method="post" id="contact_form">
	<?php 
		$sql1 = "SELECT * from commission" ;
		$result1 = mysqli_query($conn,$sql1);
		if (mysqli_num_rows($result1) > 0) {
			$row1=$result1->fetch_assoc(); 
		$commission=$row1['commision'];
		}
		
		$mobile=$_SESSION['mobile'];
		$user_id='';
		$sql2 = "SELECT * from user where mobile=$mobile" ;
		$result2 = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result2) > 0) {
			while($row2=mysqli_fetch_assoc($result2)){
				$user_id=$row2['user_id'];
			}		
		}
		$d= date("Y-m-d h:i:sa"); 
	?>
	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
	<!--<input type="hidden" name="mandali_name" value="<?php echo $row["mandali_name"]; ?>">-->
	<input type="hidden" name="mandal_id" value="<?php echo $row["ayojan_id"]; ?>">
	<input type="hidden" name="amount" value="<?php  $g=$row["price"]*$row["GST"]/100; 
						echo $g+$row["price"]+$row["Convenience_Fee"]; ?>">
	<input type="hidden" name="status" value="pending">
	<input type="hidden" name="table" value="bhavya_ayojan">
	
	
<fieldset>
<legend><center><h2><b>Ayojan Booking</b></h2></center></legend><br>

<input type="hidden" name="latitude" id="clockin_lati1">
<input type="hidden" name="longitude" id="clockin_long1">

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(26.4499, 80.3319),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
				document.getElementById("clockin_lati1").value=e.latLng.lat();
				document.getElementById("clockin_long1").value=e.latLng.lng();
                // alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
            });
        }
    </script>
	
    <div id="dvMap" style="width: 100%; height: 300px"></div>
<div class="form-group">
  <label class="col-md-4 control-label">Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="user_name" placeholder="Enter Name" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">Address</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon">
  <i class="fa fa-map-marker"></i>
  </span>
  <input  name="address" placeholder="Enter Address" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">City</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon">
  <i class="fa fa-map-marker"></i></span>
  <input  name="city" placeholder="City" class="form-control"  type="text" required="">
    </div>
  </div>
</div>

<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Pin Code</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon">
		<i class="fa fa-map-marker"></i></span>
  <input name="pincode" placeholder="(639)" class="form-control" type="number" required="" >
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" >date</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon">
  <i class="glyphicon glyphicon-calendar"></i>
  </span>
  <input name="date" placeholder="Date" class="form-control"  type="state" required="">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Time</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
  <input name="time" placeholder="Time" class="form-control"  type="text" required="">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">Payment Mode</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
		<select id="pay_type" name="payment" class="form-control" required="">
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
<?php
		}
?>
    </div><!-- /.container -->
<?php include 'footer.php';?>