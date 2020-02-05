<?php

session_start();

if (isset($_POST['mdp']) and !empty($_POST['mdp'])) {
    //Récupération depuis le formulaire des variables à traiter et stocker dans la base données
    $pass = !empty($_POST['mdp'])? strip_tags($_POST['mdp']): "default pass";

    $bdd=null;
    $dsn = 'mysql:dbname=quizzbeta;host=127.0.0.1';
    $user = 'root';
    $password = '';
    $delai = 0;
    $urli = 'index.php?user='.$_SESSION['user'].'&session='.$_SESSION['session'];
    $urlq = 'questions.php';

    try{
		$bdd=new PDO($dsn,$user,$password);
        $req = $bdd->prepare('SELECT * FROM joueur_session WHERE pass = :pass AND id_session = :ids AND id_joueur = :idj');
        $req->execute(array(":pass"=>$pass, ":ids"=>$_SESSION["session"], ":idj"=>$_SESSION["user"]));
    }catch(EXCEPTION $e){
        die("erreur de connection a pdo".$e->getMessage());
    }
}

$data = $req->fetchAll();
$nb_data = count($data);
if($nb_data != 1){
  header("Refresh:$delai;url=$urli");
}else{
  header("Refresh:$delai;url=$urlq");
}
 ?>