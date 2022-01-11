<?php

// On recupère l'action passée dans l'URL
if (isset($_GET['action'])){
    $action = $_GET["action"];
} else {
    $action = 'readAll';
}

$controller_default = 'point';
if(isset($_GET['controller'])){ // On recupère le controleur dans l'URL
    $controller = $_GET['controller'];
}else {
    $controller = $controller_default;
}

$controller_class = 'Controller'. ucfirst($controller);

if(class_exists($controller_class)){
    $tab_methode_controller = get_class_methods($controller_class);
    if ((in_array($action, $tab_methode_controller))){
        // Appel de la méthode statique $action du controlleur récupéré dans l'URL
        $controller_class::$action();
    } else {

        $controller_class::erreur();
    }
} else {
    ControllerPoint::erreur();
}

?>
