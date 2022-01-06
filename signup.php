<?php
include 'template.php';
start_page('E-event.io | Inscription');
?>
    <div class="signup_img">
        <img src="./assets/img/logo.png" alt="Logo de E-event.io">
    </div>

    <form class="signup" action="data-processing.php" method="post">
        <span class="signup-title">Inscription</span>

        <div class="form-group">
            <label for="inputName">Nom</label>
            <input type="text" class="form-control" name="nom" placeholder="Nom" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputFirstName">Prénom</label>
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputMail">Adresse mail</label>
            <input type="email" class="form-control" name="mail" placeholder="Email" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputMDP">Mot de passe</label>
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" spellcheck="false" required>
        </div>

        <div class="form-group">
            <label for="inputMDP">Confirmation Mot de passe</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirmez votre mot de passe" spellcheck="false" required>
        </div>

        <div class="form-button">
            <button type="submit" name="action" value="send" href="./login.php">VALIDER L'INSCRIPTION</button>
        </div>

    </form>
<?php
end_page();
?>