<?php
require_once('include.php');

if (isset($_SESSION['id'])) {

    header('Location : index.php');
    exit;
}

if (!empty($_REQUEST)) {
    extract($_REQUEST);

    $valid = (bool) true;


    if (isset($_REQUEST['connexion'])) {
        $mail = trim($mail);
        $pword = trim($pword);

        if (empty($mail)) {
            $valid = false;
            $err_mail = "Ce champ ne peut pas être vide";
        }

        if (empty($pword)) {
            $valid = false;
            $err_pword = "Ce champ ne peut pas être vide";
        }



        if ($valid) {
            $req = $DB->prepare("SELECT pword FROM utilisateur WHERE mail =?");
            $req->execute(array($mail));

            $req = $req->fetch();

            if (isset($req['pword'])) {
                if (!password_verify($pword, $req['pword'])) {
                    $valid = false;
                    $err_pword = "Les informations rentrées sont incorrectes.";
                }
            } else {
                $valid = false;
                $err_pword = "Les informations rentrées sont incorrectes.";
            }
        }


        if ($valid) {
            $req = $DB->prepare("SELECT * FROM utilisateur WHERE mail =?");
            $req->execute(array($mail));

            $req_user = $req->fetch();

            if (isset($req_user['id'])) {
                $date_connexion = date('Y-m-d H:i:s');


                $req = $DB->prepare("UPDATE utilisateur SET date_connexion = ? WHERE id = ?");
                $req->execute(array($date_connexion, $req_user['id']));

                $_SESSION['id'] = $req_user['id'];
                $_SESSION['prenom'] = $req_user['prenom'];
                $_SESSION['mail'] = $req_user['mail'];
                $_SESSION['role'] = $req_user['role'];

                header('Location: index.php');
                exit;
            } else {
                $valid = false;
                $err_pword = "Les informations rentrées sont incorrectes.";
            }
        }
    }
}
