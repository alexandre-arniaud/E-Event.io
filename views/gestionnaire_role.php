<?php
include 'template.php';
require_once '../models/Model.php';
require_once '../models/Member.php';
start_page('Admin');


echo '<span class="adm-title">Gestion des rôles</span>';

echo '<div class="tableau">';

echo ' <table>
    <tbody>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Role</th>
          <th>Action</th>
        </tr>
    </tbody>
';
echo '<table class="tableau2">';

echo '<tbody>';
echo '<div class="Informations">';

$allMembers = Member::getAllMembers();
for ($i = 0; $i <= count($allMembers ) - 1; $i++)
{
    echo '<div class="personne">';
    echo '<tr>';
    echo '<td>';
    echo $allMembers[$i]['lastname'];
    echo '</td>';
    echo '<td>';
    echo $allMembers[$i]['firstname'];
    echo '</td>';
    echo '<td>';
    echo $allMembers[$i]['mail'];
    echo '</td>';
    echo '<td>';
    echo $allMembers[$i]['role'];
    echo '</td>';

    echo '<td>';

    echo '<form method="post" action="/index.php">
    <select name="update" id="role">
        <option name ="role" value ="admin">admin</option>
        <option name ="role" value ="jury">jury</option>
        <option name ="role" value ="organisateur">organisateur</option>
        <option name ="role" value ="donateur">donateur</option>
    </select>
    
    
    <button type="submit" name="action">OK</button>
    <input type="hidden" name="controllers" value="ControllerUser">
    <input type="hidden" name="action" value="readUpdateRole">
    ';
    echo '<input type="hidden" name="mail" value="'. $allMembers[$i]['mail'] . '">';

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


