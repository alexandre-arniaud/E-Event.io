<?php
require_once(dirname(__FILE__) . '/ControllerSignup.php');
require_once(dirname(__FILE__) . '/ControllerLogin.php');

$action = NULL;
$controller = NULL;

// On recupère l'action passée dans l'URL
if (isset($_GET['action'])){
    if ($_GET['action'] == 'readSignup') {
        $action = 'readSignup';
    }
    else if ($_GET['action'] == 'readResetPassword') {
        $action = 'readResetPassword';
    }
    else if ($_GET['action'] == 'readLogin') {
        $action = 'readLogin';
    }
} else {
    $action = 'index';
}

// On recupère le controleur dans l'URL
if(isset($_GET['controllers'])){
    if ($_GET['controllers'] == 'ControllerSignup') {
        $controller = 'ControllerSignup';
    }
}else {
    $controller = 'ControllerLogin';
}

// Appel de la méthode statique $action du controlleur récupéré dans l'URL
if ($action != NULL && $controller != NULL) {
    $controller::$action();
}


?>
