<?php 
session_start();
if(isset($_GET["user"]) && isset($_GET["session"])){
	$_SESSION["user"] = $_GET["user"];
	$_SESSION["session"] = $_GET["session"];
}else{
	echo "<script>alert('url incorrecte');</script>";
}
?>