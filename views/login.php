<?php
include 'template.php';
require_once(dirname(__FILE__) . '/../controllers/ControllerSession.php');
ControllerSession::OpenSession();
start_page('E-event.io | Connexion');
?>

    <form class="login" action="/index.php?controllers=ControllerSignup&action=readLogin" method="post">
        <span class="login-title">Connexion</span>

        <div class="form-group">
            <label for="inputMail">Identifiant</label>
            <input type="text" class="form-control" id="inputMail" name="login" placeholder="Identifiant" required>
        </div>
        <div class="form-group">
            <label for="inputMDP">Mot de passe</label>
            <input type="password" class="form-control" id="inputMDP" name="password" placeholder="Mot de passe" required>
        </div>
        <div class="form-group">
            <label class="rememberMe"><input type="checkbox">Se souvenir de moi</label>
        </div>
        <div class="form-button">
            <button type="submit" name="action" >SE CONNECTER</button>
            <a href="forgot_password.php">MOT DE PASSE OUBLIÉ</a>
        </div>

        <p>Vous n'avez pas encore de compte ? <a class="button_forgot" href="signup.php"> Inscrivez vous</a></p>

    </form>
<?php
end_page();
?>