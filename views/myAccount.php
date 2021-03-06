<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';

session_start();

start_page('E-event.io - Mon compte');
if(isset($_SESSION['id_member'])){?>

    <div class="user-infos">

        <div class="prenom">
            <label>Prénom :</label>
            <span><?php echo $_SESSION['prenom']?></span>
        </div>
        <div class="nom">
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
        <form method="post" action="edit_Password.php"><button class="button-mdp" type="submit" name="action" >Modifier mon mot de passe</button>

    </div><?php
}
else{
    Alerts::PermissionDenied();
}

end_page();
?>