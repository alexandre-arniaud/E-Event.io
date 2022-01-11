<?php
require_once ('lib/File.php');
require_once (File::build_path(array("config","config.php")));

class Model {
    private static $pdo = NULL;

    public static function init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); //sert à ce que toutes les chaines de caractères en entrée et sortie de MySql soit dans le codage UTF-8
        } catch(PDOException $erreur) {
            if (Conf :: getDebug()) {
                echo $erreur->getMessage(); //affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }

      die();
    }

  }

  public static function getPDO() {
    if (is_null(self::$pdo)) {
      self::init();
    }
    return self::$pdo;
  }

}

 ?>