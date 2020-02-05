<?php

session_start();

$bdd=null;
$dsn = 'mysql:dbname=quizzbeta;host=127.0.0.1';
$user = 'root';
$password = '';
$delai = 0;
$urli = 'index.php?user='.$_SESSION['user'].'&session='.$_SESSION['session'];
$urlq = 'questions.php';

try{
	$bdd=new PDO($dsn,$user,$password);
	$req = $bdd->prepare('SELECT id_questionnaire FROM session  WHERE id = :id');
	$req->execute(array(":id"=>$_SESSION["session"]));
	$data = $req->fetch();
	$req = $bdd->prepare('SELECT fichier FROM questionnaire  WHERE id = :id');
	$req->execute(array(":id"=>$data[0]));
}catch(EXCEPTION $e){
	die("erreur de connection a pdo".$e->getMessage());
}
$fichier = $req->fetch();
 echo "<script>let file = './".$fichier[0]."';</script>";
?>