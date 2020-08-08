<?php

include('assests/config.php');
error_reporting(0);

if (isset($_POST['signup'])) {
$fullname=$_POST['fname'];
$email=$_POST['email'];
$password=$_POST['Password'];

$hasedpassword=hash('sha256',$password);


//query for insertion
$sql="INSERT INTO adminlogin(FullName,Email,Password) VALUES (:fname,:uemail,:upassword)";
$query = $DB_con->prepare($sql);

// Binding Post Values
$query->bindParam(':fname',$fullname,PDO::PARAM_STR); 
$query->bindParam(':uemail',$email,PDO::PARAM_STR);
$query->bindParam(':upassword',$hasedpassword,PDO::PARAM_STR);



$query->execute();
$lastInsertId = $DB_con->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Account Create Successfuly !! Please login now..');
window.location.href='index.php';</script>";
}
else 
{
echo "<script>alert('Somthing Went Wrong..');</script>";
}

 
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assests/css/adminstyle.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" >

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

     <link href="https://fonts.googleapis.com/css?family=Patua+One&display=swap" rel="stylesheet">
 
      <script type="text/javascript">
function valid()
{
if(document.signup.Password.value!= document.signup.cpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.cpass.focus();
return false;
}
return true;
}
</script>
  

    <title>Admin Signup</title>
  </head>
  <body>
    <?php include('includes/header.php') ?>
    <section id="bg-1">
        <div class="overlay1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 mx-auto" id="logincard">
                        <div class="card" id="loginbox">
                              <div class="card-header">
                                
                                <h4 style="text-align: center ; font-family:Patua One ;">SIGNUP PANEL</h4>

                              </div>
                              <div class="card-body">
                                <form method="post" enctype="multipart/form-data" name="signup" onSubmit="return valid();">

                                    <div class="col-auto">
								      <label class="sr-only" for="inlineFormInputGroup">Full Name</label>
								      <div class="input-group mb-2">
								        <div class="input-group-prepend">
								          <div class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></div>
								        </div>
								        <input type="text" class="form-control" name="fname" id="inlineFormInputGroup" required placeholder="Full Name">
								      </div>
								    </div>
                                     
                                     <div class="col-auto">
								      <label class="sr-only" for="inlineFormInputGroup">Email</label>
								      <div class="input-group mb-2">
								        <div class="input-group-prepend">
								          <div class="input-group-text">@</div>
								        </div>
								        <input type="email" name="email" class="form-control" id="inlineFormInputGroup" required placeholder="Email">
								      </div>
								    </div>


                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Password</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></div>
                        </div>
                        <input type="password" class="form-control" name="Password" id="inlineFormInputGroup" required placeholder="Password">
                      </div>
                    </div>

                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Confirm Password</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></div>
                        </div>
                        <input type="password" class="form-control" name="cpass" id="inlineFormInputGroup" required placeholder="Confirm Password">
                      </div>
                    </div>
                        <div class="text-center ">
                     <button type="submit" name="signup" class="  btn btn-danger send-button">Register</button>
                  </div>
                                </form>
                              </div>
                              <div class="card-footer">
                                
                                <a href="index.php"><p style="text-align: center;">Already have acount login here</p></a>
                              </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="admin/assests/js/custom.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
