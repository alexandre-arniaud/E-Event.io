<?php
require_once(dirname(__FILE__) . '/../models/Event.php');
require_once(dirname(__FILE__) . '/../models/Campaign.php');
require_once(dirname(__FILE__) . '/../controllers/routeur.php');
require_once dirname(__FILE__) . '/../controllers/ControllerAlerts.php';

class ControllerEvent
{

    public function readAddEvent() {
        session_start();
        if ($_SESSION['role'] == 'donateur' || $_SESSION['role'] == 'admin') {
            $project = Event::addEvent();

            if ($project == false) {
                Alerts::addEventError();

            } else {
                header("Location: ../views/accueil.php");
            }
        } else {
            Alerts::isNotAuthorized();
        }
    }

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
     * @description Methode permettant de voter pour un évènement et donc de lui attribuer des points
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

    public function readDelete(){
        $deleted = Event::deleteEvents();

        if ($deleted == false){
            Alerts::addVoteError();
        }
        else{
            header("Location: ../views/choice_jury.php");
        }
    }

    public function readKeep(){
        $keep = Event::keepEvents();

        if ($keep == false){
            Alerts::addVoteError();
        }
        else{
            header("Location: ../views/choice_jury.php");
        }
    }


}
