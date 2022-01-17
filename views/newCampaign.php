<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';

session_start();
start_page('E-event.io | Créer une campagne');

if($_SESSION['role'] == 'admin'){?>

    <form class="newProj" action="/index.php" method="post">
        <span class="proj-title">Créer une nouvelle campagne</span>

        <div class="container-bis">
            <div class="container-child-1">
                <div class="form-group">
                    <label for="inputName">Nom de la campagne </label>
                    <input type="text" class="form-control" name="nomC" placeholder="Nom de la campagne" spellcheck="false" required>
                </div>

                <div class="form-group">
                    <label for="date">Date de début :</label>
                    <span><?php echo date("Y-m-d") ?></span>
                </div>


                <div class="form-group">
                    <label for="inputOrgName">Date de fin</label>
                    <input type="date" class="form-control" name="trip-end" min="<?php echo $date_deb = date("Y-m-d");?>" max="<?php echo $date = date_add($date_deb, new DateInterval(P1M))?>"  spellcheck="false" required>
                </div>

                <div class="form-group">
                    <label for="inputOrgName">Points par défault</label>
                    <input type="int" class="form-control" name="default_points" placeholder="100" spellcheck="false" required>
                </div>

            </div>
        </div>


        <div class="form-button">
            <button type="submit" name="action">SOUMETTRE</button>
            <input type="hidden" name="controllers" value="ControllerEvent">
            <input type="hidden" name="action" value="readAddCampaign">
        </div>

    </form><?php
}
else{
    Alerts::PermissionDenied();
}


end_page();
?>