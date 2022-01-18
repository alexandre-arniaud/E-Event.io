<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Event.php';

start_page('E-event.io | La fête ne fait que commencer');

if($_SESSION['role'] == 'admin'){?>
    <div class="event-board">
        <span class="adm-title">Informations sur l'évènement</span>
        <div class="tableau">
            <?php
            $theEvent = Event::getEventByOrganizer($_GET['organizer'])[0];
            ?>
            <div class="event">
                <img src="../assets/img/event_img.png" alt="Logo pour les events">
                <div class="event-infos">
                    <?php
                    echo '<div class="row-1">
                                                        <p>';
                    echo $theEvent['proj_name'];
                    echo ' </p>
                                                       <p>';
                    echo $theEvent['totalPoints'] . " points attribués";
                    echo '</p>
                                                      </div>
                                                      <div class="row-2">';
                    echo "Organisé par " . $theEvent['organizer'];
                    echo '</div>
                                                      <div class="row-3">';
                    echo "A " . $theEvent['location'];
                    echo '</div>
                                                      <div class="row-4">';
                    echo $theEvent['description'];
                    echo '</div>
                                                <a href="../views/updateEvent.php">Modifier</a>
                                                ';
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php
}

    else{
        Alerts::PermissionDenied();
    }

end_page();
?>