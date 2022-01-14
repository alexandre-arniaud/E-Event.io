<?php
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
session_start();
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
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/login.css">');
        }
        else if ($title == 'E-event.io | Inscription' || $title == 'E-event.io | Modification du mot de passe' || $title == 'E-event.io | Ajouter un évènement')
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/signup.css">');
        }
        else if ($title == 'Admin')
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/validation.css">');
        }
        else
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/style.css">');
        }?>
    </head>
    <body>
    <?php


    if (ControllerSession::is_admin()){
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="./index.php">Accueil</a>
            <a class="navbar-infos-items" href="newEvent.php">Évènements</a>
            <a class="navbar-infos-items" href="admin_validation.php">Validation</a>
            <a class="navbar-infos-items" href="gestionnaire_role.php">Gestion des roles</a>
            <a class="navbar-infos-items">En savoir plus</a>';

            if (isset($_SESSION['nom'])) {
                echo '<a class="navbar-infos-items" href="../index.php?controllers=ControllerUser&action=deleteSession">Se déconnecter</a>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
    }


    elseif (ControllerSession::is_jury()){
            echo '<header class="header">
                    <img src="../assets/img/logo.png" alt="Logo de E-event.io">
                    <div class="navbar-infos">
                        <a class="navbar-infos-items" href="./index.php">Accueil</a>
                        <a class="navbar-infos-items" href="newEvent.php">Évènements</a>
                        <a class="navbar-infos-items">En savoir plus</a>';
            if (isset($_SESSION['nom'])) {
                echo '<a class="navbar-infos-items" href="../index.php?controllers=ControllerUser&action=deleteSession">Se déconnecter</a>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
    }


    elseif (ControllerSession::is_organisateur()){
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="./index.php">Accueil</a>
            <a class="navbar-infos-items" href="newEvent.php">Évènements</a>
            <a class="navbar-infos-items">En savoir plus</a>';

            if (isset($_SESSION['nom'])) {
                echo '<a class="navbar-infos-items" href="../index.php?controllers=ControllerUser&action=deleteSession">Se déconnecter</a>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
    }


    elseif (ControllerSession::is_donateur()){
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="./index.php">Accueil</a>
            <a class="navbar-infos-items" href="newEvent.php">Évènements</a>
            <a class="navbar-infos-items">En savoir plus</a>';

            if (isset($_SESSION['nom'])) {
                echo '<a class="navbar-infos-items" href="../index.php?controllers=ControllerUser&action=deleteSession">Se déconnecter</a>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
    }


    else {
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="./index.php">Accueil</a>
            <a class="navbar-infos-items" href="newEvent.php">Évènements</a>
            <a class="navbar-infos-items">En savoir plus</a>';

            if (isset($_SESSION['nom'])) {
                echo '<a class="navbar-infos-items" href="../index.php?controllers=ControllerUser&action=deleteSession">Se déconnecter</a>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
        }
}
?>


<?php
function end_page()
{
    ?> </body>
    </html>
    <?php
}