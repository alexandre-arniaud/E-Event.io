<?php
class Conf {

    static private $databases = array(
        // Le nom d'hote est celui de l'hébergeur utilisé, ici AlwaysData
        'hostname' => 'mysql-aarniaud.alwaysdata.net',
        // Le nom de la base de données sur phpMyAdmin
        'database' => 'aarniaud_e-event-io',
        // Le login du compte phpMyAdmin
        'login' => 'aarniaud',
        // Le mot de passe du compte phpMyAdmin
        'password' => 'Alphakiller04380$$'
    );

    static public function getLogin() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['login'];
    }

    static public function gethostname(){
        return self::$databases['hostname'];
    }

    static public function getdatabase(){
        return self::$databases['database'];
    }

    static public function getpassword(){
        return self::$databases['password'];
    }

    // la variable debug est un boolean
    static private $debug = True;

    static public function getDebug() {
        return self::$debug;
    }

}
?>