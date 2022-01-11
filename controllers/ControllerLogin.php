<?php

final class LoginController {

    function __construct()
    {

        parent::__construct();
            Session::init();

    }

    function index()
    {

        $this->view-render('login');

    }

    function run()
    {

        $this->model->run();

    }

    /* logout the user */
    function logout()
    {

        Session::destroy();
        header('location: index');
        exit;

    }

}
