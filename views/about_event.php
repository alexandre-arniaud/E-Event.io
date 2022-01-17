<?php
include 'template.php';
require_once '../controllers/ControllerAlerts.php';
require_once '../models/Model.php';
require_once '../models/Member.php';
require_once dirname(__FILE__) . '/../controllers/ControllerSession.php';
require_once dirname(__FILE__) . '/../models/Campaign.php';

start_page('A propos de l\'évènement');

echo $_POST['proj_name'];



end_page();
?>
