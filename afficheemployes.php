<?php

include "header.php";
require "DB.php";


if(!empty($_GET)){
    $query = $pdo->prepare("DELETE FROM employes where id_employes = :id");
    $query->execute([
        "id" => $_GET['id_employes']
    ]);
    header("location:/entreprise/afficheemployes.php");
}


$employes = $statement->fetchAll();

?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Email</th>
            <th scope="col">Mot de passe</th>
            <th scope="col">Genre</th>
            <th scope="col">Service</th>
            <th scope="col">Date d'embauche</th>
            <th scope="col">Salaire</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employes as $employe) {
        ?>
            <tr>
                <td scope="col"><?= $employe['nom'] ?></td>
                <td scope="col"><?= $employe['prenom'] ?></td>
                <td scope="col"><?= $employe['mail'] ?></td>
                <td scope="col"><?= $employe['mdp'] ?></td>
                <td scope="col"><?= $employe['genre'] ?></td>
                <td scope="col"><?= $employe['service'] ?></td>
                <td scope="col"><?= $employe['date_embauche'] ?></td>
                <td scope="col"><?= $employe['salaire'] ?></td>
                <td scope="col"><a href="/entreprise/crudentreprise/modification.php?id_employes=<?= $employe['id_employes'] ?>" style="text-decoration:none">Modifier</a></td>
                <td scope="col"><a href="/entreprise/afficheemployes.php?id_employes=<?= $employe['id_employes'] ?>" style="text-decoration:none">Supprimer</a></td>
            </tr>
        <?php
        } ?>
    </tbody>
</table>

<?php
include "footer.php";