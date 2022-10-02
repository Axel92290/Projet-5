<?php
require_once('../include.php');

if (!isset($_GET['id'])) {
    header('Location : post.php');
    exit;
}

$get_id_post = (int) $_GET['id'];

if ($get_id_post <= 0) {
    header('Location : post.php');
    exit;
}

$req = $DB->prepare("SELECT * FROM post WHERE id = ?");

$req->execute([$get_id_post]);

$req_post = $req->fetch();

$req = $DB->prepare("SELECT * FROM topics WHERE id_post = ? ORDER BY date_creation DESC");

$req->execute([$get_id_post]);

$req_list_topics = $req->fetchAll();


?>

<!doctype html>
<html lang="fr">

<head>
    <title>Post - <?= $req_post['titre'] ?></title>
    <?php
    require_once('../head/meta.php');
    require_once('../head/link.php');
    require_once('../head/script.php');
    ?>


</head>

<body>
    <?php
    require_once('../menu/menu.php');
    ?>
    <div class="container-sm">
        <div class="row">
            <div class="col-12">
                <h1><?= $req_post['title'] ?></h1>
            </div>
            <?php
            foreach ($req_list_topics as $rlt) {

            ?>

                <div class="col-3">
                    <?= $rlt['titre']; ?> <br>
                    <a href="post/list-topics.php?id=<?= $rlt['id'] ?>">Voir les topics</a>
                </div>
            <?php
            }
            ?>


            <?php
            require_once('../footer/footer.php');
            ?>
</body>

</html>