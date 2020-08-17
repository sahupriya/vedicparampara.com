
<?php include 'header.php';?>
<?php include 'config.php';?>



<!--Services-->
<div class="container">
      <div class="heading animate-box"><h2><b style="color: black;">Donation Cause</b></h2></div>
       <!-- <div class="text-center animate-box"><h3>Ask Pandit Ji</h3></div>-->
    <div class="row">
<?php
$sql = "SELECT * FROM donation";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	
    while($row = $result->fetch_assoc()) {
		//print_r($row);
		?>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <div class="box">
                <div class="box-icon">
                    <img src="img/donation_1.png" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
                </div>
                <div class="info">
                    <h4 class="text-center"><?php echo $row["donation_cause"] ?></h4>
					<p>Description : <?php echo substr($row['donation_discription'],0,55);?><span id="dot">...</span></p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row["donation_id"];?>">
  read more
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row["donation_id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:4px; background:#f68819;text-align: center;" >
        <h5 class="modal-title" id="exampleModalLabel"><span ><?php echo $row["donation_cause"]; ?></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="padding-right: 10px;">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center" style=" background:#ffca73;">
        <div ><?php echo ($row['donation_discription']);?></div>
      </div>
      
    </div>
  </div>
</div>
                    
                    <a href="login.php?donation_id=<?php echo $row["donation_id"];?>" class="btn">Donate</a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>
         
    </div>
</div><br>


<div class="dark">
    <div class="container animate-box" id="fh5co-footer">
        <div class="row">
            <div class="col-sm-4">
                <div><a class="nsavbar-brand" href="#">Parampara <span class="navbar-brand2"> HOST</span></a></div>
                <br>
                <div class="text-white">Get amazing results working with the best programmers, designers, writers and
                    other top online pros. You can hire us with confidence. Get amazing results working with the best
                    programmers
                </div>
            </div>
            <div class="col-sm-4">
                <div class="icons">Explore Our Pages</h3></div>
                <br>
                <table width="100%">
                    <tr>
                        <td><a class="text-white" href="#!">Home</a></td>
                        <td><a class="text-white" href="#fh5co-pricing">Hosting</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="#!">About us</a></td>
                        <td><a class="text-white" href="#!">Faq</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="#!">Services</a></td>
                        <td><a class="text-white" href="#!">Cart</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="#!">Shop</a></td>
                        <td><a class="text-white" href="#!">Checkout</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="#!">Blog</a></td>
                        <td><a class="text-white" href="#fh5co-contact">Contact</a></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <div class="icons">Get in Touch</h3></div>
                <br>
                <div>
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                    <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="darker">
    <div class="container" id="fh5co-legal">
        <div class="row">
            <div class="col-sm-8 text-white mtext-center">
                &copy; 2018 <a class="text-gr" href="#">FreeHTML5 <span class="navbar-brand2"> HOST</span></a>. Design
                by <a href="https://freehtml5.co" target="_blank">FreeHTML5</a>.
            </div>
            <div class="col-sm-4 text-white mtext-center">
                <table>
                    <tr>
                        <td><a class="text-white" href="#!">Legal</a></td>
                        <td><a class="text-white" href="#!">Sitemap</a></td>
                        <td><a class="text-white" href="#!">Privacy Policy</a></td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

 <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>-->
<script src="./js/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
<script src="./js/bootstrap.min.js"></script>
<!--<script src="https://use.fontawesome.com/8e45396e2e.js"></script>-->
<script src="./js/fontawesome.js"></script>
<script src="./js/jquery.waypoints.min.js"></script>
<script src="./js/animate.js"></script>


</body>
</html>