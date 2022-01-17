<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';

session_start();

start_page('E-event.io');
if(($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'organisateur') || ($_SESSION['role'] == 'jury')  || ($_SESSION['role'] == 'donateur')){?>

    <div class="container">
    <div class="container-child-1">

    <div class="Infos">
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
        <!--            LE BOUTTON EST A FAIRE-->
        <div class="button-mdp">
            <form method="post" action="edit_Password.php"><button type="submit" name="action" >Modifier le mot de passe</button>
        </div>
    </div>

    </div><?php
}
else{
    Alerts::PermissionDenied();
}

end_page();
?>