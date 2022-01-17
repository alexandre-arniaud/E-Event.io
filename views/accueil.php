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
            <span class="adm-title">Campagne en cours <a>( cliquez sur l'évènement pour plus de détails )</a></span>
                <div class="tableau">
                                <?php
                                $allEvents = Campaign::getAllEvents();
                                for ($i = 0; $i <= count($allEvents) - 1; $i++)
                                {?>
                                        <div class="event">
                                            <img src="../assets/img/event_img.png" alt="Logo pour les events">
                                            <div class="event-infos">
                                                    <a href="/views/extraEvent.php?id=<?php echo $allEvents[$i]['id']?>">
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
                                                    <input type="hidden" name="theId" value="' . $allEvents[$i]['id'] . '">'; ?>
                                                    </a>


                                            </div>
                                        </div>

                                <?php } ?>
                </div>
        </div>
    </div>


<?php
end_page();
?>