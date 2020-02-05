<?php
include("functions.php");
   
$bdd = bdd_access();

//Si tout va bien on peut continuer

//On récupère tout le contenu de la table etudiants
$reponse = $bdd->query('SELECT * FROM session');

//On affiche chaque entrée une à une 
while ($donnees = $reponse->fetch()){
	$txt='<option value="'.$donnees["name"].'">'.$donnees["name"].'</option>';
   echo "<script>document.addEventListener('DOMContentLoaded',function(){document.getElementById('chx').innerHTML+='".$txt."';});</script>";
}
if(isset($_POST['menu_destination']) ){
    $feeder = $_POST['menu_destination'];
   
    $req=$bdd->prepare('SELECT id FROM session WHERE name = :nom');
    $req->execute(array(":nom"=>$feeder));

    $stock1 = $req->fetch();

    $req=$bdd->prepare('SELECT id_joueur,score FROM joueur_session WHERE id_session = :idj');
    $req->execute(array(":idj"=>$stock1[0]));

    $stock2 = $req->fetchAll();
	$nbstock=count($stock2);
	if($nbstock>0){
		foreach($stock2 as $s){
			$req=$bdd->prepare('SELECT name FROM joueur WHERE id = :ids');
			$req->execute(array(":ids"=>$s['id_joueur']));
			$stock3 = $req->fetch();
			echo '<script>document.addEventListener("DOMContentLoaded",function(){document.getElementById("show").innerHTML+="idJoueur:'.$s["id_joueur"].'<br>  name:'.$stock3[0].'<br>'.$s["score"].'";});</script>';
			
		}
	}else echo "<script>document.addEventListener('DOMContentLoaded',function(){document.getElementById('show').innerHTML='".$_POST['menu_destination']." no data';});</script>";
}
?>