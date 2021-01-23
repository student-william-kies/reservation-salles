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

?>

<?php $css = "css/reservation.css"; ?>

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
                    <li class="nav-item"><a href="reservation.php?allEvent=" class="nav-link text-uppercase font-weight-bold">Réservations</a></li>
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
        <section class="container">
                <h2 style="color: #fff"><?= $_SESSION['login'] ?>, voici vos réservations</h2>
            <section class="container-fluid main-content">
                <table>
                    <tbody>
                    <tr>
                        <?php

                        $reservations = new Calendrier();
                        $contain = $reservations -> showClickEvent();

                        foreach ($contain as $result)
                        {
                            foreach ($result as $key => $value)
                            {
                                echo ($key .  ' : ' . $value . '<br />');
                            }
                        }

                        if (isset($_GET['allEvent']))
                        {
                            $contain = $reservations -> showAllEvents();

                            foreach ($contain as $result)
                            {
                                foreach ($result as $key => $value)
                                {
                                    echo ($key .  ' : ' . $value . '<br />');
                                }
                            }
                        }

                        if (isset($_GET['createNewEvent']))
                        {
                            Http::redirect('reservation-form.php');
                        }

                        if (isset($_GET['deleteEvents']))
                        {
                            $reservations -> deleteAllEvent();
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
            </section>
            <form action="reservation.php" method="get">
                <button type="submit" name="allEvent" class="btn btn-primary">Voir toute mes réservations</button>
                <button type="submit" name="createNewEvent" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                <button type="submit" name="deleteEvents" class="btn btn-primary" onclick="return confirm('Etes vous sûre de vouloir supprimer cette valeur ?');"><i class="fas fa-minus"></i></button>
            </form>
        </section>
    </article>
</main>

<?php $content = ob_get_clean(); ?>

<?php require("../layout.php");?>
