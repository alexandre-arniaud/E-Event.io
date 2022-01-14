<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
start_page('E-event.io | La fête ne fait que commencer');
?>

    <div class="container">
        <img src="../assets/img/logo2.png" alt="Logo de E-event.io n°2">

        <?php
            if (ControllerSession::is_admin() or ControllerSession::is_donateur() or ControllerSession::is_jury() or ControllerSession::is_organisateur())
            {
                echo '';
            }
            else
            {
                echo '        
                <div class="form-button">
                    <a href="login.php">SE CONNECTER</a>
                    <a href="signup.php">S\'INSCRIRE</a>
                </div>
            ';
            }
        ?>
    </div>

<?php
end_page();
?>
