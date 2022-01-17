<?php
include 'template.php';
start_page('E-event.io | Modifiez votre mot de passe');
?>

    <form class="signup" action="/index.php" method="post">
        <span class="force-title">Modifier mon mot de passe</span>
        <p> Parce que pouvoir choisir son mot de passe, c'est bien mieux !</p>

        <div class="form-group">
            <label for="inputName">Ancien mot de passe</label>
            <input type="password" class="form-control" name="ancienMdp" placeholder="Renseignez votre ancien mot de passe" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputName">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="nouveauMdp" placeholder="Renseignez votre nouveau mot de passe" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputName">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" name="confirmeMdp" placeholder="Confirmer votre nouveau mot de passe" spellcheck="false" required>
        </div>

        <div class="form-button">
            <button type="submit" name="action">MODIFIER MON MOT DE PASSE</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readChangeNewPass">
        </div>

    </form>
<?php
end_page();
?>