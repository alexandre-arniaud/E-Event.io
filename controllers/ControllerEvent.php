<?php
require_once(dirname(__FILE__) . '/../models/Event.php');
require_once(dirname(__FILE__) . '/../models/Campaign.php');
require_once(dirname(__FILE__) . '/../controllers/routeur.php');
require_once dirname(__FILE__) . '/../controllers/ControllerAlerts.php';

class ControllerEvent
{

    /**
     * @description Controlleur permettant de créer un évènement
     * @author Karim Boudjaoui
     */
    public function readAddEvent() {
        session_start();
        if ($_SESSION['role'] == 'donateur' || $_SESSION['role'] == 'admin') {
            $project = Event::addEvent();

            if ($project == 'erreur') {
                Alerts::addEventError();
            }
            elseif ($project == 'ok'){
                header("Location: ../views/accueil.php");
            }
            elseif ($project =='limite'){
                Alerts::TooManyEvents();
            }
        } else {
            Alerts::isNotAuthorized();
        }
    }

    /**
     * @description Controlleur permettant de créer une campagne
     * @author Alexandre Arniaud
     */
    public function readAddCampaign() {
        session_start();
        if ($_SESSION['role'] == 'admin') {
            $campEnCours = Campaign::getCurrentCampaign();
            if ($campEnCours == null){
                $campaign = Campaign::addCampaign();
                $default_point = Member::updateDefaultPoint();
                if (($campaign == true) && ($default_point==true) )
                {
                    header("Location: ../views/accueil.php");

                }
                else{
                    Alerts::addCampaignError();
                }
            }
            else
            {
                Alerts::campaignAlreadyExist();

            }
        } else {
            Alerts::isNotAuthorized();
        }
    }

    /**
     * @description Controlleur permettant de voter pour un évènement et donc de lui attribuer des points
     * @author Karim Boudjaoui
     */
    public function readVote() {
        session_start();
        if ($_POST['points'] <= $_SESSION['points']) {
            $vote = Event::addVote();

            if ($vote == false) {
                Alerts::addVoteError();

            } else {
                header("Location: ../views/accueil.php");
            }
        } else {
            Alerts::NotEnoughPoint();
        }
    }

    /**
     * @description Controlleur permettant d'en savoir plus sur un évènement
     * @author Alexandre Arniaud
     */
    public function readExtraInfo() {

        $info = Event::getEvent();

        if ($info != null) {
//                        echo 'ouesh';
            header("Location: ../views/extraEvent.php");
        } else {
            Alerts::redirectEventError();
        }
    }

    /**
     * @description Controlleur permettant de supprimer un évènement pour un jury
     * @author Marius Garnier & Anthony Ruiz
     */

    public function readDelete(){
        $deleted = Event::deleteEvents();

        if ($deleted == false){
            Alerts::addVoteError();
        }
        else{
            header("Location: ../views/choice_jury.php");
        }
    }

    /**
     * @description Controlleur permettant de garder un évènement pour un jury
     * @author Marius Garnier & Anthony Ruiz
     */

    public function readKeep(){
        $keep = Event::keepEvents();

        if ($keep == false){
            Alerts::addVoteError();
        }
        else{
            header("Location: ../views/choice_jury.php");
        }
    }

    /**
     * @description Controlleur permettant d'ajouter un contenu supplémentaire pour un évènement
     * @author Karim Boudjaoui
     */
    public function readContSupp(){
        session_start();
        if ($_SESSION['role'] == 'organisateur' || $_SESSION['role'] == 'admin') {
            $contSupp = Event::addContSupp();

            if ($contSupp == false) {
                Alerts::addContSupp();

            } else {
                header("Location: ../views/myEvent.php");
            }
        } else {
            Alerts::isNotAuthorized();
        }
    }

    /**
     * @description Controlleur permettant de modifier un evenement
     * @author Marius Garnier
     */

    public function readUpdateEvent(){
        $event = Event::updateEvent();

        if ($event == false){
            Alerts::addVoteError();
        }
        else{
            header("Location: ../views/accueil.php");
        }
    }
}