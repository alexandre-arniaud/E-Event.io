<?php

class ControllerSession
{
    public static function OpenSession() {
        session_start(); //ouvre une session au nom de l'utisateur
        return;
    }


    public static function CloseSession() {
        try {
            session_destroy(); //suprimme une session du nom de l'utilisateur sans détruire $_SESSION
            return;
        } catch(Exception $e) {
            echo "Erreur: Cette session n'existe pas !";
            return;
        }
    }

    public static function SetRole($user, $role) {
        try {
            $_SESSION[$user] = $role; //créer ou modifie le role de l'utilisateur
            return;
        } catch(Exception $e) {
            echo "Erreur: Session fermé !";
            return;
        }
    }

    public static function GetRole($user) {
        try {
            return $_SESSION[$user]; //revoie le role de l'utilisateur
        } catch(Exception $e) {
            echo "Erreur: Session fermé !";
            return;
        }
    }
}
?>