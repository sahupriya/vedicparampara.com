<?php 
include 'header.php';?>
<?php 
include 'config.php';
if(isset($_SESSION['transection_id'])){

?>
<br>
<div class="container jumbotron" align="center">
<h3> Your transaction Id is: 
<?php 
	echo $_SESSION['transection_id'];
 ?>
 <br><br>
 <a href="index.php" class="btn btn-success">Go to Home</a>
 <br>
</div>
    </div><!-- /.container -->
	<?php
}else{
	?>
	<script>
	window.location.href="index.php";
	</script>

<?php } include 'footer.php';?>