<?php
session_start();

error_reporting(0);
include('assests/config.php');

  if(isset($_POST['login']))
  {

//Genrating random number for salt
if(@$_SESSION['randnmbr']==""){
   
        $Alpha22=range("A","Z");
        $Alpha12=range("A","Z"); 
        $alpha22=range("a","z");
        $alpha12=range("a","z");
        $num22=range(1000,9999);
        $num12=range(1000,9999);
        $numU22=range(99999,10000);
        $numU12=range(99999,10000);
        $AlphaB22=array_rand($Alpha22);
        $AlphaB12=array_rand($Alpha12);
        $alphaS22=array_rand($alpha22);
        $alphaS12=array_rand($alpha12);
        $Num22=array_rand($num22);
        $NumU22=array_rand($numU22);
        $Num12=array_rand($num12);
        $NumU12=array_rand($numU12);
        $res22=$Alpha22[$AlphaB22].$num22[$Num22].$Alpha12[$AlphaB12].$numU22[$NumU22].$alpha22[$alphaS22].$num12[$Num12];
        $text22=str_shuffle($res22);
         $_SESSION['randnum']= $text22;
} 


    // Getting username/ email and password
    $uname=$_POST['useremail'];
     $password=hash('sha256',$_POST['password']);

     // Hashing with Random Number
     $saltedpasswrd=hash('sha256',$password.$_SESSION['randnum']);
    // Fetch stored password  from database on the basis of username/email 
    $sql ="SELECT Email,Password FROM adminlogin WHERE (Email=:usname )";
    $query= $DB_con -> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
foreach ($results as $result) {
 $fetchpassword=$result->Password;
 // hashing for stored password
   $storedpass= hash('sha256',$fetchpassword.$_SESSION['randnum']);
}
//You can configure your cost value according to your server configuration.By Default value is 10.
  $options = [
              'cost' => 12,
              ];
  // Hashing of the post password
  $hash= password_hash($saltedpasswrd,PASSWORD_DEFAULT, $options);
  // Verifying Post password againt stored password
   if(password_verify($storedpass,$hash)){


    $_SESSION['userlogin']=$_POST['useremail'];
     echo "<script>alert('Login Successful..');
window.location.href='dashboard.php';</script>";
  }
else {
    echo "<script>alert('Wrong Login id/Password Please Check the again..');
  </script>";

}

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
 

    <title>Admin Panel</title>
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
                                
                                <h4 style="text-align: center ; font-family:Patua One ;">LOGIN PANEL</h4>

                              </div>
                              <div class="card-body">
                                <form method="post" enctype="multipart/form-data" name="loginform">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" >Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="useremail" aria-describedby="emailHelp" placeholder="Enter email" required>
                                        
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
                                      </div>
                                      <button type="submit" name="login" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                              <div class="card-footer">
                                
                                <a href="signup.php"><p style="text-align: center;">Dont have Acount click here</p></a>
                              </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>