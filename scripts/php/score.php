<?php 
session_start();
require("functions.php");
//Connexion à la base de données
$bdd = bdd_access();
$req = $bdd->prepare('UPDATE joueur_session SET score = :score where id_session = :id_s AND id_joueur= :id_j');
$req->execute(array(":score"=>$_POST["score"], ":id_s"=>$_SESSION["session"],":id_j"=>$_SESSION["user"]));
?>