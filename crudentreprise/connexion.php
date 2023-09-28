<?php
include "../fonction.php";
include "../header.php";
require "../DB.php";

if (isset($_POST['send'])) {


    $mail = strip_tags($_POST['mail']);
    $mdp = $_POST['mdp'];
    $error = null;

    if (empty($mail)) {
        $error .= '<li>Veuillez ajouter votre adresse mail.</li>';
    }  elseif (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
        $error .= "<li>l'email n'est pas valide</li>";
    }
    if (empty($mdp)) {
        $error .= '<li>Veuillez ajouter votre mot de passe.</li>';
    }
    if (empty($error)) {
        $statementemploye = $pdo->prepare("SELECT * FROM employes where mail = :mail");
        $statementemploye->execute([
            "mail" => $mail
        ]);
        $employe = $statementemploye->fetch(); 
        var_dump($employe);
        if ($employe === false) {
?>
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Email introuvable ou incorrect !</strong> Veuillez vous inscrire <a href="/entreprise/crudentreprise/inscription.php" class="alert-link">ICI</a>
            </div>

            <?php
        } else {
            //hash password
            $hash = $employe['mdp'];
            if (password_verify($mdp, $hash)) {
                echo "blabla";
                $_SESSION['id'] = $employe['id_employes'];
                $_SESSION['connected'] = true;
                header("location:/entreprise/profil.php");
                exit;
            } else {
            ?>
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Mot de passe incorrect</strong>
                </div>
<?php
            }
        }
    }
}



?>




<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label class="form-label mt-4">Adresse mail</label>
            <input type="mail" class="form-control" placeholder="Votre mail" name="mail">
        </div>
        <div class="form-group">
            <label class="form-label mt-4">Mot de passe</label>
            <input type="password" class="form-control" placeholder="Votre mot de passe" name="mdp">
        </div>
        <button type="submit" class="btn btn-primary" name="send">Connexion</button>

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
