<?php
session_start();
?>
<!DOCTYPE html><?php $base_url="http://localhost/vedicparampara.com" ; ?>
<html lang="en" class="no-js">
<head>
    <title>Parampara</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
	  <link rel="stylesheet" href="<?php echo base_url?>css2/sweet_alert.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
     <link rel="stylesheet" href="css2/style.css">
      <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="css2/style.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link rel="icon" href="http://localhost/vedicparampara.com/img/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="./css/animate.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <script src="./js/modernizr-3.5.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<style>


#success_message{ display: none;}


.box {
    border-radius: 3px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    padding: 10px 25px;
    text-align: right;
    display: block;
    margin-top: 60px;
    background-color:#fff;
    width: 90%;
}
.box-icon {
    background-color: #f7f74a;
    border-radius: 50%;
    display: table;
    height: 60px;
    margin: 0 auto;
    width: 60px;
    margin-top: -61px;
}
.box-icon span {
    color: #fff;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.info h4 {
    font-size: 15px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 700;
}

.info > p {
    color: #717171;
    font-size: 16px;
    padding-top: 10px;
    text-align: justify;
}
.info > a {
    background-color:#f71d00;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    color: #fff;
    transition: all 0.5s ease 0s;
    width: 80px;
    font-size: 11px;
}
.info > a:hover {
    background-color: #0288d1;
    box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.12);
    color: #fff;
    transition: all 20s ease 0s;
}


/* Scale up the box2 */
.box:hover {
  cursor: pointer;
   background-color:#f68819;
    box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.12);
    color: black;
    transition: all 0.5s ease 0s;
  font-weight: bold;
}
/* Fade in the pseudo-element with the bigger shadow */
.box:hover::after {
  opacity: 1;
}
	
    .ask
    {

        border-radius: 3px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }
  .topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}


	</style>
</head>
<body id="body" >

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class=" d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">contact@example.com</a>
        <i class="fa fa-phone"> +1 5589 55488 55</i> 
      </div>
      <!--<div class="social-links float-right">
        <a href="signup-form.php" class="twitter"><i>Signup</i></a>
        <a href="login.php" class="facebook"><i class="">Login</i></a>
       
      </div>-->
	  <div class="social-links float-right">
		<a href="signup-form.php" class="twitter"><i>Signup</i></a>
		<?php 
		//var_dump($_SESSION);
		if(isset($_SESSION['mobile'])){
		?>
		<a href="plogout.php">Log Out</a>
		<?php
		} ?>
		
        <a href="signup-form.php" class="twitter"><img src="img/apk_download1.png" height="30px"></a>
      </div>
    </div>
  </section>
 <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
       <a href="#body" class=""><img src="img/logo.png" height="60px"></a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo $base_url; ?>">Home</a></li>
          <li><a href="horoscope.php">Horoscope</a></li>
          <li><a href="estore.php">E-Store</a></li>
          <!--<li class="menu-has-children"><a href="#">God</a>
            <ul>
              <li><a href="#">All About Shiv Ji</a></li>
              <li><a href="#">All About Laxmi Ji</a></li>
              <li><a href="#">All About Vishnu Ji</a></li>
              <li><a href="#">All About Durga Ji</a></li>
            </ul>
          </li>-->
          <li class="menu-has-children"><a href="">Services</a>
            <ul>
              <li><a href="pandit-booking.php">Pandit Booking</a></li>
              <li><a href="#">Brahman Bhoj</a></li>
              <li><a href="bhajan_mandal.php">Bhajan Mandal</a></li>
			  <li><a href="temple_donation.php">Temple Donation</a></li>
			  <li><a href="daily_pandit.php">Daily Pandit</a></li>
              <li><a href="bhavya_ayojan.php">Bhavya Ayojan</a></li>
			  <li><a href="#">Darshan Booking</a></li>
            </ul>
          </li>
		  <li><a href="virtual_services.php">Virtual Services</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->



   <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>



  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>



</html>