<?php 
session_start();
include("functions.php");
if(!isset($_POST["user"])){
	echo "<script>alert('Name required');</script>";
	refresher('adduser.html', 0);
	die();
}else{
	//Connexion à la base de données
	$bdd = bdd_access();
	$req = $bdd->prepare('INSERT INTO joueur (name) VALUES(?)');
		$req->execute(array($_POST["user"]));
}
refresher('menu.html', 0);
?>