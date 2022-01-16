<?php
require_once(dirname(__FILE__) . '/../models/Event.php');
require_once(dirname(__FILE__) . '/../models/Campaign.php');
require_once(dirname(__FILE__) . '/../controllers/routeur.php');
require_once dirname(__FILE__) . '/../controllers/ControllerAlerts.php';

class ControllerEvent
{

    public function readAddEvent() {
        $project = Event::addEvent();

        if ($project == false)
        {
            Alerts::addEventError();
        }
        else
        {
            header("Location: ../views/accueil.php");
        }
    }

    public function readAddCampaign() {
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
    }


}
