<?php
include 'template.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Campaign.php';
start_page('E-event.io | La fête ne fait que commencer');
?>
    <div class = "bigContainer">
        <div class="container">
            <img src="../assets/img/logo2.png" alt="Logo de E-event.io n°2">

            <?php
            if (ControllerSession::is_admin() or ControllerSession::is_donateur() or ControllerSession::is_jury() or ControllerSession::is_organisateur())
            {
                echo '';
            }
            else
            {
                echo '        
                    <div class="form-button">
                        <a href="login.php">SE CONNECTER</a>
                        <a href="signup.php">S\'INSCRIRE</a>
                    </div>
                ';
            }
            ?>
        </div>
        <div class="event-board">
            <span class="adm-title">Campagne en cours</span>
                <div class="tableau">
                                <?php
                                $allEvents = Campaign::getAllEvents();
                                for ($i = 0; $i <= count($allEvents) - 1; $i++)
                                {?>
                                        <div class="event">
                                            <img src="../assets/img/event_img.png" alt="Logo pour les events">
                                            <div class="event-infos">
                                                <?php
                                                echo '<div class="row-1">';
                                                echo '<p>';
                                                echo $allEvents[$i]['proj_name'];
                                                echo '</p>';
                                                echo '<p>';
                                                echo $allEvents[$i]['totalPoints'] . " points attribués";
                                                echo '</p>';
                                                echo '</div>';
                                                echo '<div class="row-2">';
                                                echo "Organisé par " . $allEvents[$i]['organizer'];
                                                echo '</div>';
                                                echo '<div class="row-3">';
                                                echo "A " . $allEvents[$i]['location'];
                                                echo '</div>';
                                                echo '<div class="row-4">';
                                                echo $allEvents[$i]['description'];
                                                echo '</div>';
                                                echo '<form method="post" action="/index.php">';
                                                echo '<div class="vote">
                                                        <input type="number" step="1" min="1" class="form-control" name="points" placeholder="Nombre de points a donner" spellcheck="false" autocomplete="off" required>
                                                        <button type="submit" name="action">Voter</button>
                                                        <input type="hidden" name="controllers" value="ControllerEvent">
                                                        <input type="hidden" name="action" value="readVote">';
                                                echo '<input type="hidden" name="id_event" value="'. $allEvents[$i]['id'] . '">';
                                                echo '</form>'; ?>
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