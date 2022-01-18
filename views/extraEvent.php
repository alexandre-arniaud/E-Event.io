<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Event.php';

start_page('E-event.io | La fête ne fait que commencer');
?>
        <?php if (isset($_SESSION['id_member'])) {
            echo '<span class="points">Mes points : ' . $_SESSION['points'] . '</span>';
        }?>

        <div class="event-board">
            <span class="evt-title">Informations sur l'évènement</span>
            <div class="tableau">
                <?php
                 $theEvent = Event::getEvent($_GET['id'])[0];
                 $contents = Event::getContSupp($_GET['id']);
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
                            echo '</div>';
                            if (isset($_SESSION['id_member'])) {
                                echo '<form method="post" action="/index.php">
                                                    <div class="vote">
                                                        <input type="number" step="1" min="1" class="form-control" name="points" placeholder="Nombre de points a donner" spellcheck="false" autocomplete="off" required>
                                                        <button type="submit" name="action">Voter</button>
                                                        <input type="hidden" name="controllers" value="ControllerEvent">
                                                        <input type="hidden" name="action" value="readVote">';
                                echo '<input type="hidden" name="id_event" value="'. $theEvent['id'] . '">
                                </div>
                                </form>';
                            } ?>

                </div>
            </div>
            <span class="separator">Contenus débloquables</span>
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


<?php
end_page();
?>