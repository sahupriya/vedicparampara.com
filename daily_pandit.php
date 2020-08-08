
<?php include 'header.php';?>
<?php include 'config.php';?>



<!--Services-->
<div class="container">
      <div class="heading animate-box"><h2><b style="color: black;">Daily Pandit</b></h2></div>
       <!-- <div class="text-center animate-box"><h3>Ask Pandit Ji</h3></div>-->
    <div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box">
                <div class="box-icon">
                    <img src="img/office.png" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
                </div>
                <div class="info">
                    <h4 class="text-center">Office</h4>
					<div class="tab-pane active" >
                        <div>
                            
						
					<?php
$sql = "SELECT * FROM dailypandit_subscription where subscription_for='office'";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	
    while($row = $result->fetch_assoc()) { 
		?>
			<div><a href="#"><?php print_r($row["subscription_type"]); ?></a>    <span><?php print_r($row["price"]); ?></span></div>		
        <?php } ?>
		<?php
} else {
    echo "0 results";
} ?>
               </div>
                    </div>     
                </div>
            </div>
        </div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box">
                <div class="box-icon">
                    <img src="img/home.png" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
                </div>
                <div class="info">
                    <h4 class="text-center">Home</h4>
					<div class="tab-pane active" >
                        <div>
                           
						
					<?php 
$sql_home = "SELECT * FROM dailypandit_subscription where subscription_for='home'";
$result_home = mysqli_query($conn,$sql_home);
if (mysqli_num_rows($result_home) > 0) {
	while($row_home = $result_home->fetch_assoc()) { ?>
	 <div><a href="#"><?php print_r($row_home["subscription_type"]); ?></a>    <span><?php print_r($row_home["price"]); ?></span></div>
	<?php }
	} else {
    echo "0 results";
}
	?></div>
                    </div>
                </div>
            </div>
        </div>




<?php
$conn->close();
?>
         
    </div>
</div><br>


<?php include'footer.php';?>