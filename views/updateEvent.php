<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';
require_once dirname(__FILE__) . '/../models/Campaign.php';

session_start();
start_page('E-event.io | Modifier votre évènement');

if (($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'organisateur')){
    ?>
    <form class="editEvent" action="/index.php" method="post">
        <span class="edit-title">Modifier votre évènement</span>

        <div class="container4">
            <div class="container-child-1">

                <div class="form-group">
                    <label for="orgName">Pour la campagne numéro </label>
                    <span><?php echo Campaign::getCurrentCampaign()['id_camp']?></span>
                </div>

                <div class="form-group">
                    <label for="orgName">Organisateur :</label>
                    <span><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></span>
                </div>


                <div class="form-group">
                    <label for="name">Nom de l'évènement</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom de l'évènement" spellcheck="false" autocomplete="off" required>
                </div>


                <div class="form-group">
                    <label for="place">Lieu</label>
                    <input type="text" class="form-control" name="place" placeholder="Lieu de l'évènement" spellcheck="false" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group">
                <label for="desc">Description</label>
                <textarea rows="10" cols="20" class="form-control" name="desc" placeholder="Description de l'évènement" spellcheck="false" autocomplete="off"></textarea>
            </div>
        </div>


        <div class="form-button">
            <button type="submit" name="action">MODIFIER LE PROJET</button>
            <input type="hidden" name="controllers" value="ControllerEvent">
            <input type="hidden" name="action" value="readUpdateEvent">
        </div>

    </form>
    <?php
}
else{
    Alerts::PermissionDenied();
}

end_page();
?>