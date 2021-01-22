<?php
require_once ('../../libraries/autoload.php');

session_start();

if (isset($_POST['logout']))
{
    session_destroy();
    Http::redirect('connection.php');
    exit();
}

$calendar = new Calendrier();

?>

<?php $css = "css/planning.css"; ?>

<?php ob_start(); ?>

    <!-- Header de la page -->
    <header>
        <section class="sidebar-container">
            <section class="sidebar-logo"><img src="images/project-logo.svg" class="img-fluid index-logo" alt="Logo Project">Deluxe Room</section>
            <ul class="sidebar-navigation">
                <li class="header">Voyez par vous-même</li>
                <li class="nav-item active"><a href="index.php" class="nav-link text-uppercase font-weight-bold">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Planning</a></li>
                <li class="nav-item"><a href="reservation.html.php" class="nav-link text-uppercase font-weight-bold">Réservations</a></li>
                <li class="header">Espace compte</li>
                <?php if (!isset($_SESSION['id'])){echo '<li class="nav-item"><a href="connection.php" class="nav-link text-uppercase font-weight-bold">Connexion</a></li><li class="nav-item"><a href="registration.php" class="nav-link text-uppercase font-weight-bold">Inscription</a></li>';} ?>
                <?php if (isset($_SESSION['id'])){echo '<li class="nav-item"><a href="profil.php" class="nav-link text-uppercase font-weight-bold">Profil</a></li>';} ?>
                <?php if(isset($_SESSION['id'])){echo '<form method="POST" action="index.php"><input type="submit" name="logout" value="Déconnexion" class="btn btn-danger logout"></form>';} ?>
            </ul>
        </section>
    </header>

    <main>
        <article>
            <section class="container calendar__section">
                <table class="container calendar__table">
                    <thead>
                    <tr>
                        <th>Heures/Jours</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($hour = 8; $hour <= 19; $hour++)
                    {
                        echo '<tr></tr>';
                        for ($day = 0; $day <= 5; $day++)
                        {
                            if ($day == 0)
                            {
                                echo '<td>' . $hour . ':00 </td>';
                            }
                            else
                            {
                                $calendar -> showEvents($day, $hour);
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </section>
        </article>
    </main>

<?php $content = ob_get_clean(); ?>

<?php require("../layout.php");?>