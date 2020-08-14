
<?php include 'header.php';?>
<?php include 'config.php';?>


<!--Services-->
<div class="container">
      <div class="heading animate-box"><h2><b style="color: black;">Purchase Product</b></h2></div>
       <!-- <div class="text-center animate-box"><h3>Ask Pandit Ji</h3></div>-->
    <div class="row">
<?php
$sql = "SELECT `p`.*, `c`.`category_name`, `v`.`name` as 'vendor_name', `v`.`id` as 'vendor_id' FROM `product` `p` LEFT JOIN `category` `c` ON `c`.`category_id`=`p`.`category_id` LEFT JOIN `vender` `v` ON `v`.`id` =`p`.`vendorId` ORDER BY `p`.`product_id` DESC";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	
    while($row = $result->fetch_assoc()) {
		?>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <div class="box">
                <div class="box-icon">
				<?php if($row["image"]== null){ ?>
				<img src="img/cart.png"  class="img-responsive" style="margin-left:0px;height:80px;width:100px;">
				<?php }else{ ?>
				<img src="<?php echo $base_url."/panel/".$row["image"] ?>" class="img-responsive" style="margin-left:0px;height:80px;width:100px;">
				<?php } ?>
                    
                </div>
				
                <div class="info">
                    <h4 class="text-center"><?php echo $row["name"]; ?></h4>
                    <p>Price : <?php echo $row["price"] ?></p>
					<p>Description : <?php echo substr($row['description'],0,55);?><span id="dot">...</span></p>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row["product_id"];?>">
  read more
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row["product_id"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:4px; background:#f68819;text-align: center;" >
        <h5 class="modal-title" id="exampleModalLabel"><span ><?php echo $row["name"]; ?></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="padding-right: 10px;">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center" style=" background:#ffca73;">
        <div ><?php echo ($row['description']);?></div>
      </div>
      
    </div>
  </div>
</div>
					 
                    <a href="login.php?id=<?php echo $row["product_id"];?>" class="btn">Order Now</a>
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


<!--footer-->

<?php include 'footer.php';?>