<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';

start_page('E-event.io | Créer un évènement');

if(($_SESSION['role'] == 'organisateur') || ($_SESSION['role'] == 'admin')){?>
    <form class="newProj" action="/index.php" method="post">
        <span class="proj-title">Ajouter un contenu supplémentaire pour mon évènement</span>

        <div class="container">
            <div class="container-child-1">
                <div class="form-group">
                    <label for="inputName">Id Event : </label>
                    <span><?php echo $_GET['id'];?></span>
                    <input type="hidden" name="id_event" value="<?php echo $_GET['id'];?>">
                </div>

                <div class="form-group">
                    <label for="name">Nom du palier</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom de l'évènement" spellcheck="false" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="inputtreshold">Seuil de Points</label>
                    <input type="number" class="form-control" name="threshold" placeholder="Exemple = 200" spellcheck="false" required>
                </div>

            </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea rows="10" cols="20" class="form-control" name="desc" placeholder="Description de l'évènement" spellcheck="false" autocomplete="off"></textarea>
                </div>

        </div>

                <div class="form-button">
                    <button type="submit" name="action">SOUMETTRE</button>
                    <input type="hidden" name="controllers" value="ControllerEvent">
                    <input type="hidden" name="action" value="readContSupp">
                </div>

    </form>
    <?php
}
else{

    Alerts::PermissionDenied();
}

end_page();
?>