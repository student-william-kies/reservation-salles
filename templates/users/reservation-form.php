<?php
require_once ('../../libraries/autoload.php');

session_start();

if (isset($_POST['logout']))
{
    session_destroy();
    Http::redirect('connection.php');
    exit();
}

if (!isset($_SESSION['id']))
{
    Http::redirect('connection.php');
}

$createEvent = new Event();
$createEvent -> newEvent();

?>

<?php $css = "css/reservation-form.css"; ?>

<?php ob_start(); ?>

<!-- Header de la page -->
<header>
    <nav class="navbar navbar-expand-lg py-3">
        <section class="container">
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <section id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.php" class="nav-link text-uppercase font-weight-bold">Home</a></li>
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
        <!-- Card -->
        <section class="card shadow mb-5 bg-white rounded">
            <!-- Card-Body -->
            <section class="card-body">
                <form action="reservation-form.php" method="post">
                    <!-- Card-Title -->
                    <p class="card-title text-center shadow mb-5 rounded">Réservez la salle de vos rêves !</p>
                    <section class="icons text-center">
                        <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                    </section>
                    <hr>
                    <p><strong>VOTRE RESERVATION</strong></p>
                    <!-- First Row -->
                    <section class="row">
                        <section class="col-sm-6 mb-4">
                            <label for="title"></label>
                            <input type="text" name="title" id="title" placeholder="Titre Réservation" maxlength="40" style="width: 100%;" required>
                        </section>
                        <section class="col-sm-6">
                            <label for="desc"></label>
                            <input type="text" name="desc" id="desc" placeholder="Description Réservation" maxlength="60" style="width: 100%;" required>
                        </section>
                    </section>
                    <!-- Second Row -->
                    <section class="row">
                        <section class="col-sm-6">
                            <label for="start">De :</label>
                            <input type="datetime-local" name="start" id="start" style="width: 100%;" class="mb-4" required>
                        </section>
                        <section class="col-sm-6">
                            <label for="end">À :</label>
                            <input type="datetime-local" name="end" id="end" style="width: 100%;" class="mb-4" required>
                        </section>
                    </section>
                    <input type="submit" class="btn btn-primary float-right mt-5" name="reservation" id="reservation" value="Réserver">
                </form>
            </section>
        </section>
    </article>
</main>

<?php $content = ob_get_clean(); ?>

<?php require("../layout.php");?>
