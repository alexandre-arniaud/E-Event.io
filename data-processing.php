<?php
include 'template.php';
start_page("Data processing");

$action = $_POST['action'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$password = crypt($_POST['password']);
$confirm_password = crypt($_POST['confirm_password']);
$today = date('Y-m-d');

if($action == 'send' && $password == $confirm_password)
{
    $message = 'Voici vos informations :' . PHP_EOL; '<br/>';
    $message .= 'Nom : ' . $nom . PHP_EOL; '<br/>';
    $message .= 'Prénom : ' . $prenom . PHP_EOL; '<br/>';
    $message .= 'Email : ' . $email . PHP_EOL; '<br/>';
    $message .= 'Mot de passe : ' . $password . PHP_EOL;
    echo $message;
}

$dbLink = mysqli_connect('mysql-aarniaud.alwaysdata.net', 'aarniaud', 'Alphakiller04380$$')
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

mysqli_select_db($dbLink , 'aarniaud_e-event-io')
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink)
);

$inscription_query = 'INSERT INTO user (lastname, firstname, mail, password, date) VALUES (\'' . $nom . '\', \'' . $prenom . '\', \'' . $email . '\', \'' . $password . '\', \'' . $today . '\')';

if(!($dbResult = mysqli_query($dbLink, $inscription_query)))
{
    echo 'Erreur de requête<br/>';
    // Affiche le type d'erreur.
    echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
    // Affiche la requête envoyée.
    echo 'Requête : ' . $inscription_query . '<br/>';
    exit();
} else {
    echo 'Requête bien envoyée <br/>';
}

end_page();
?>