<?php
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Member.php';


function start_page($title)
{
    session_start();
    if (isset($_SESSION['id_member'])) {
        $_SESSION['role'] = Member::updateSession($_SESSION['id_member'])[0];
        $_SESSION['points'] = Member::updateSession($_SESSION['id_member'])[1];
    }

    ?> <!DOCTYPE html>
    <html lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <link rel="icon" type="image/gif" href="/assets/img/favicon.ico" />
        <?php
        if ($title == 'E-event.io | Connexion')
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/login.css">');
        }
        else if ($title == 'E-event.io | Inscription' || $title == 'E-event.io | Modification du mot de passe' || $title == 'E-event.io | Créer un évènement'
        || $title == 'E-event.io | Modifiez votre mot de passe' || $title == 'E-event.io | Créer une campagne')
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/signup.css">');
        }
        else if ($title == 'Admin')
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/validation.css">');
        }
        else if ($title == 'E-event.io')
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/alerts.css">');
        }
        else
        {
            print ('<link rel="stylesheet" type="text/css" href="../assets/css/style.css">');
        }?>
    </head>
    <body>
    <?php


    if ((($_SESSION['is_pass_change'] == 0) && ($title != 'E-event.io | Modifiez votre mot de passe')) ||( $_SESSION['is_pass_change'] == 1 )) {
        if (ControllerSession::is_admin()) {
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="../views/accueil.php">Accueil</a>
            <a class="navbar-infos-items" href="../views/newEvent.php">Créer un évènement</a>
            <a class="navbar-infos-items" href="../views/newCampaign.php">Créer une campagne</a>
            <a class="navbar-infos-items" href="../views/choice_jury.php">Choix du jury</a>
            <a class="navbar-infos-items" href="../views/myEvent.php">Mon Evenement</a>
            <a class="navbar-infos-items" href="../views/event_win.php">Evènements gagnants</a>';


            if (isset($_SESSION['nom'])) {
                echo '<li class="deroulant"><a class="deroulant-title">' . $_SESSION['prenom'] . '</a>
                              <ul class="sous">
                                  <li><a href="../views/myAccount.php">Mon compte</a></li>
                                  <li><a class="navbar-infos-items" href="../views/admin_validation.php">Validation des inscriptions</a></li>
                                  <li><a class="navbar-infos-items" href="../views/gestionnaire_role.php">Gestion des roles</a></li>
                                  <li><a href="../index.php?controllers=ControllerUser&action=deleteSession">Déconnexion</a></li>
                              </ul>
                          </li>';
            } else {
                echo '<a class="navbar-infos-items" href="../views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
        }


        elseif (ControllerSession::is_jury()) {
            echo '<header class="header">
                    <img src="../assets/img/logo.png" alt="Logo de E-event.io">
                    <div class="navbar-infos">
                        <a class="navbar-infos-items" href="../views/accueil.php">Accueil</a>
                        <a class="navbar-infos-items" href="../views/choice_jury.php">Choix du jury</a>
                        <a class="navbar-infos-items" href="../views/event_win.php">Evènements gagnants</a>';



            if (isset($_SESSION['nom'])) {
                echo '<li class="deroulant"><a class="deroulant-title">' . $_SESSION['prenom'] . '</a>
                              <ul class="sous">
                                  <li><a href="../views/myAccount.php">Mon compte</a></li>
                                  <li><a href="../index.php?controllers=ControllerUser&action=deleteSession">Déconnexion</a></li>
                              </ul>
                          </li>';
            } else {
                echo '<a class="navbar-infos-items" href="../views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
        }


        elseif (ControllerSession::is_organisateur()) {
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="../views/accueil.php">Accueil</a>
            <a class="navbar-infos-items" href="../views/myEvent.php">Mon Evènement</a>
            <a class="navbar-infos-items" href="../views/event_win.php">Evènements gagnants</a>';

            if (isset($_SESSION['nom'])) {
                echo '<li class="deroulant"><a class="deroulant-title">' . $_SESSION['prenom'] . '</a>
                              <ul class="sous">
                                  <li><a href="../views/myAccount.php">Mon compte</a></li>
                                  <li><a href="../index.php?controllers=ControllerUser&action=deleteSession">Déconnexion</a></li>
                              </ul>
                          </li>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
        }


        elseif (ControllerSession::is_donateur()) {
            echo '<header class="header">
        <img src="../assets/img/logo.png" alt="Logo de E-event.io">
        <div class="navbar-infos">
            <a class="navbar-infos-items" href="../views/accueil.php">Accueil</a>
            <a class="navbar-infos-items" href="../views/newEvent.php">Créer un évènement</a>
            <a class="navbar-infos-items" href="../views/event_win.php">Evènements gagnants</a>';

            if (isset($_SESSION['nom'])) {
                echo '<li class="deroulant"><a class="deroulant-title">' . $_SESSION['prenom'] . '</a>
                          <ul class="sous">
                              <li><a href="../views/myAccount.php">Mon compte</a></li>
                              <li><a href="../index.php?controllers=ControllerUser&action=deleteSession">Déconnexion</a></li>
                          </ul>
                      </li>';
            } else {
                echo '<a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
            }
            echo '</div>
    </header>';
        }


        else {
            echo '
        <header class="header">
            <img src="../assets/img/logo.png" alt="Logo de E-event.io">
            <div class="navbar-infos">
                <a class="navbar-infos-items" href="/views/accueil.php">Accueil</a>
                <a class="navbar-infos-items" href="../views/event_win.php">Evènements gagnants</a>
                <a class="navbar-infos-items" href="/views/login.php">Se connecter</a>';
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