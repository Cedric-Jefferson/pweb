<?php
//Inclusion des fichiers utilisables
include("functions.php");
if(!isset($_POST['session'])){
	echo "<script>alert('Enter a session');</script>";
	refresher('create.html', 0);
	die();
}
if(!isset($_POST['quest'])){
	echo "<script>alert('Enter a questionnaire');</script>";
	refresher('create.html', 0);
	die();
}
//Connexion à la base de données
$bdd = bdd_access();
$req = $bdd->prepare('SELECT id FROM questionnaire WHERE nom = :nam');
$req->execute(array(":nam"=>$_POST['quest']));

$data = $req->fetch();

if(!isset($data[0])){
	echo "<script>alert('Questionnaire invalid');</script>";
	refresher('create.html', 0);
	die();
}else{
	$req = $bdd->prepare('INSERT INTO session (name, id_questionnaire) VALUES(?, ?)');
    $req->execute(array($_POST['session'], $data[0]));
}
refresher('menu.html', 0);
?>