<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';
start_page('E-event.io | Modifiez votre mot de passe');

if(($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'donateur')){?>
    <form class="signup" action="/index.php" method="post">
        <span class="force-title">Dis donc ! C'est la première fois que vous vous connectez ?</span>
        <p>Par sécurité, modifiez votre mot de passe dès maintenant pour avoir accès pleinement au site</p>

        <div class="form-group">
            <label for="inputName">Nouveau Mot de Passe</label>
            <input type="password" class="form-control" name="mdp" placeholder="Renseignez votre nouveau mot de passe" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputFirstName">Confirmation Nouveau Mot de Passe</label>
            <input type="password" class="form-control" name="mdp2" placeholder="Confirmez votre nouveau mot de passe" spellcheck="false" required>
        </div>


        <div class="form-button">
            <button type="submit" name="action">MODIFIER MON MOT DE PASSE</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readChangePass">
        </div>

    </form><?php
}
else{
    Alerts::PermissionDenied();
}

end_page();
?>