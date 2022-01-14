<?php
include 'template.php';
require_once '../models/Model.php';
require_once '../models/Member.php';
start_page('Admin');


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

$allValidation = Member::getAllValidation();
for ($i = 0; $i <= count($allValidation) - 1; $i++)
{
    echo '<div class="personne">';
    echo '<tr>';
    echo '<td>';
    echo $allValidation[$i]['nom'];
    echo '</td>';
    echo '<td>';
    echo $allValidation[$i]['prenom'];
    echo '</td>';
    echo '<td>';
    echo $allValidation[$i]['mail'];
    echo '</td>';

    echo '<td>';
    echo '<form method="post" action="/index.php">';
    echo '<button type="submit" name="action">ACCEPTER</button>';
    echo '<input type="hidden" name="controllers" value="ControllerUser">';
    echo '<input type="hidden" name="action" value="readSignup">';
    echo '<input type="hidden" name="nom" value="' . $allValidation[$i]['nom'] . '">';
    echo '<input type="hidden" name="prenom" value="' . $allValidation[$i]['prenom'] .'">';
    echo '<input type="hidden" name="mail" value="'. $allValidation[$i]['mail'] . '">';
    echo '</form>';
    echo '<form method="post" action="/index.php"><button type="submit" name="action" >REFUSER</button>';
    echo '<input type="hidden" name="controllers" value="ControllerUser">';
    echo '<input type="hidden" name="action" value="readRefuseSignup">';
    echo '<input type="hidden" name="mail" value="'. $allValidation[$i]['mail'] . '">';
    echo '</form>';
    echo '</td>';

    echo '</tr>';
    echo '</div>';
}
echo '</div>';
echo '</tbody>';
echo '</table>';
echo '</table>';
echo '</div>';