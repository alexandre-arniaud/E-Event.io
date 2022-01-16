<?php
include 'template.php';
start_page('Mon compte');
?>
    <div class="container">
    <div class="container-child-1">

        <div class="Infos">
            <div class="prenom">
                <label>Prénom :</label>
                <span><?php echo $_SESSION['prenom']?></span>
            </div>
            <div class="prenom">
                <label>Nom :</label>
                <span><?php echo $_SESSION['nom']?></span>
            </div>
            <div class="mail">
                <label>Mail :</label>
                <span><?php echo $_SESSION['mail']?></span>
            </div>
            <div class="role">
                <label>Role :</label>
                <span><?php echo $_SESSION['role']?></span>
            </div>
            <div class="points">
                <label>Mes points :</label>
                <span><?php echo $_SESSION['points']?></span>
            </div>
            <div class="button-mdp">
                <form method="post" action="/myAccount.php"><button type="submit" name="action" >Modifier le mot de passe</button>
            </div>
        </div>

    </div>


<?php
end_page();
?>