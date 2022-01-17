<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';
require_once '../models/Model.php';
require_once '../models/Member.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Campaign.php';

start_page('Jury');

if(($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'jury')){
?><div class="jury-board">
            <span class="adm-title">Évènements éligibles à la délibération</span>
                <div class="tableau">
                                <?php
                                $allEvents = Campaign::getMinPointsEvents();
                                for ($i = 0; $i <= count($allEvents) - 1; $i++)
                                {?>
                                        <div class="event">
                                            <img src="../assets/img/event_img.png" alt="Logo pour les events">
                                            <div class="event-infos">
                                                <?php
                                                echo '<div class="row-1">
                                                        <p>';
                                                echo $allEvents[$i]['proj_name'];
                                                echo ' </p>
                                                       <p>';
                                                echo $allEvents[$i]['totalPoints'] . " points attribués";
                                                echo '</p>
                                                      </div>
                                                      <div class="row-2">';
                                                echo "Organisé par " . $allEvents[$i]['organizer'];
                                                echo '</div>
                                                      <div class="row-3">';
                                                echo "A " . $allEvents[$i]['location'];
                                                echo '</div>
                                                      <div class="row-4">';
                                                echo $allEvents[$i]['description'];
                                                echo '</div>
                                                <form method="post" action="/index.php">
                                                    <div class="vote">
                                                    <button type="submit" name="action">Garder</button>
                                                        <input type="hidden" name="controllers" value="ControllerEvent">
                                                        <input type="hidden" name="action" value="readKeep">';
                                                echo '<input type="hidden" name="id_event" value="'. $allEvents[$i]['id'] . '">';
                                                echo'
                                                </form>
                                                <form method="post" action="/index.php">
                                                    <button type="submit" name="action">Eliminer</button>
                                                        <input type="hidden" name="controllers" value="ControllerEvent">
                                                        <input type="hidden" name="action" value="readDelete">';
                                                        echo '<input type="hidden" name="id_event" value="'. $allEvents[$i]['id'] . '">';
                                                  echo'  </div>
                                                </form>';


                                                 ?>


                                            </div>

                                        </div>

                                <?php } ?>
                </div>
</div><?php
}
else{
    Alerts::PermissionDenied();
}

end_page();
?>
