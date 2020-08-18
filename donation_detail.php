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
	<?php 
		
		$mobile=$_SESSION['mobile'];
		$sql2 = "SELECT * from user where mobile=$mobile" ;
		$result2 = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result2) > 0) {
			$row2=$result2->fetch_assoc(); 
		
		}
		
		date_default_timezone_set('Asia/Kolkata'); 
		$d= date("Y-m-d h:i:s"); 
	?>
	<input type="hidden" name="userId" value="<?php echo $row2["user_id"]; ?>">
	<input type="hidden" name="lattitude" id="latitude" value="0.0">
	<input type="hidden" name="longitude" id="longitude" value="0.0">
	<input type="hidden" name="cause" id="cause" value="<?php echo $row["donation_id"]; ?>">
	<input type="hidden" name="discription" id="discription" value="<?php echo $row["donation_discription"]; ?>">
	<input type="hidden" name="status" id="status" value="1">
	<input type="hidden" name="entrydate" id="entry_date" value="<?php echo $d; ?>">
	<input type="hidden" name="table" value="donation_detail">
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
  <!--<input  name="address" placeholder="Address" class="form-control"  type="text" required="">-->
  <div id="locationField">
      <input name="address" id="autocomplete" required="" class="form-control"
             placeholder="Enter your address"
             onFocus="geolocate()"
             type="text"/>
    </div>
    </div>
  </div>
</div>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >City</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input name="city" placeholder="City" class="form-control" id="locality" type="text" required="">
    </div>
  </div>
</div>
<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Pin Code</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group" id="address">
        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input name="pincode" placeholder="Enter pin Code" class="form-control" id="postal_code" type="number" required="" >
    </div>
  </div>
</div>
<!-- Text input-->

<script>
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
  //street_number: 'short_name',
  //route: 'long_name',
  locality: 'long_name',
  //administrative_area_level_1: 'short_name',
  //country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmAXRrafA3bpxoKPBPqtFzNwpabkUsWrs&libraries=places&callback=initAutocomplete"
        defer></script>
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
		<select id="payment" name="payment" class="form-control" style="height: 38px;" required="">
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