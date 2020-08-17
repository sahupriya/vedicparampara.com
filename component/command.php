<?php
include '../config.php';

$date = date('m-d-Y');
if(isset($_POST['command'])){
	if($_POST['command'] == "increment_quantity"){
		$id=$_REQUEST['id'];
		$q="SELECT * FROM product WHERE product_id='".$_REQUEST['id']."' ";
		$res=mysqli_query($conn,$q);
		if(mysqli_num_rows($res) >= 1){
			while($value=mysqli_fetch_assoc($res)){
				$value['qty'];
				if($_REQUEST['new_quantity']>$value['qty']){
					echo "You can only purchase ".$value['qty']." units. If you have a higher requirement, please create a new order";
					$qty=$value['qty'];
				}else{
					$qty=$_REQUEST['new_quantity'];
					echo "OK";
				}				
			}
			if(isset($_REQUEST['new_quantity']) & !empty($_REQUEST['new_quantity'])){ $quant = $qty; }else{ $quant = 1;}
			// $_SESSION['quantity']= $quant;  
		}
	}
	if($_POST['command'] == "decrement_quantity"){
		$id=$_REQUEST['id'];
		$q="SELECT * FROM product WHERE product_id='".$_REQUEST['id']."' ";
		$res=mysqli_query($conn,$q);
		if(mysqli_num_rows($res) >= 1){
			while($value=mysqli_fetch_assoc($res)){
				$value['qty'];
				if($_REQUEST['new_quantity']>$value['qty']){
					echo "You can only purchase ".$value['qty']." units. If you have a higher requirement, please create a new order";
					$qty=$value['qty'];
				}else{
					$qty=$_REQUEST['new_quantity'];
					echo "OK";
				}
				
			}
			if(isset($_REQUEST['new_quantity']) & !empty($_REQUEST['new_quantity'])){ $quant = $qty; }else{ $quant = 1;}
			// $_SESSION['quantity']= $quant;  
		}
	}
	
}else{
	?>
	<script type="text/javascript">
		window.location.href="../index.php";
	</script>
	<?php
}
?>