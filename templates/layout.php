<!-- layout (aussi appelé gabarit) de page. On va y retrouver toute la structure de la page, avec des "trous" à remplir. -->

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset=UTF-8">
        <title>Deluxe Room, BEST RESERVATION DELUXES ROOMS</title>
        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href= <?= $css ?> >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- ICO -->
        <link rel="icon" href="images/project-logo.ico">
    </head>

    <!-- Partie principale de la page -->
    <body>
        <?= $content ?>
    </body>

    <!-- Footer de la page -->
    <footer>
        <section class="page-footer font-small fixed-bottom">
            <section class="footer-copyright text-center py-3">© 2020 Copyright
                <a href="">WilliamKies</a>
            </section>
        </section>
    </footer>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>