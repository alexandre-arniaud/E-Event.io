<?php
include 'template.php';
include './models/model.php';
start_page("Data processing");

$action = $_POST['action'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$today = date('Y-m-d');

if($action == 'send')
{
    $message = 'Voici vos informations :' . PHP_EOL; '<br/>';
    $message .= 'Nom : ' . $nom . PHP_EOL; '<br/>';
    $message .= 'Prénom : ' . $prenom . PHP_EOL; '<br/>';
    $message .= 'Email : ' . $email . PHP_EOL; '<br/>';
    echo $message;
}

$db = model::getDb();

$inscription_query = 'INSERT INTO members (mail, lastname, firstname) VALUES (\'' . $email . '\', \'' . $nom . '\', \'' . $prenom .'\')';

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