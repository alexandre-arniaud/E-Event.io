<?php

class ControllerSession
{
    public static function is_admin() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'admin')
                return true;
            return false;
        }
        return false;
    }

    public static function is_jury() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'jury')
                return true;
            return false;
        }
        return false;
    }

    public static function is_organisateur() {
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'organisateur')
                return true;
            return false;
        }
        return false;
    }

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