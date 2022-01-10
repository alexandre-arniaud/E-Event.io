<?php

include 'template.php';
include './models/Model.php';
include './controllers/signup.php';

start_page("Data processing");

$action = $_POST['action'];
$membre = new Member();
$membre -> setNom($_POST['nom']);
$membre -> setPrenom($_POST['prenom']);
$membre -> setEmail($_POST['mail']);
$encrypt_pass = (new signupController()) -> encryptPass();
$today = date('Y-m-d');


if($action == 'send')
{
    $message = 'Voici vos informations :' . PHP_EOL; '<br/>';
    $message .= 'Nom : ' . $membre -> getNom() . PHP_EOL; '<br/>';
    $message .= 'Prénom : ' . $membre -> getPrenom() . PHP_EOL; '<br/>';
    $message .= 'Email : ' . $membre -> getEmail() . PHP_EOL; '<br/>';
    signupController::sendEmail();
}

$db = Model::getDb();

$inscription_query = 'INSERT INTO members (mail, lastname, firstname, password) VALUES (\'' . $membre -> getEmail() . '\', \'' . $membre -> getNom() . '\', \'' . $membre -> getPrenom() .'\', \'' . $encrypt_pass . '\')';

if(!($dbResult = mysqli_query($db, $inscription_query)))
{
    echo 'Erreur de requête<br/>';
    // Affiche le type d'erreur.
    echo 'Erreur : ' . mysqli_error($db) . '<br/>';
    // Affiche la requête envoyée.
    echo 'Requête : ' . $inscription_query . '<br/>';
    exit();
} else {
    echo 'Requête bien envoyée <br/>';
}

end_page();
?>