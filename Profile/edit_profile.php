<?php
require_once('../include.php');

if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit;
}

$req = $DB->prepare("SELECT * FROM utilisateur WHERE id = ?");

$req->execute([$_SESSION['id']]);


$req_user = $req->fetch();

if (!empty($_REQUEST)) {
    extract($_REQUEST);

    $valid = true;

    if (isset($_REQUEST['form1'])) {
        $mail = strip_tags($_REQUEST['mail']);

        var_dump($mail);

        if ($mail == $_SESSION['mail']) {
            $valid = false;
        } elseif (!isset($mail)) {
            $valid = false;
            $err_mail = "Ce champ ne peut être vide";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $err_mail = "Le format du mail est invalide.";
        } else {
            $req = $DB->prepare("SELECT id FROM utilisateur WHERE mail = ?");
            $req->execute([$mail]);
            $req = $req->fetch();

            if (isset($req['id'])) {

                $valid = false;
                $err_mail = "Ce mail est déjà pris";
            }
        }



        if ($valid) {

            $req =  $DB->prepare('UPDATE utilisateur SET mail = ? WHERE id = ?');
            $req->execute([$mail, $_SESSION['id']]);

            $_SESSION['mail'] = $mail;

            header('Location : Profile/edit_profile.php');
            exit;
        }
    } elseif (isset($_REQUEST['form2'])) {
    }

    if (!isset($mail)) {
        $mail = $req_user['mail'];
    }
}

?>


<!doctype html>
<html lang="fr">

<head>
    <?php
    require_once('../head/meta.php');
    require_once('../head/script.php');
    require_once('../head/link.php');
    ?>

    <title>Modifier mon profil</title>
</head>

<body>
    <?php
    require_once('../menu/menu.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Modifier mes informations</h1>

                <form method="post">
                    <div class="mb-3">
                        <?php if (isset($err_mail)) {
                            echo '<div>' . $err_mail . '</div>';
                        } ?>
                        <input class="form-control" type="email" name="mail" value="" placeholder="Mail" />
                    </div>

                    <div class="mb-3">
                        <input class="btn btn-outline-dark" type="submit" name="form1" value="Modifier" />
                    </div>
                </form>

                <form method="post">

                    <div class=mb-3>
                        <input class="form-control" type="password" name="oldpword" placeholder="Ancien Mot de passe" value="" />
                    </div>

                    <div class=mb-3>
                        <input class="form-control" type="password" name="newpword" placeholder="Nouveau Mot de passe" value="" />
                    </div>

                    <div class=mb-3>
                        <input class="form-control" type="password" name="confpword" placeholder="Confirmation du Mot de passe" value="" />
                    </div>

                    <div class=mb-3>
                        <input class="btn btn-outline-dark" type="submit" name="form2" value="Modifier" />
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php
    require_once('../footer/footer.php');
    ?>
</body>

</html>