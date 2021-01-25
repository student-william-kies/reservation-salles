<?php
require_once ('../../libraries/autoload.php');
session_start();

if (isset($_POST['logout'])){

    session_destroy();
    Http::redirect('connection.php');
    exit();
}

?>

<?php $css = ""; ?>

<?php ob_start(); ?>

<!-- Header de la page -->
<header>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <section class="container">
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <section id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="#" class="nav-link text-uppercase font-weight-bold">Home</a></li>
                    <li class="nav-item"><a href="planning.php" class="nav-link text-uppercase font-weight-bold">Planning</a></li>
                    <li class="nav-item"><a href="reservation-form.php" class="nav-link text-uppercase font-weight-bold">Réserver</a></li>
                    <?php if (!isset($_SESSION['id'])){echo '<li class="nav-item"><a href="registration.php" class="nav-link text-uppercase font-weight-bold">Inscription</a></li><li class="nav-item"><a href="connection.php" class="nav-link text-uppercase font-weight-bold">Connexion</a></li>';} ?>
                    <?php if (isset($_SESSION['id'])){echo '<li class="nav-item"><a href="profil.php" class="nav-link text-uppercase font-weight-bold">Profil</a></li>';} ?>
                    <?php if(isset($_SESSION['id'])){echo '<form method="POST" action="index.php"><input type="submit" name="logout" value="Déconnexion" class="btn btn-danger"></form>';} ?>
                </ul>
            </section>
        </section>
    </nav>
</header>

<main>
    <article>
        <section class="container top-left">
            <img src="images/project-logo.svg" class="img-fluid index-logo" alt="Logo Project">
            <section class="container main-info">
                <?php if(!isset($_SESSION['id'])) {echo '<h1>Deluxe Room</h1><p>Le meilleur endroit pour vos séjours</p>';}else{echo '<h1 style="text-transform: uppercase; margin-top: 1.5%;">' . $_SESSION['login'] . ',</h1>';} ?>
            </section>
            <section class="container main-desc">
                <h2>Découvrez de bonnes affaires et réservez !</h2>
                <p>Réservez dès maintenant une salle, que cela soit pour une fête, anniversaire, mariage, ou tout
                   autres évènements, les meilleurs prix et la meilleures qualité se trouvent ici !<br />
                   PARIS - 7e
                </p>
            </section>
        </section>
        <section class="container bottom-left">
            <section class="container second-info">
                <h1>Réservez une salle</h1>
                <p>Vous souhaitez la salle de vos rêves ? Alors rendez-vous à la page dédiée aux réservations, et écrivez votre histoire !</p>
                <section class="col">
                    <a href="reservation-form.php" class="col btn btn-pink-moon" role="button">Réservez une salle dès maintenant ! <i class="fas fa-arrow-right"></i></a>
                </section>
            </section>
        </section>
    </article>
</main>

<?php $content = ob_get_clean(); ?>

<?php require("../layout.php");?>