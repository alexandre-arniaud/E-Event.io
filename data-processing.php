<?php

include_once 'models/Model.php';
include_once 'controllers/signup_controller.php';
include_once 'models/Member.php';


$action = $_POST['action'];
global $membre;
$membre = new Member(null, $_POST['nom'], $_POST['prenom'], $_POST['mail'], strtolower($_POST['prenom']) . '.' . strtolower($_POST['nom']));
$encrypt_pass = (new signupController()) -> encryptPass();
$today = date('Y-m-d');


if($action == 'send')
{
    $inscription = new signupController;
    $inscription->sendEmail($membre);
}

$db = Model::getDb();

$inscription_query = 'INSERT INTO members (login, mail, lastname, firstname, password) VALUES (\''. $membre -> getLogin() . '\', \'' . $membre -> getEmail() . '\', \'' . $membre -> getNom() . '\', \'' . $membre -> getPrenom() .'\', \'' . $encrypt_pass . '\')';

if(!($dbResult = mysqli_query($db, $inscription_query)))
{
    echo 'Erreur de requête<br/>';
    // Affiche le type d'erreur.
    echo 'Erreur : ' . mysqli_error($db) . '<br/>';
    // Affiche la requête envoyée.
    echo 'Requête : ' . $inscription_query . '<br/>';
    exit();
} else {
    header('Location: /views/login.php');
    echo "<script type='text/javascript'>alert('Inscription réalisée avec succès !');</script>";
}

?>