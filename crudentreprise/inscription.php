<?php
include "../fonction.php";
include "../header.php";
require "../DB.php";

if(!empty($_GET['deconnexion'])){
    session_unset();
    header("location:/entreprise/index.php");
}

if (isset($_POST['send'])) {
    $prenom = strip_tags($_POST['prenom']);
    $nom = strip_tags($_POST['nom']);
    $genre = $_POST['genre'];
    $service = strip_tags($_POST['service']);
    $date = $_POST['date_embauche'];
    $salaire = $_POST['salaire'];
    $mail = strip_tags($_POST['mail']);
    $mdp = $_POST['mdp'];
    $error = null;
    if (empty($prenom)) {
        $error = '<li>Veuillez ajouter votre prénom.</li>';
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 20) {
        $error = '<li>Le prénom doit faire entre 2 et 20 caractère</li>';
    }
    if (empty($nom)) {
        $error .= '<li>Veuillez ajouter votre nom.</li>';
    } elseif (strlen($nom) < 2 || strlen($nom) > 20) {
        $error .= '<li>Le nom doit faire entre 2 et 20 caractère</li>';
    }
    if (!valideDate(convertirstrtotime($_POST['date_embauche']))) {
        $error .= "<li>Veuillez ajouter votre date d'embauche.</li>";
    }
    if (empty($salaire)) {
        $error .= '<li>Veuillez ajouter votre salaire.</li>';
    } elseif (is_numeric($salaire) === false) {
        $error .= "<li>Le salaire doit être un chiffre.</li>";
    }
    if (empty($mail)) {
        $error .= '<li>Veuillez ajouter votre adresse mail.</li>';
    }
    if (empty($mdp)) {
        $error .= '<li>Veuillez ajouter votre mot de passe.</li>';
    }

    if (empty($error)) {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $requete->execute([
            "nom" => $nom,
            "prenom" => $prenom,
            "mail" => $mail,
            "mdp" => $hash,
            "genre" => $genre,
            "service" => $service,
            "date_embauche" => $date,
            "salaire" => $salaire
        ]);
        header("location:/entreprise/crudentreprise/connexion.php");
    }
}



?>



<a href="/entreprise/crudentreprise/connexion.php">Vous avez déjà un compte ?</a>

<div class="container">

    <form action="" method="post">
        <div class="form-group">
            <label class="form-label mt-4">Nom</label>
            <input type="text" class="form-control" placeholder="Votre Nom" name="nom" value="<?php echo @$_POST['nom'] ?>">
        </div>

        <div class="form-group">
            <label class="form-label mt-4">Prénom</label>
            <input type="text" class="form-control" placeholder="Votre Prénom" name="prenom" value="<?php echo @$_POST['prenom'] ?>">
        </div>


        <fieldset class="form-group">
            <legend class="mt-4">Genre</legend>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genre" id="optionsRadios1" value="m" checked="">
                <label class="form-check-label" for="optionsRadios1">
                    Homme
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genre" id="optionsRadios2" value="f">
                <label class="form-check-label" for="optionsRadios2">
                    Femme
                </label>
            </div>
        </fieldset>

        <div class="form-group">
            <label class="form-label mt-4">Service</label>
            <select class="form-select" name="service">
                <option>-</option>
                <option>Direction</option>
                <option>Production</option>
                <option>Secretariat</option>
                <option>Comptabilité</option>
                <option>Commercial</option>
                <option>Informatique</option>
                <option>Communication</option>
                <option>Juridique</option>
                <option>Autre</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label mt-4">Date d'embauche :</label>
            <input type="date" class="form-control" placeholder="La date de votre arrivée dans l'entreprise" name="date_embauche">
        </div>

        <div class="form-group">
            <label class="form-label mt-4">Salaire :</label>
            <input type="number" class="form-control" placeholder="Votre salaire" name="salaire" value="<?php echo @$_POST['salaire'] ?>">
        </div>

        <div class="form-group">
            <label class="form-label mt-4">Adresse mail</label>
            <input type="mail" class="form-control" placeholder="Votre mail" name="mail" value="<?php echo @$_POST['mail'] ?>">
        </div>
        <div class="form-group">
            <label class="form-label mt-4">Mot de passe</label>
            <input type="password" class="form-control" placeholder="Votre mot de passe" name="mdp">
        </div>
        <button type="submit" class="btn btn-primary" name="send">Valider</button>

    </form>
    <a href="/entreprise/index.php">Retour</a>
    <?php
    if (!empty($error)) { ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Il manque des éléments à votre formulaire d'inscription !</h4>
        <?php echo $error;
    } ?>
        </div>
</div>

<?php

include "../footer.php";
