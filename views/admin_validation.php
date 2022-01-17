<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';

require_once '../models/Model.php';
require_once '../models/Member.php';
start_page('Admin');

if ($_SESSION['role'] == 'admin'){
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
    </tbody>';

    echo '<table class="tableau3">';

    echo '<tbody>';
    echo '<div class="Informations">';

    $allValidation = Member::getAllValidation();
    for ($i = 0; $i <= count($allValidation) - 1; $i++)
    {
        echo '<div class="personne">';
        echo '<tr>
              <td>';
        echo $allValidation[$i]['nom'];
        echo '</td>
              <td>';
        echo $allValidation[$i]['prenom'];
        echo '</td>
              <td>';
        echo $allValidation[$i]['mail'];
        echo '</td>

              <td>
        <form method="post" action="/index.php">
            <button type="submit" name="action">ACCEPTER</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readSignup">';
        echo '<input type="hidden" name="nom" value="' . $allValidation[$i]['nom'] . '">';
        echo '<input type="hidden" name="prenom" value="' . $allValidation[$i]['prenom'] .'">';
        echo '<input type="hidden" name="mail" value="'. $allValidation[$i]['mail'] . '">';
        echo '</form>
        <form method="post" action="/index.php"><button type="submit" name="action" >REFUSER</button>
            <input type="hidden" name="controllers" value="ControllerUser">
            <input type="hidden" name="action" value="readRefuseSignup">';
        echo '<input type="hidden" name="mail" value="'. $allValidation[$i]['mail'] . '">';
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

