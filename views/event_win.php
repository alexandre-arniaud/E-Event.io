<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Campaign.php';

start_page('E-event.io | La fête ne fait que commencer');
?>
    <div class="bigContainer">
        <div class="container">
            <img src="../assets/img/logo2.png" alt="Logo de E-event.io n°2">
        </div>
        <div class="event-board">
            <span class="adm-title">Evènements validés par le jury lors de la dernière campagne</span>
            <div class="tableau">
                <?php
                $allEvents = Campaign::getWinEvent();
                for ($i = 0; $i <= count($allEvents) - 1; $i++)
                {?>
                <div class="event">
                    <img src="../assets/img/event_img.png" alt="Logo pour les events">
                    <div class="event-infos">
                        <div class="row-1">
                            <p><?php echo $allEvents[$i]['proj_name'];?></p>
                            <p><?php echo $allEvents[$i]['totalPoints'] . " points attribués";?></p>
                        </div>
                        <div class="row-2">
                            <?php echo "Organisé par " . $allEvents[$i]['organizer'];?>
                        </div>
                        <div class="row-3">
                            <?php echo "A " .  $allEvents[$i]['location'];?>
                        </div>
                        <div class="row-4">
                        <?php echo $allEvents[$i]['description'];?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
end_page();
?>