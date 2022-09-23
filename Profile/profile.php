<?php
require_once('../include.php');

if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit;
}

$req = $DB->prepare("SELECT * FROM utilisateur WHERE id = ?");

$req->execute([$_SESSION['id']]);

$req_user = $req->fetch();

switch ($req_user['role']) {
    case 0:
        $role = "Utilisateur";
        break;

    case 1:
        $role = "Super Admin";
        break;

    case 2:
        $role = "Admin";
        break;

    case 3:
        $role = "Modérateur";
        break;
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

    <title>Profil de <?= $req_user['prenom'] ?> </title>
</head>

<body>
    <?php
    require_once('../menu/menu.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1> <?= $req_user['prenom'] ?> <?= $req_user['nom'] ?></h1>

                <div>
                    Date d'inscription : <?= $req_user['date_creation'] ?>
                </div>

                <div>
                    Date de dernière connexion : <?= $req_user['date_connexion'] ?>
                </div>

                <div>
                    Rôle utilisateur : <?= $role ?>
                </div>





            </div>


        </div>

    </div>

    <?php
    require_once('../footer/footer.php');
    ?>
</body>

</html>