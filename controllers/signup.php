<?php
require('./models/Member.php');

final class signupController
{
    public function signup()
    {

    }

    /**
     * Génère un mot de passe aléatoire lors de l'inscription
     * @return string Mot de passe alétoire non encrpyté
     * author Alexandre Arniaud
     */
    public function generateRandomPass()
    {
        $bytes = openssl_random_pseudo_bytes(8);
        $pass = bin2hex($bytes);
        return $pass;
    }


    /**
     * Encrpyte le mot de passe généré aléatoirement
     * @return string Mot de passe alétoire encrypté prêt a être ajouté dans la base de données
     * author Alexandre Arniaud
     */
    public function encryptPass()
    {
        $encrypt_pass = crypt((new signupController) -> generateRandomPass());
        return $encrypt_pass;
    }


    /**
     * Envoi le mot de passe généré par mail a l'utilisateur pour la connexion
     * author Alexandre Arniaud
     */
    public function sendEmail()
    {
        $emailMessage = 'Bienvenue sur E-event.io' . (new Member) -> getPrenom() .' ! <br/>';
        $emailMessage .= 'Voici ton mot de passe afin de te connecter sur le site : ' . $this->generateRandomPass() . '<br/>';
        $emailMessage .= 'Tu pourras le modifier directement sur le site, dans l\'onglet Paramètres mais attention, ne le divulge à personne';

        $object = "E-Event.io: Confirmation d'inscription";
        mail((new Member) -> getEmail(), $object, $emailMessage);
    }
}