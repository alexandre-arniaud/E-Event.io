<?php

final class signupController
{
    public function signup()
    {

    }

    /**
     * Génère un mot de passe aléatoire
     * @return string
     * author Alexandre Arniaud
     */
    public function generateRandomPass()
    {
        $bytes = openssl_random_pseudo_bytes(8);
        $pass = bin2hex($bytes);
        return $pass;
    }
}