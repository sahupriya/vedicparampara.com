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
	if($query){
		
	$to = $email;
    $from = "neetusingh1995dec@gmail.com";
    $subject = "Thank Your for taking interest";
    //begin of HTML message
    $message = "Thank you for taking interest. One of our executive will contact you soon! <br>
    Thanks & Regards,<br>
    vedicparampara.com ";

   //end of message
    $headers  = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n";

    
    // now lets send the email.
    $message1 = "<html>
<body>
<table border='1' style='  border-collapse: collapse;'>
<tr>
<td>Name</td><td> ".$name."</td>
</tr>
<tr>
<td>Email Id</td><td>".$email."</td>
</tr>
<tr>
<td>Message</td><td>".$message."</td>
</tr>
</table>

</body>
</html>";
    if(mail($to, $subject, $message, $headers)){
        mail("neetsingh0612@gmail.com", "New Enquiry", $message1, $headers);
?>
    <script>
        alert("Message sent!");
    </script>
<?php
    }else{
     ?>
    <script>
        alert("Unable to send message!");
    </script>
<?php   
    }
    
}

	}
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