
<?php include 'header.php';?>
<?php include 'config.php';?>



<!--Services-->
<div class="container">
      <div class="heading animate-box"><h2><b style="color: black;">Virtual Services</b></h2></div>
    <div class="row">
<?php
$sql = "SELECT * FROM virtual_service";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	
    while($row = $result->fetch_assoc()) {
		?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box">
                <div class="box-icon">
                    <img src="img/<?php echo $row["virtual_service"] ?>.png" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
                </div>
                <div class="info">
                    <h4 class="text-center"><?php echo $row["virtual_service"] ?></h4>
                    <p>Price : <?php echo $row["price"] ?></p>
					<p>Description : <?php echo $row["description"] ?></p>
                    
                    <a href="#" class="btn">Ask Pandit Ji</a>
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