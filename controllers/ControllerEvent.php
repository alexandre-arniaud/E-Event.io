<?php
require_once(dirname(__FILE__) . '/../models/Event.php');
require_once(dirname(__FILE__) . '/../models/Campaign.php');
require_once(dirname(__FILE__) . '/../controllers/routeur.php');

class ControllerEvent
{

    public function readAddEvent() {
        $project = Event::addEvent();

        if ($project == false)
        {
            echo 'L\'évènement n\'a pas été ajouté';
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
                echo 'Erreur dans la création de la campagne';
            }
        }
        else
        {
            echo 'Une campagne est déjà en cours';

        }
    }


}
