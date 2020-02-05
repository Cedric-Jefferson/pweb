<?php

//Inclusion des fichiers utilisables
include("functions.php");

//Récupération depuis le formulaire des variables à traiter et stocker dans la base données
$fichier = $_FILES['quizz-upload']['name'];


   /* Teste que les valeurs ne sont pas vides ou composées uniquement d'espaces */  
   $name = $_POST['name'];
   $name = trim($name) != '' ? $name : null;


//Utilisation de la fonction upload
$destination = 'quizzes/'.basename($name);
$upload = upload('quizz-upload' , $destination, 40000000, array('txt' , 'pdf' , 'json'));

//Connexion à la base de données
$bdd = bdd_access();

//Insertion de l'url
$req = $bdd->prepare('SELECT id FROM questionnaire WHERE nom = :nam');
$req->execute(array(":nam"=>$name));

$data = $req->fetchAll();
$nb_data = count($data);

if($nb_data != 1){
    $req = $bdd->prepare('INSERT INTO questionnaire (fichier, nom) VALUES(?, ?)');
    $req->execute(array($destination, $name));
}

refresher('menu.html', 0);
?>