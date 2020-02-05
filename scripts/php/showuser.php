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
	$req = $bdd->prepare('SELECT id FROM joueur WHERE name=:name');
	$req->execute(array(":name"=>$_POST["user"]));
	$data = $req->fetch();
	if(!isset($data[0])){
		echo "<script>alert('No such player');</script>";
	}else{
		$req = $bdd->prepare('SELECT id_session,pass FROM joueur_session WHERE id_joueur=:idj');
		$req->execute(array(":idj"=>$data[0]));
		$data2 = $req->fetchAll();
		foreach ($data2 as $d){
			$req = $bdd->prepare('SELECT name FROM session WHERE id=:idj');
			$req->execute(array(":idj"=>$d['id_session']));
			$data3 = $req->fetch();
			
			echo '<script>document.querySelector("#caracteristics").innerHTML+="name:"'.$data3[0].'"\n url:http://localhost/pweb/index.php?user="'.$data[0].'"&session="'.$d["id_session"].'"\n";</script>';
		} 
	}
}
?>