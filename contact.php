<?php include 'header.php';?>
<?php 
include'config.php';
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	$insert= "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
	$qyery=mysqli_query($conn,$insert);
	?>
	<script>
	alert('your message send successfully');
	</script>
<?php	
}
?>


<div class="smoke">
    <div class="container" id="fh5co-contact">
        <div class="heading animate-box"><h2><b>CONTACT US</b></h2></div>
        <div class="text-center animate-box"><h3>We will contact soon</h3></div>
        <div class="row animate-box">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Name</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Email</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Message</label>
                        <textarea class="form-control" rows="5" placeholder="Msg Here" name="message"></textarea>
                    </div>
					<input type="submit" class="btn btn-success" value="Send" name="submit">
                   
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';?>