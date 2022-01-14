<?php
include 'template.php';
start_page('E-event.io | Modification du mot de passe');
?>

    <form class="signup" action="/index.php" method="post">
        <span class="signup-title">Modification du mot de passe</span>

        <div class="form-group">
            <label for="inputMail">Adresse mail</label>
            <input type="email" class="form-control" name="mail" placeholder="Email" spellcheck="false" required>
        </div>

        <div class="form-button">
            <button type="submit" name="action">CHANGER MON MOT DE PASSE</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readResetPassword">
        </div>

    </form>
<?php
end_page();
?>