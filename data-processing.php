<?php
include 'functions.php';
start_page("Data processing");

$action = $_POST['action'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($action == 'send')
{
    $message = 'Voici vos informations :' . PHP_EOL; '</br>';
    $message .= 'Nom : ' . $nom . PHP_EOL; '</br>';
    $message .= 'Prénom : ' . $prenom . PHP_EOL; '</br>';
    $message .= 'Email : ' . $email . PHP_EOL; '</br>';
    $message .= 'Mot de passe : ' . $password . PHP_EOL;
    echo $message;
}
else
{
    echo '<br/><strong>Bouton non géré !</strong><br/>';
}

end_page();
?>
