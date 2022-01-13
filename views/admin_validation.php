<?php
include 'template.php';
require_once '../models/Model.php';
start_page('Administration | Inscription');

$reqV = "SELECT * FROM validation";
$req_prep = Model::getPDO()->query($reqV);

while($validation = $req_prep->fetch())
{
    echo 'Nom  :';
    echo $validation['nom'];
    echo 'Prénom  :';
    echo $validation['prenom'];
    echo 'Email  :';
    echo $validation['mail'];
}