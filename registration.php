<?php
require_once('include.php');

//var_dump($_POST);

$valid = (bool) true;

if (empty($_POST)) {
    extract($_POST);

    if (isset($_POST['inscription'])) {
        $nom = htmlentities(trim($_POST['nom']));
        $prenom = htmlentities(trim($_POST['prenom']));
        $mail = htmlentities(trim($_POST['mail']));
        $confmail  = htmlentities(trim($_POST[' confmail ']));
        $pword = htmlentities(trim($_POST['pword']));
        $confpassword  = htmlentities(trim($_POST[' confpassword ']));

        if (empty($nom)) {
            $valid = false;
            $err_nom = "Ce champ ne peut pas être vide";
        }

        if (empty($prenom)) {
            $valid = false;
            $err_prenom = "Ce champ ne peut pas être vide";
        }

        if (empty($mail)) {
            $valid = false;
            $err_mail = "Ce champ ne peut pas être vide";
        } elseif ($mail <> $confmail) {
            $valid = false;
            $err_mail = "Le mail est différent de la confirmation.";
        } else {
            $req = $DB->prepare("SELECT id FROM utilisateur WHERE mail = ?");

            $req->execute(array($mail));

            $req = $req->fetch();

            if (isset($req['id'])) {
                $valid = false;
                $err_mail = "Ce mail est déjà utilisé";
            }
        }

        if (empty($pword)) {
            $valid = false;
            $err_pword = "Ce champ ne peut pas être vide";
        } elseif ($pword <> $confpassword) {
            $valid = false;
            $err_pword = "Le mot de passe est différent de la confirmation";
        }


        if ($valid) {

            $crypt_pword = crypt($pword, '$6$rounds=5000$=6kr:f=3QM^qzC/Nn1nPVy<mJ^Ff^/aid}dTF0h|/?2[9~B_2z>v3%&fo$');

            $date_creation = date('Y-m-d H:i:s');
            $date_connexion = date('Y-m-d H:i:s');


            $sql = "INSERT INTO `utilisateur`(`nom`, `prenom`, `mail`, `pword`, `date_creation`, `date_connexion`) VALUES (:nom, :prenom :mail, :pword, :date_creation, :date_connexion)";
            $res = $connexion->prepare($sql);
            $exec = $res->execute(array(":nom," => $nom, ":prenom," => $prenom, ":mail," => $mail, ":pword," => $crypt_pword, ":date_creation," => $date_creation, ":date_connexion," => $date_connexion));

            if ($exec) {
                echo 'Données insérées';
            } else {
                echo "Échec de l'opération d'insertion";
            }


            exit;
        }
    }
}



?>



<!doctype html>
<html lang="fr">

<head>
    <title>Inscription</title>
    <?php
    require_once('head/meta.php');
    require_once('head/script.php');
    require_once('head/link.php');
    ?>

</head>

<body>
    <?php
    require_once('menu/menu.php');
    ?>


    <div class="container-sm">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Inscription</h1>
                <form method="post" action="">
                    <div class="sm-3">
                        <?php if (isset($err_nom)) {
                            echo '<div>' . $err_nom . '</div>';
                        } ?>
                        <label class="form-label">Nom</label>
                        <input class="form-control" type="text" name="nom" value="<?php if (isset($nom)) {
                                                                                        echo $nom;
                                                                                    } ?>" />
                    </div>
                    <div class="sm-3">
                        <?php if (isset($err_prenom)) {
                            echo '<div>' . $err_prenom . '</div>';
                        } ?>
                        <label class="form-label">Prénom</label>
                        <input class="form-control" type="text" name="prenom" value="<?php if (isset($prenom)) {
                                                                                            echo $prenom;
                                                                                        } ?>" />
                    </div>
                    <div class="sm-3">
                        <?php if (isset($err_mail)) {
                            echo '<div>' . $err_mail . '</div>';
                        } ?>
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="mail" value="<?php if (isset($mail)) {
                                                                                        echo $mail;
                                                                                    } ?>" />
                    </div>
                    <div class="sm-3">
                        <label class="form-label">Confirmation du mail</label>
                        <input class="form-control" type="email" name="confmail" value="<?php if (isset($confmail)) {
                                                                                            echo $confmail;
                                                                                        } ?>" />
                    </div>
                    <div class="sm-3">
                        <?php if (isset($err_pword)) {
                            echo '<div>' . $err_pword . '</div>';
                        } ?>
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="pword" value="<?php if (isset($pword)) {
                                                                                            echo $pword;
                                                                                        } ?>" />
                    </div>
                    <div class="sm-3">
                        <label class="form-label">Confirmation du mot de passe</label>
                        <input class="form-control" type="password" name="confpassword" value="" placeholder="mot de passe" />
                    </div>
                    <div class="sm-3">
                        <button type="submit" name="inscription" class="btn btn-outline-dark">Inscription</button>
                    </div>
            </div>
        </div>
    </div>

    </form>




    <?php
    require_once('footer/footer.php');
    ?>
</body>

</html>
