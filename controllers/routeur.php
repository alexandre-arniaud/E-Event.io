<?php
require_once dirname(__FILE__) . '/ControllerUser.php';
require_once dirname(__FILE__) . '/ControllerLogin.php';
require_once dirname(__FILE__) . '/ControllerEvent.php';

$action = NULL;
$controller = NULL;

// On recupère l'action passée dans l'URL
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}
else {
    $action = 'index';
}

// On recupère le controleur dans l'URL

if (isset($_POST['controllers'])) {
    $controller = $_POST['controllers'];
}
elseif (isset($_GET['controllers'])){
    $controller = $_GET['controllers'];
}else {
    $controller = 'ControllerLogin';
}


// Appel de la méthode statique $action du controlleur récupéré dans l'URL
if ($action != NULL && $controller != NULL) {
    $controller::$action();
}


?>
