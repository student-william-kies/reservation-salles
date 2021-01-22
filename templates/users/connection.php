<?php
require_once ('../../libraries/autoload.php');

/**
 * 1. Etablie la connexion de l'utilisateur et le démarrage de la $_SESSION
 */
if (isset($_POST['signin']))
{
    /**
     * 2. Démarrage de la session et de la création d'un objet permettant la connexion de l'utilisateur
     */
    session_start();
    $userConnect = new User();
    $userConnect -> connect();
}

?>

<?php $css = "css/connection.css"; ?>

<?php ob_start(); ?>

<section class="container form-info">
    <section class="card">
        <section class="content">
            <h2>Connexion</h2>
            <form action="connection.php" method="post" id="login-form" class="login-form">
                <h1 class="a11y-hidden">Login Form</h1>

                <!-- Personnage animé -->
                <figure aria-hidden="true">
                    <section class="person-body"></section>
                    <section class="neck skin"></section>
                    <section class="head skin">
                        <section class="eyes"></section>
                        <section class="mouth"></section>
                    </section>
                    <section class="hair"></section>
                    <section class="ears"></section>
                    <section class="shirt-1"></section>
                    <section class="shirt-2"></section>
                </figure>

                <div>
                    <label class="label-login">
                        <input type="text" class="text" name="login" placeholder="Login" tabindex="1" required />
                        <span class="required">Login</span>
                    </label>
                </div>

                <input type="checkbox" name="show-password" class="show-password a11y-hidden" id="show-password" tabindex="3" />
                <label class="label-show-password" for="show-password">
                    <span>Show Password</span>
                </label>

                <div>
                    <label class="label-password">
                        <input type="text" class="text" name="password" placeholder="Password" tabindex="2" required />
                        <span class="required">Password</span>
                    </label>
                </div>

                <input type="submit" id="signin" name="signin" value="Log In" />

                <section class="account">
                    <a href="registration.php">Pas de compte?</a>
                    <a href="index.php">Return to Home</a>
                </section>
            </form>
        </section>
    </section>
</section>

<!-- JS -->
<script type="text/javascript" src="js/vanilla-tilt.min.js"></script>
<script> VanillaTilt.init(document.querySelectorAll(".card"),{ max: 2, speed: 400, glare: true, "max-glare": 0.2, }); </script>

<?php $content = ob_get_clean(); ?>

<?php require('../layout.php'); ?>
