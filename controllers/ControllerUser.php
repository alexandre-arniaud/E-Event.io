<?php
require_once dirname(__FILE__) . '/../models/Member.php';
require_once dirname(__FILE__) . '/../controllers/routeur.php';

class ControllerUser
{

    /**
     * @description Methode permettant de vérifier que la validation de l'inscription faite par l'administrateur a eu lieu et redirige vers la page de connexion
     * @author Alexandre Arniaud
     */
    public function readSignup() {
        session_start();
        $signup = Member::signup();

        if ($signup == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            if ($_SESSION['role'] == 'admin')
            {
                header("Location: ../views/admin_validation.php");
            }
            else
            {
                header("Location: ../views/error.php");
            }
        }
    }


    /**
     * @description Methode permettant de vérifier que la pre-validation de l'inscription faite par l'utilisateur a eu lieu et redirige vers la page de connexion
     * @author Alexandre Arniaud
     */
    public function readValidation() {
        $validation = Member::validation();

        if ($validation == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            header("Location: ../views/waitValidation.php");
        }
    }


    /**
     * @description Methode permettant de vérifier que le refus de l'inscription faite par l'administrateur a eu lieu et redirige vers la page de gestion des inscriptions en attente
     * @author Alexandre Arniaud
     */
    public function readRefuseSignup() {
        session_start();
        $refus = Member::refuse_signup();

        if ($refus == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            if ($_SESSION['role'] == 'admin')
            {
                header("Location: ../views/admin_validation.php");
            }
            else
            {
                header("Location: ../views/error.php");
            }
        }
    }


    /**
     * @description Methode permettant de vérifier que le changement de mot de passe (oublié) faite par l'utilisateur a eu lieu et redirige vers la page de connexion
     * @author Alexandre Arniaud
     */
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


    /**
     * @description Methode permettant de vérifier que la connexion de l'utilisateur a été réalisée redirige vers le tableau de bord
     * @author Alexandre Arniaud
     */
    public function readLogin() {
        session_start();
        $login = Member::loginMember();

        if ($login == false)
        {
            header("Location: ../views/error.php");
        }
        elseif ($_SESSION['is_pass_change'] == 0)
        {
            header("Location: ../views/force_change_password.php");
        }
        elseif ($_SESSION['is_pass_change'] == 1)
        {
            header("Location: ../views/accueil.php");
        }
    }

    /**
     * @description Methode permettant de vérifier que la connexion de l'utilisateur a été réalisée redirige vers le tableau de bord
     * @author Alexandre Arniaud
     */
    public function readChangePass() {
        session_start();
        $change_pass = Member::forceChangePass();

        if ($change_pass == false)
        {

            header("Location: ../views/error.php");
        }
        else
        {
            header("Location: ../views/accueil.php");
        }
    }


    /**
     * @description Methode permettant de supprimer la session courrante ainsi que ses paramètres
     * @author Marius Garnier
     */
    public function deleteSession(){
        session_unset();
        session_destroy();
        header("Location: ../views/login.php");

    }

    /**
     * @description Methode permettant à l'administrateur de mettre à jour le rôle de l'utilisateur
     * @author Marius Garnier
     */
    public function readUpdateRole(){
        $update = Member::updateRole();

        if ($update == false)
        {
            header("Location: ../views/error.php");
        }
        else
        {
            header("Location: ../views/gestionnaire_role.php");
        }
    }


    /**
     * @description Génère un mot de passe aléatoire lors de l'inscription
     * @return string Mot de passe alétoire non encrpyté
     * @author Alexandre Arniaud
     */
    public function generateRandomPass()
    {
        $combinaisons = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $melange = str_shuffle($combinaisons);
        $pass = substr($melange,0,8);
        return $pass;
    }


    /**
     * @description Encrpyte le mot de passe généré aléatoirement
     * @return string Mot de passe alétoire encrypté prêt à être ajouté dans la base de données
     * @author Alexandre Arniaud
     */
    public function encryptPass($password)
    {
        $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);
        return $encrypt_pass;
    }


    /**
     * @description Envoi une confirmation d'inscription ainsi que les identifiants générés par mail a l'utilisateur pour la connexion
     * @author Alexandre Arniaud
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



    /**
     * @description Envoi le mot de passe généré par mail a l'utilisateur pour la connexion suite à sa demande de mot de passe oublié
     * @author Alexandre Arniaud
     */
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


    /**
     * @description Envoi le mot de passe généré par mail a l'utilisateur pour lui informer que son inscription a été refusée
     * @author Alexandre Arniaud
     */
    public function sendEmailEchec($mail)
    {
        $emailMessage = 'Bonjour,' . "\n";
        $emailMessage .= 'Tu as récemment fait une demande d\'inscription sur notre site.' . "\n";
        $emailMessage .= 'Ta demande à d\'inscription n\'a pas aboutie ou a été refusée par un administrateur' . "\n";
        $emailMessage .= 'Nous t\'invitons tout de même à te re-inscrire sur le site !' . "\n";

        $object = "E-Event.io: Demande d'inscription refusée";
        mail($mail, $object, utf8_decode($emailMessage));
    }
}