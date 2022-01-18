<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../controllers/ControllerAlerts.php';
require_once dirname(__FILE__) . '/../models/Event.php';

start_page('E-event.io | La fête ne fait que commencer');

if($_SESSION['role'] == 'organisateur'){?>
    <div class="event-board">
        <?php
        $theEvent = Event::getEventByOrganizer($_GET['organizer'])[0];
        $contents = Event::getContSupp($theEvent['id']);
        ?>
        <span class="adm-title">Mon évènement</span>
        <?php if ($theEvent['totalPoints'] == 0) {
            echo '<a href="../views/updateEvent.php">Modifier</a>';
        }?>

        <a href="../views/addContSupp.php?id=<?php echo $theEvent['id'];?>">Ajouter du contenu débloquable</a>
        <div class="tableau">
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
                    echo '</div>';
                    ?>

                </div>
            </div>
            <span class="separator">↓  Contenus débloquables  ↓</span>
            <div class="contents-container">
                <?php
                for ($i = 0; $i <= count($contents) - 1; $i++)
                {?>
                <div class="content">
                    <?php
                    echo '<div class="row-1">
                                                            <p>';
                    echo $contents[$i]['name'];
                    echo ' </p>
                                                          </div>
                                                          <div class="row-2">';
                    echo "Description : " . $contents[$i]['description'];
                    echo '</div>
                                                          <div class="row-3">';
                    echo "Seuil pour débloquer :  " . $contents[$i]['threshold'];
                    echo '</div>
                                                          <div class="row-4">';
                    if ($contents[$i]['isunlock'] == 1) {
                        echo "Ce contenu est débloqué ! ";
                    }
                    echo '</div>
                    </div>';

                    } ?>
                </div>

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