<?php

//Inclusion des fichiers utilisables
include("functions.php");
if(!isset($_POST['session'])){
	echo "<script>alert('Enter a session');</script>";
	refresher('add.html', 0);
	die();
}
if(!isset($_POST['user'])){
	echo "<script>alert('Enter a user');</script>";
	refresher('add.html', 0);
	die();
}
//Connexion à la base de données
$bdd = bdd_access();
$req = $bdd->prepare('SELECT id FROM session WHERE name = :nam');
$req->execute(array(":nam"=>$_POST['session']));

$data = $req->fetch();

if(!isset($data[0])){
	echo "<script>alert('Session invalid');</script>";
	refresher('add.html', 0);
	die();
}else{
	$req = $bdd->prepare('SELECT id FROM joueur WHERE name = :nam');
	$req->execute(array(":nam"=>$_POST['user']));
	$data2 = $req->fetch();
	if(!isset($data2[0])){
		echo "<script>alert('User invalid');</script>";
		refresher('add.html', 0);
		die();
	}else{
		$pass=genere_prefixe_aleatoire(2).genere_suffixe_aleatoire(6);
		$req = $bdd->prepare('INSERT INTO joueur_session (id_session, id_joueur,pass) VALUES(?,?,?)');
		$req->execute(array($data[0], $data2[0],$pass));
		$url="http://localhost/pweb/index.php?user=";
		echo '<script>alert("Save this url:'.$url.$data[0].'&session='.$data2[0].'\n And this password:'.$pass.'");</script>';
		refresher('menu.html', 15);
	}
}
 ?>