<?php
session_start();

if(isset($_POST["envoyer"])){

$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$email=$_POST["email"];
$telephone=$_POST["telephone"];
$demande=$_POST["demande"];

function n($nom){
    $validation= "/^[a-zA-Z]+$/";
    if (preg_match($validation,$nom)){
return true;
    }
    else{
        return false;
        echo " <p>Veuillez entre votre nom s.v.p<p>";
    };
};
function p($prenom){
    $validation= "/^[a-zA-Z]+$/";
    if (preg_match($validation,$prenom)){
return true;
    }
    else{
        return false;
        echo " <p>Veuillez entre votre prenom s.v.p<p>";
    };
};
function e($email){
    $validation= "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/";
    if (preg_match($validation,$email)){
return true;
    }
    else{
        return false;
        echo " <p>Veuillez entre votre email s.v.p<p>";
    };
};
function t($telephone){
    $validation= "/^[0-9]{10,}$/";
    if (preg_match($validation,$telephone)){
return true;
    }
    else{
        return false;
        echo " <p>Veuillez entre votre numéro de téléphone s.v.p<p>";
    };
};
function d($demande){
    $validation= "/^[a-zA-Z]+$/";
    if (preg_match($validation,$demande)){
return true;
    }
    else{
        return false;
        echo " <p>Veuillez entre votre demande s.v.p<p>";
    };
};
 if(n($nom)==true&p($prenom)==true&e($email)==true &t($telephone)==true &d($demande)==true){
   
$_SESSION["nom"]=$nom;
$_SESSION["prenom"]=$prenom;
$_SESSION["email"]=$email;
$_SESSION["telephone"]=$telephone;
$_SESSION["demande"]=$demande;
$nomFichier=date("Y-m-d-H-i-s");
$contenuFichier="Nom : ".$_SESSION["nom"]
."\r\n Prenom : ".$_SESSION["prenom"]
."\r\n  Email : ".$_SESSION["email"]
."\r\n  Telephone : ".$_SESSION["telephone"]
."\r\n  Demande :".$_SESSION["demande"];
file_put_contents($nomFichier,$contenuFichier);
header("Location: app_demande");
exit();
}
 else{
unset($_SESSION);
session_destroy();
// echo "Veuillez remplir correctement le formulaire s.v.p <br>";
// echo "nom: ".n($nom);
// echo "<br>prenom: ".p($prenom);
// echo "<br>email: ".e($email);
// echo "<br>telephone: ".t($telephone);
// echo "<br>demande: ".d($demande);
header("Location: app_contact");
exit();

 };




};
