<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Event.php';

start_page('E-event.io | La fête ne fait que commencer');
?>

        <div class="event-board">
            <span class="adm-title">Informations sur l'évènement</span>
            <div class="tableau">
                <?php
                 $theEvent = Event::getEvent($_GET['id'])[0];
                 ?>
                <div class="event">
                    <img src="../assets/img/event_img.png" alt="Logo pour les events">
                    <div class="event-infos"> <a href="/views/about_event.php">
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
                                                </a>
                                                <form method="post" action="/index.php">
                                                    <div class="vote">
                                                        <input type="number" step="1" min="1" class="form-control" name="points" placeholder="Nombre de points a donner" spellcheck="false" autocomplete="off" required>
                                                        <button type="submit" name="action">Voter</button>
                                                        <input type="hidden" name="controllers" value="ControllerEvent">
                                                        <input type="hidden" name="action" value="readVote">';
                            echo '<input type="hidden" name="id_event" value="'. $theEvent['id'] . '">';?>
                                                    </div>
                                                </form>
                    </div>
                </div>
            </div>
        </div>


<?php
end_page();
?>