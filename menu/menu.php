<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (!isset($_SESSION)) {

                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="form_registration.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form_connexion.php">Connexion</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                    </li>
                <?php
                } ?>



            </ul>
        </div>
    </div>
</nav>