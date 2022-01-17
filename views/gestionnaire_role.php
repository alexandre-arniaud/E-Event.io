<?php
include 'template.php';
require_once '../models/Model.php';
require_once '../models/Member.php';
require_once '../controllers/ControllerAlerts.php';
start_page('Admin');

if($_SESSION['role'] == 'admin'){
    echo '<span class="adm-title">Gestion des rôles</span>
               <div class="tableau">';

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
    echo '<table class="tableau2">
        <tbody>
        <div class="Informations">';

    $allMembers = Member::getAllMembers();
    for ($i = 0; $i <= count($allMembers ) - 1; $i++)
    {
        echo '<div class="personne">
                <tr>
                <td>';
        echo $allMembers[$i]['lastname'];
        echo '</td>
                <td>';
        echo $allMembers[$i]['firstname'];
        echo '</td>
               <td>';
        echo $allMembers[$i]['mail'];
        echo '</td>
              <td>';
        echo $allMembers[$i]['role'];
        echo '</td>
                <td>
    <form method="post" action="/index.php">
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

        echo '</form>
            </td>
            </tr>
            </div>';
    }
    echo '</div>
           </tbody>
           </table>
           </table>
           </div>';
}
else{
    Alerts::PermissionDenied();
}


end_page();
?>





