
<?php include 'header.php';?>
<?php include 'config.php';?>




<!--Services-->
<div class="container">
      <div class="heading animate-box"><h2><b style="color: black;">Book Pandit</b></h2></div>
       <!-- <div class="text-center animate-box"><h3>Ask Pandit Ji</h3></div>-->
    <div class="row">
<?php
$sql = "SELECT * FROM pandit";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	
    while($row = $result->fetch_assoc()) { 
		?>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <div class="box">
				<div class="box-icon">
				<?php if($row["image"]== null){ ?>
					<img src="img/panditavtar.png" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
					<?php }else{ ?>
					<img src="<?php echo $base_url."/panel/".$row["image"]; ?>" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
					<?php } ?> 
				</div>
                <div class="info">
                    <h4 class="text-center"><?php echo $row["username"]; ?></h4>
                    <p>City : <?php echo $row["city"]; ?></p>
                    
                    <a href="#" class="btn">Book Now</a>
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


<?php include'footer.php';?>