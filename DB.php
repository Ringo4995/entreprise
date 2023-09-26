<?php

$pdo = new PDO("mysql:host = localhost; dbname=entreprise; charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$error = null;
try{
    $statement = $pdo->query("SELECT * FROM employes"); // objet qui récupère les données


    $requete = $pdo->prepare("INSERT INTO employes(nom,prenom,mail,mdp,genre,service,date_embauche,salaire) values(:nom,:prenom,:mail,:mdp,:genre,:service,:date_embauche,:salaire)");

}catch(PDOException $exp){
    $error = $e->getMessage();
}
?>