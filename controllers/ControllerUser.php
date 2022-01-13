<?php
require_once(dirname(__FILE__) . '/../models/Member.php');
require_once(dirname(__FILE__) . '/../controllers/routeur.php');
require_once(dirname(__FILE__) . '/../controllers/ControllerSession.php');

class ControllerUser
{

    public function readSignup() {
        $signup = Member::signup();

        if ($signup == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            header("Location: ../views/login.php");
        }
    }

    public function readValidation() {
        $validation = Member::validation();

        if ($validation == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            echo "Votre inscription a bien été prise en compte, vous recevrez prochainement un mail de confirmation";
            header("Location: ../views/login.php");
        }
    }


    public function readResetPassword() {
        $reset = Member::resetPass();

        if ($reset == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            header("Location: ../views/login.php");
        }
    }

    public function readLogin() {
        $login = Member::loginMember();

        if ($login == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            ControllerSession::OpenSession();
            header("Location: ../views/newEvent.php");

        }
    }


    /**
     * Génère un mot de passe aléatoire lors de l'inscription
     * @return string Mot de passe alétoire non encrpyté
     * author Alexandre Arniaud
     */
    public function generateRandomPass()
    {
        $combinaisons = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $melange = str_shuffle($combinaisons);
        $pass = substr($melange,0,8);
        return $pass;
    }


    /**
     * Encrpyte le mot de passe généré aléatoirement
     * @return string Mot de passe alétoire encrypté prêt à être ajouté dans la base de données
     * author Alexandre Arniaud
     */
    public function encryptPass($password)
    {
        $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);
        return $encrypt_pass;
    }


    /**
     * Envoi le mot de passe généré par mail a l'utilisateur pour la connexion
     * author Alexandre Arniaud
     */
    public function sendEmail($membre)
    {
        $emailMessage = 'Bienvenue sur E-event.io, ' . $membre->getPrenom() . ' ! ' . "\n";
        $emailMessage .= 'Voici tes identifiants afin de te connecter sur le site : ' . "\n";
        $emailMessage .= 'Identifiant : ' . $membre->getLogin() . "\n";
        $emailMessage .= 'Mot de passe : ' . $membre->getPass() . "\n";
        $emailMessage .= 'Le mot de passe sera modifiable directement depuis le site, dans les paramètres de ton compte mais attention, ne le divulge à personne';

        $object = "E-Event.io: Confirmation d'inscription";
        mail($membre->getEmail(), $object, utf8_decode($emailMessage));
    }

    public function sendEmailReset($mail, $password_n)
    {
        $emailMessage = 'Bonjour,' . "\n";
        $emailMessage .= 'Tu as récemment fait une demande de mot de passe sur le compte associé à cette adresse mail.' . "\n";
        $emailMessage .= 'Voici votre nouveau mot de passe' . "\n";
        $emailMessage .= 'Mot de passe : ' . $password_n . "\n";
        $emailMessage .= 'Le mot de passe sera modifiable directement depuis le site, dans les paramètres de ton compte mais attention, ne le divulge à personne';

        $object = "E-Event.io: Confirmation d'inscription";
        mail($mail, $object, utf8_decode($emailMessage));
    }
}