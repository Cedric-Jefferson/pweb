<?php
//Fichier de Fonctions

//Fonction de connexion à la base de données
function bdd_access()
{
    $bdd = null;
    $dsn = 'mysql:dbname=quizzbeta;charset=utf8;host=127.0.0.1';
    $user = 'root';
    $password = '';
    $pdo_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try
    {
        //On se connecte à MySQL
        $bdd = new PDO($dsn, $user, $password, $pdo_options);
    }
    catch (Exception $e)
    {
       //En cas d'erreur, on affiche un message et on arrète tout
       die('Erreur : '.$e->getMessage());
    }

    return $bdd;
}

//Fonction de rafraîchissemment
function refresher($url, $delay)
{
    header("Refresh:$delay;url=$url");
}

//La fonction de stockage du fichier dans un dossier spécifique
function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
    //Test1 : Fichier correctement uploadé
    if(!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;

    //Test2 : Taille limite
    if($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;

    //Test3 : Extension
    $ext = substr(strrchr($_FILES[$index]['name'],'.'), 1);
    if($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;

    //Déplacement
    return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}


function insertion(){}


function mdp($prefixe, $suffixe){
    $suffix = genere_suffixe_aleatoire(4);
}

//Génération du préfixe du mot de passe
function genere_prefixe_aleatoire($longueur){
    $caractere_au_choix1 = array(0,1,2,3,4,5,6,7,8,9);
    $prefixe = "";
    for($i=0; $i < $longueur; $i++) {
        
        $prefixe .= ($i%2) ? strtoupper($caractere_au_choix1[array_rand($caractere_au_choix1)]) : $caractere_au_choix1[array_rand($caractere_au_choix1)];
    }
    return $prefixe;
}

function genere_suffixe_aleatoire($longueur){
    $caractere_au_choix = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",0,1,2,3,4,5,6,7,8,9);
    $suffixe = "";
    for($i=0; $i < $longueur; $i++) {
        $suffixe .= ($i%2) ? strtoupper($caractere_au_choix[array_rand($caractere_au_choix)]) : $caractere_au_choix[array_rand($caractere_au_choix)];
    }
    return $suffixe;
}

?>