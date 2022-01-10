<?php

class models
{
    protected static $db = null;
    try
    {
        $dbLink = mysqli_connect(mysql-aarniaud.alwaysdata.net, aarniaud, Alphakiller04380)
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink , aarniaud_e-event-io)
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    }
    catch (Exception $e)
    {

    }

    $req = $dbLink->prepare('SELECT  * FROM EVENT');
    $req->execute(array($eventId));
    $events = $req->fetch();

    return $events;
}
?>