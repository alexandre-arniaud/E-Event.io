<?php

class ControllerSession
{
    /**
     * @description Methode permettant d'attribuer le rôle de la session en "admin" si l'utilisateur est un admin
     * @author Marius Garnier
     */
    public static function is_admin() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'admin')
                return true;
            return false;
        }
        return false;
    }

    /**
     * @description Methode permettant d'attribuer le rôle de la session en "jury" si l'utilisateur est un jury
     * @author Marius Garnier
     */
    public static function is_jury() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'jury')
                return true;
            return false;
        }
        return false;
    }

    /**
     * @description Methode permettant d'attribuer le rôle de la session en "organisateur" si l'utilisateur est un jury
     * @author Marius Garnier
     */
    public static function is_organisateur() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'organisateur')
                return true;
            return false;
        }
        return false;
    }

    /**
     * @description Methode permettant d'attribuer le rôle de la session en "donateur" si l'utilisateur est un donateur
     * @author Marius Garnier
     */
    public static function is_donateur() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'donateur')
                return true;
            return false;
        }
        return false;
    }
}
?>