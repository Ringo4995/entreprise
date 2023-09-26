<?php
// si je veux la suppression via une page différente

include "../fonction.php";
include "../header.php";
require "../DB.php";

if(!empty($_GET)){
    $query = $pdo->prepare("DELETE FROM employes where id_employes = :id");
    $query->execute([
        "id" => $_GET['id_employes']
    ]);
    echo "Supprimé avec succès";
}

?>

<a href="/entreprise/afficheemployes.php">Retour</a>

<?php 

include "../footer.php";