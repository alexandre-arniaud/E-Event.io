<?php
include 'template.php';
session_start();
start_page('E-event.io | Ajouter un évènement');

?>

    <form class="newProj" action="/index.php?controllers=ControllerEvent&action=readAddEvent" method="post">
        <span class="proj-title">Ajouter un nouvel évènement</span>

        <div class="container">
            <div class="container-child-1">
                <div class="form-group">
                    <label for="inputName">Nom de l'évènement</label>
                    <input type="text" class="form-control" name="nomP" placeholder="Nom de l'évènement" spellcheck="false" required>
                </div>

                <div class="form-group">
                    <label for="inputOrgName">Numero Organisateur</label>
                    <input type="text" class="form-control" name="numOrg" placeholder="Numero Organisateur" spellcheck="false" required>
                </div>

            </div>

            <div class="form-group">
                <label for="inputDesc">Description</label>
                <textarea rows="10" cols="20" class="form-control" name="description" placeholder="Description de l'évènement"></textarea>
            </div>
        </div>


        <div class="form-button">
            <button type="submit" name="action">SOUMETTRE LE PROJET</button>
        </div>

    </form>
<?php
end_page();
?>