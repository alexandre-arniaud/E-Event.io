<?php
require_once ('../views/signup.php');
require_once ('ControllerSignup.php');

// On recupère l'action passée dans l'URL
if (isset($_GET['action'])){
    $action = $_GET["action"];
} else {
    echo " Erreur dans la récupération de l'action passée en paramètre !";
}

echo "Action : " . $action;

if(isset($_GET['controllers'])){ // On recupère le controleur dans l'URL
    $controller = $_GET['controllers'];
}else {
    echo " Erreur dans la récupération du controlleur passée en paramètre !";
}

echo "Controleur : " . $controller;

// Appel de la méthode statique $action du controlleur récupéré dans l'URL
$controller::$action();

?>
