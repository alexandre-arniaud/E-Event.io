<?php
include 'template.php';
include './models/model.php';
start_page("Data processing");

$action = $_POST['action'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$today = date('Y-m-d');

$bytes = openssl_random_pseudo_bytes(8);
$pass = bin2hex($bytes);
$encryp_pass = crypt($pass);


$emailMessage = 'Bienvenue sur E-event.io' .$prenom .' ! <br/>';
$emailMessage .= 'Voici ton mot de passe afin de te connecter sur le site : ' . $pass . '<br/>';
$emailMessage .= 'Tu pourras le modifier directement sur le site, dans l\'onglet paramètres mais attention, ne le divulge à personne';

$object = "E-Event.io: Confirmation d'inscription";



if($action == 'send')
{
    $message = 'Voici vos informations :' . PHP_EOL; '<br/>';
    $message .= 'Nom : ' . $nom . PHP_EOL; '<br/>';
    $message .= 'Prénom : ' . $prenom . PHP_EOL; '<br/>';
    $message .= 'Email : ' . $email . PHP_EOL; '<br/>';
    $message .= 'Mot de passe : ' . $pass . PHP_EOL; '<br/>';
    mail($email, $object, $emailMessage);
    echo $message;
}

$db = model::getDb();

$inscription_query = 'INSERT INTO members (mail, lastname, firstname, password) VALUES (\'' . $email . '\', \'' . $nom . '\', \'' . $prenom .'\', \'' . $encryp_pass . '\')';

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