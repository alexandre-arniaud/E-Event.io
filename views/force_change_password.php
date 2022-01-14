<?php
include 'template.php';
start_page('E-event.io | Modifiez votre mot de passe');
?>

    <form class="signup" action="/index.php" method="post">
        <span class="signup-title">Dis donc ! C'est la première fois que vous vous connectez ?</span>
        <p>Par sécurité, modifiez votre mot de passe dès maintenant pour avoir accès pleinement au site</p>

        <div class="form-group">
            <label for="inputName">Nouveau Mot de Passe</label>
            <input type="text" class="form-control" name="mdp" placeholder="Renseignez votre nouveau mot de passe" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputFirstName">Confirmation Nouveau Mot de Passe</label>
            <input type="text" class="form-control" name="mdp2" placeholder="Confirmez votre nouveau mot de passe" spellcheck="false" required>
        </div>


        <div class="form-button">
            <button type="submit" name="action">MODIFIER MON MOT DE PASSE</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readChangePass">
        </div>

    </form>
<?php
end_page();
?>