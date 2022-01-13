<?php
include 'template.php';
require_once '../models/Model.php';
start_page('Admin');

$reqV = "SELECT * FROM validation";
$req_prep = Model::getPDO()->query($reqV);

echo '<span class="adm-title">Inscriptions en attente</span>';

echo '<div class="tableau">';

echo ' <table>
    <tbody>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
             <th>Mail</th>
          <th>Action</th>
        </tr>
    </tbody>
';
echo '<table class="tableau2">';
echo '<tbody>';
echo '<div class="Informations">';
while($validation = $req_prep->fetch())
{

    echo '<div class="personne">';
    echo '<tr>';
    echo '<td>';
    echo $validation['nom'];
    echo '</td>';
    echo '<td>';
    echo $validation['prenom'];
    echo '</td>';
    echo '<td>';
    echo $validation['mail'];
    echo '</td>';

    echo '<td>';
    echo '<form method="post" action="/index.php">
            <button type="submit" name="action">ACCEPTER</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readSignup"></form>
          <form method="post" action="/index.php"><button type="submit" name="action" >REFUSER</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readValidation"></form>
            
    ';
    echo '</tr>';
    echo '</div>';
}
echo '</div>';
echo '</tbody>';
echo '</table>';
echo '</table>';
echo '</div>';