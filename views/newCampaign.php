<?php
include 'template.php';
session_start();
start_page('E-event.io | Créer une campagne');
?>

    <form class="newProj" action="/index.php" method="post">
        <span class="proj-title">Créer une nouvelle campagne</span>

        <div class="container">
            <div class="container-child-1">
                <div class="form-group">
                    <label for="inputName">Nom de la campagne </label>
                    <input type="text" class="form-control" name="nomC" placeholder="Nom de la campagne" spellcheck="false" required>
                </div>

                <div>
                    <label for="inputOrgName">Date de début : <?php echo date("Y-m-d") ?></label>
                </div>

                <div class="form-group">
                    <label for="inputOrgName">Date de fin</label>
                    <input type="date" class="form-control" name="trip-end" value="2022-12-31" min="<?php echo date("Y-m-d");?>" max="<?php echo date("Y"); ?>-12-31" placeholder="12/01/2022" spellcheck="false" required>
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

    </form>
<?php
end_page();
?>