<?php
require_once('include.php');

if (!empty($_REQUEST)) {
    extract($_REQUEST);

    $valid = (bool) true;



    if (isset($_REQUEST['inscription'])) {
        $nom = ucfirst(trim($nom));
        $prenom = ucfirst(trim($prenom));
        $mail = trim($mail);
        $confmail  = trim($confmail);
        $pword = trim($pword);
        $confpassword  = trim($confpassword);

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
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $err_mail = "Le format du mail est invalide.";
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

            $crypt_pword = password_hash($pword, PASSWORD_ARGON2ID);
            $date_creation = date('Y-m-d H:i:s');
            $date_connexion = date('Y-m-d H:i:s');


            $req = $DB->prepare("INSERT INTO utilisateur(nom, prenom, mail, pword, date_creation, date_connexion) VALUES (?, ?, ?, ?, ?, ?)");
            $req->execute(array($nom, $prenom, $mail, $crypt_pword, $date_creation, $date_connexion));

            header('Location: form_connexion.php');
            exit;
        }
    }
}
