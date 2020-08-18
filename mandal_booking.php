
<?php 
 include 'header.php';
include'config.php';
$id=$_REQUEST['mandal_id'];

		$sql = "Select * from mandal where mandal_id='$id'" ;
		$result = mysqli_query($conn,$sql);	
		// Numeric array
$row = mysqli_fetch_assoc($result);
//print_r($row); exit();
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
                        <h4><?php echo $row["mandali_name"]; ?></h4>
						
                        <p><b>Description : </b><?php if(!empty($row["description"])){ ?><?php echo $row["description"]; ?></p>
						<?php  } else echo 'no data found'; ?>
						<p><b>Price : </b> <?php echo $row["price"]; ?></p>
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
		$row1 = mysqli_fetch_assoc($result1); 
		$commission=$row1['commision'];
		}
		
		if(isset($_SESSION['mobile'])){
		 $mobile=$_SESSION['mobile'];
		$sql2 = "SELECT * from user where mobile=$mobile" ;
		$result2 = mysqli_query($conn,$sql2);
		if (mysqli_num_rows($result2) > 0) {
		$row2 = mysqli_fetch_assoc($result2);
		
		}
		
		date_default_timezone_set('Asia/Kolkata'); 
		$d= date("Y-m-d h:i:sa");
	?>
	<input type="hidden" name="user_id" value="<?php echo $row2["user_id"]; ?>">
	<input type="hidden" name="mandali_name" value="<?php echo $row["mandali_name"]; ?>">
	<input type="hidden" name="mandal_id" value="<?php echo $row["mandal_id"]; ?>">
	<input type="hidden" name="lattitude" id="lattitude" >
	<input type="hidden" name="longitude" id="longitude" >
	<input type="hidden" name="status" value="pending">
	<input type="hidden" name="table" value="mandal_booking">
	<input type="hidden" name="entry_date" id="entry_date" value="<?php echo $d; ?>">
	<input type="hidden" name="amount" value="<?php echo $g=$row["price"];?>">
	
	
<fieldset>
<legend><center><h2><b>Mandal Booking</b></h2></center></legend><br>

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
  <!--<input  name="address" placeholder="Enter Address" class="form-control"  type="text" required="">-->
  <div id="locationField">
      <input name="address" id="autocomplete" required="" class="form-control"
             placeholder="Enter your address"
             onFocus="geolocate()"
             type="text"/>
    </div>
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">City</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon">
  <i class="fa fa-map-marker"></i></span>
  <input  name="city" placeholder="City" class="form-control" id="locality" type="text" required="">
    </div>
  </div>
</div>

<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Pin Code</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group" id="address">
        <span class="input-group-addon">
		<i class="fa fa-map-marker"></i></span>
  <input name="pincode" placeholder="Enter pin Code" id="postal_code" class="form-control" type="number" required="" >
    </div>
  </div>
</div>

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
	  document.getElementById('lattitude').value = position.coords.latitude;
	  document.getElementById('longitude').value = position.coords.longitude;
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
  <label class="col-md-4 control-label" >date</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon">
  <i class="glyphicon glyphicon-calendar"></i>
  </span>
  <input name="date" placeholder="Date" class="form-control"  type="date" required="">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Time</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
  <input name="time" placeholder="Time" class="form-control"  type="time" required="">
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label">Payment Mode</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
		<select id="pay_type" name="payment" class="form-control" style="height: 38px;" required="">
		 <option value="">---Select Payment Mode---</option>
		  <option value="cash">Cash</option>
		  <option value="online">Online</option>
		</select>
    </div>
  </div>
</div>
		<?php }
		else{
			?>
			<script>
			window.location.href='index.php';
			</script>
			<?php
		}
?>
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