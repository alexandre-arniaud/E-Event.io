<?php
 $dbLink = mysqli_connect(mysql-aarniaud.alwaysdata.net, aarniaud, Alphakiller04380)
 or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

 mysqli_select_db($dbLink , aarniaud_e-event-io)
 or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink)
);
?>
