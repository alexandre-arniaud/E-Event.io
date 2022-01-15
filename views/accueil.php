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
            <span class="adm-title">Campagne d'évènementiel en cours</span>
            <div class="tableau">
                <table>
                    <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Mail</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </tbody>

                    <table class="tableau2">
                        <tbody>
                            <div class="Informations">
                                <?php
                                $allEvents = Campaign::getAllEvents();
                                for ($i = 0; $i <= count($allEvents) - 1; $i++)
                                {
                                    echo '<div class="personne">';
                                        echo '<tr>';
                                            echo '<td>';
                                                echo $allEvents[$i]['proj_name'];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $allEvents[$i]['organizer'];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $allEvents[$i]['location'];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $allEvents[$i]['description'];
                                            echo '</td>';
                                        echo '</tr>';
                                    echo '</div>';
                                }?>
                            </div>
                        </tbody>
                    </table>
                </table>
            </div>
        </div>

    </div>


<?php
end_page();
?>
