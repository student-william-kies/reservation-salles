<?php
require_once ('../../libraries/autoload.php');
session_start();

if (isset($_POST['logout']))
{
    session_destroy();
    Http::redirect('connection.php');
    exit();
}

?>

<?php $css = "css/profil.css"; ?>

<?php ob_start(); ?>

<!-- Header de la page -->
<header>
    <nav class="navbar navbar-expand-lg py-3">
        <section class="container">
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <section id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.php" class="nav-link text-uppercase font-weight-bold">Home</a></li>
                    <li class="nav-item"><a href="caca.php" class="nav-link text-uppercase font-weight-bold">Planning</a></li>
                    <li class="nav-item"><a href="booking.html.php" class="nav-link text-uppercase font-weight-bold">Réservations</a></li>
                    <?php if (!isset($_SESSION['id'])){echo '<li class="nav-item"><a href="registration.php" class="nav-link text-uppercase font-weight-bold">Inscription</a></li><li class="nav-item"><a href="connection.php" class="nav-link text-uppercase font-weight-bold">Connexion</a></li>';} ?>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Profil</a></li>
                    <?php if(isset($_SESSION['id'])){echo '<form method="POST" action="index.php"><input type="submit" name="logout" value="Déconnexion" class="btn btn-danger"></form>';} ?>
                </ul>
            </section>
        </section>
    </nav>
</header>

<main>
    <article>
        <section class='background'>
            <section class='thisContainer'>
                <section class='screen'>
                    <section class='screen-header'></section>
                    <form class='screen-body' action="profil.php" method="post">
                        <section class='screen-body-item left'>
                            <section class='app-title'>
                                <span>GESTION DU</span>
                                <span>PROFIL</span>
                            </section>
                            <section class='app-contact'>CONTACT INFO : william.kies@laplateforme.io</section>
                        </section>

                        <section class='screen-body-item'>
                            <section class='app-form-group'>
                                <label for='name'></label>
                                <input type='text' class='app-form-control' style="font-size: 22px; text-transform: uppercase;" id='name' value="<?php echo $_SESSION['login']; ?>" disabled>
                            </section>
                            <section class='app-form-group'>
                                <label for='newLogin'></label>
                                <input type='text' class='app-form-control' id='newLogin' name='newLogin' placeholder='LOGIN' required>
                            </section>
                            <section class='app-form-group'>
                                <label for='newPassword'></label>
                                <input type='password' class='app-form-control' id='newPassword' name='newPassword' placeholder='NEW PASSWORD' required>
                            </section>
                            <section class='app-form-group'>
                                <label for='newConfirmPassword'></label>
                                <input type='password' class='app-form-control' id='newConfirmPassword' name='newConfirmPassword' placeholder='CONFIRM NEW PASSWORD' required>
                            </section>
                            <section class='app-form-group buttons'>
                                <label for='modify'></label>
                                <button type='submit' id='modify' name='modify' class='app-form-button'>VALIDER</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </article>
</main>

<?php
    $content = ob_get_clean();

    if (isset($_POST['modify']))
    {
        $updateUser = new User();
        $updateUser -> update();
    }

?>

<?php require("../layout.php");?>
