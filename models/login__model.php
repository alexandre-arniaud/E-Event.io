<?php

class Login_Model extends Model
{

    public function __construct()
    {
        parent::_construct();
        Session::init();
    }

    public function run()
    {
        $mail = $_POST['mail'];
        $password = crypt($_POST['password']);

        $res = $this->db->select("SELECT * FROM 'member' WHERE mail = '".$mail."' AND password ) '".$password."'");
        $count = count($res);

        if ($count > 0) {

            Session::init();
            Session::set('role', "user");
            Session::set('loggedIn', true);
            Session::set('mail', $mail);
            Session::set('password', $res[0]['password']);
            header('location: '.URL.'login/index');
        }
        else {
            Session::set('loggedIn', false);
            header('location: '.URL);
        }
    }
}