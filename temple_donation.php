
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
                    <img src="img/panditavtar.png" height="60px" width="60px" class="img-responsive" style="margin-left:0px;">
                </div>
                <div class="info">
                    <h4 class="text-center"><?php echo $row["donation_cause"] ?></h4>
					<p>Description : <?php echo substr($row['donation_discription'],0,3);?><span id="dot">...</span></p>
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
      <div class="modal-body" align="center" style=" background: rgba(0,0,0,.125);">
        <div ><?php echo ($row['donation_discription']);?></div>
      </div>
      
    </div>
  </div>
</div>
                    
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