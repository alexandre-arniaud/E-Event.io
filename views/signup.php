<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';

start_page('E-event.io | Inscription');

if(($_SESSION['role'] == 'jury') || ($_SESSION['role'] == 'donateur') || ($_SESSION['role'] == 'organisateur')){

    Alerts::PermissionDenied();
}
else{?>
    <form class="signup" action="/index.php" method="post">
        <span class="signup-title">Inscription</span>

        <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" name="nom" placeholder="Nom" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label>Adresse mail</label>
            <input type="email" class="form-control" name="mail" placeholder="Email" spellcheck="false" required>
        </div>

        <div class="form-button">
            <button type="submit" name="action">VALIDER L'INSCRIPTION</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readValidation">
        </div>

    </form>
<?php
}

end_page();
?>