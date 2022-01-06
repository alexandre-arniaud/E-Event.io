<?php
include 'template.php';
start_page('E-event.io | Connexion');
?>
    <header class="header">
        <img src="./assets/img/logo.png" alt="Logo de E-event.io">
    </header>


    <form class="login">
        <span class="login-title">Connexion</span>

        <div class="form-group">
            <label for="inputMail">Adresse mail</label>
            <input type="email" class="form-control" id="inputMail" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputMDP">Mot de passe</label>
            <input type="password" class="form-control" id="inputMDP" placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <label class="rememberMe"><input type="checkbox">Se souvenir de moi</label>
        </div>
        <div class="form-button">
            <button href="[PAGE CONNECTE]">CONNEXION</button>
            <button href="signup.php">INSCRIPTION</button>
        </div>

        <span class="button_forgot" href="[PAGE POUR CHANGER MDP]">Mot de passe oublié</span>


    </form>
<?php
end_page();
?>