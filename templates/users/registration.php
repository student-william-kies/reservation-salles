<?php
require_once ('../../libraries/autoload.php');

/**
 * 1. Vérification de la complétion du formulaire
 */
if (isset($_POST['register']))
{
    /**
     * 2. Création d'un objet qui appel la méthode register()
     */
    $CreateUser = new User();
    $CreateUser -> register();
}

?>

<?php $css = "css/registration.css"; ?>

<?php ob_start(); ?>

<main>
    <article>
        <section class="container right-content">
            <section class="get-in-touch">
                <h1 class="title">Création de votre compte</h1>
                <form action="registration.php" method="POST" class="contact-form row">
                    <section class="form-field col-lg-6">
                        <input type="text" class="input-text" id="login" name="login" required>
                        <label class="label" for="login">Login</label>
                    </section>
                    <section class="form-field col-lg-6 "></section>
                    <section class="form-field col-lg-6 ">
                        <input type="password" class="input-text" id="password" name="password" required>
                        <label class="label" for="password">Password</label>
                    </section>
                    <section class="form-field col-lg-6 "></section>
                    <section class="form-field col-lg-6 ">
                        <input type="password" class="input-text" id="confirmPassword" name="confirmPassword" required>
                        <label class="label" for="confirmPassword">Confirm Password</label>
                    </section>
                    <section class="form-field col-lg-12">
                        <input type="submit" class="submit-btn" id="register" name="register" value="Créer">
                    </section>
                    <p>Vous avez déjà un compte ? <a href="connection.php">Connectez-vous ici !</a></p>
                </form>
                <a href="index.php" id="return-home">Return to home</a>
            </section>
        </section>
    </article>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('../layout.php');?>