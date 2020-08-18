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
}

.dec-btn {
    border: none;
    border-radius: 8px 0 0 8px;
    background: #28a745;
    color: #fff;
    border-radius: 2px!important;
    font-size: 23px;
    height: 33px;
    line-height: 15px;
    padding: 0;
    text-align: center!important;
    vertical-align: baseline;
    width: 27px;
}
.value-button {
    display: inline-block;
    border: 1px solid #ddd;
    margin: 0;   
    text-align: center;
    vertical-align: middle;
    padding: 11px 0;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 36px;
}
.inc-btn {
    border: none;
    border-radius: 0 8px 8px 0;
    background: #dc3545;
    color: #fff;
    border-radius: 2px!important;
    font-size: 23px;
    height: 33px;
    line-height: 15px;
    padding: 0;
    text-align: center!important;
    vertical-align: baseline;
    width: 27px;
}
#number {
    width: 50px;
    flex: unset;
}
</style>

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
                        <p><b>Price : </b><?php echo $row["price"]; ?> Rs.</p>
                        <p>
                            Gst % : <?php echo $row["gst_no"]; ?> %
                            <br />
                            Delivery Charge : <?php echo $row["delivery_charge"]; ?> Rs.
                            <br />
                            Quentity : <?php echo $row["qty"]; ?><?php echo $row["qty_type"]; ?>
						</p>
                        <p><b>Description : </b><?php echo $row["description"]; ?></p>
						<p style="color:green;"><b>Total Price: </b><?php 
						 $gst=$row["price"]*$row["gst_no"]/100;
						echo $amount=$row["price"]+$gst+$row["delivery_charge"]; ?> Rs.</p>
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
		$d= date("Y-m-d h:i:s"); 
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
	<input type="hidden" name="table" value="product_order">
	<input type="hidden" name="admin_amount" id="admin_amount" value="<?php echo $admin_amount=$amount*$commission/100; ?>">
	<input type="hidden" name="amount" id="amount" value="<?php echo $amount-$admin_amount; ?>">
	<input type="hidden" name="entry_date" id="amount" value="<?php echo $d; ?>">
	
<fieldset>
<legend><center><h2><b>Order Product</b></h2></center></legend><br>
<div class="input-group mb-2" align="center">
<label class="col-md-4 control-label">Quantity</label>  
  <div class="col-md-4 inputGroupContainer">
	<div class="value-button increase inc-btn" style="line-height: 34px;" id="decrease" onclick="decrease()" pid="<?php echo $row['product_id']; ?>" value="Decrease Value">-</div>
		<input type="number" id="number"  name="quantity" pid="<?php echo $row['product_id']; ?>" value="1" size="2" max="<?php echo $row['qty']; ?>" class="form-control qun" style="float:initial;" />
	<div class="value-button decrease dec-btn" id="increase" onclick="increase()" pid="<?php echo $row['product_id']; ?>" value="Increase Value">+</div>
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Address</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
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
  <label class="col-md-4 control-label" >State</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
  <input name="state" placeholder="state" class="form-control" id="administrative_area_level_1" type="text" required="">

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
  <input name="pincode" placeholder="Enter pin Code" class="form-control" type="number" id="postal_code" required="" >
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
  administrative_area_level_1: 'short_name',
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/cart.js"></script>


