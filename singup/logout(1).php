<?php
session_start();
session_destroy();
unset($_SESSION["userlogin"]);
header('location:index.php');

?>