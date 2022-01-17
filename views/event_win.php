<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Campaign.php';

start_page('E-event.io | La fête ne fait que commencer');
?>
    <div class = "bigContainer">
        <div class="container">
            <img src="../assets/img/logo2.png" alt="Logo de E-event.io n°2">
        </div>
        <div class="event-board">
            <span class="adm-title">Evènements selectionnés par le jury</span>
            <div class="tableau">
                <?php
                $allEvents = Campaign::getWinEvent();
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
                        echo "A " .  $allEvents[$i]['location'];
                        echo '</div>
                                                      <div class="row-4">';
                        echo $allEvents[$i]['description'];
                        echo '</div>
                            <div class="vote">';
                        ?>
                    </div>

                </div>
            </div>

            <?php } ?>
        </div>
    </div>


<?php
end_page();
?>