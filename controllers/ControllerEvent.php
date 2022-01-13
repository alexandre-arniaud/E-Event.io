<?php
require_once(dirname(__FILE__) . '/../models/Event.php');
require_once(dirname(__FILE__) . '/../controllers/routeur.php');

class ControllerEvent
{

    public function readAddEvent() {
        $project = Event::addEvent();

        if ($project == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            header("Location: ../views/login.php");
        }
    }


}
