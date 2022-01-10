<?php

require('./config/config.php');

class model
{
    protected static $dbLink = null;


    public function __construct()
    {
        return self::getDb();
    }


    public function connexion()
    {
        return self::$dbLink;
    }


    public static function getDb()
    {
        if (self::$dbLink == null) {
            self::$dbLink = mysqli_connect(db_host, db_user, db_password)
            or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

            mysqli_select_db(self::$dbLink , db_name)
            or die('Erreur dans la sélection de la base : ' . mysqli_error(self::$dbLink));
        }

        return self::$dbLink;
    }


    public function __destruct()
    {
        self::$dbLink == null;
    }
}
?>