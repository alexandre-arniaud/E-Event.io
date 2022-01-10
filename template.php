<?php
function start_page($title)
{
    ?> <!DOCTYPE html>
    <html lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <?php
        if ($title == 'E-event.io | Connexion')
        {
            print ('<link rel="stylesheet" type="text/css" href="login.css">');
        }
        else if ($title == 'E-event.io | Inscription')
        {
            print ('<link rel="stylesheet" type="text/css" href="signup.css">');
        }
        else
        {
            print ('<link rel="stylesheet" type="text/css" href="style.css">');
        }?>
    </head>
    <body>
    <header class="header">
        <img src="./assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="index.php">Accueil</a>
            <a class="navbar-infos-items">Événements</a>
            <a class="navbar-infos-items">En savoir plus</a>
            <a class="navbar-infos-items" href="login.php">Se connecter</a>
        </div>
    </header>
    <?php
}
function end_page()
{
    ?> </body>
    </html>
    <?php
}
?>
<?php end_page();
?>