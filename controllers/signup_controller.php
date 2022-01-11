<?php
require_once (File::build_path(array("data-processing.php")));

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
    public function sendEmail($membre)
    {
        $emailMessage = 'Bienvenue sur E-event.io, ' . $membre->getPrenom() . ' ! ' . "\n";
        $emailMessage .= 'Voici tes identifiants afin de te connecter sur le site : ' . "\n";
        $emailMessage .= 'Identifiant : ' . $membre->getLogin() . "\n";
        $emailMessage .= 'Mot de passe : ' . $this->generateRandomPass() . "\n";
        $emailMessage .= 'Le mot de passe sera modifiable directement depuis le site, dans les paramètres de ton compte mais attention, ne le divulge à personne';

        $object = "E-Event.io: Confirmation d'inscription";
        mail($membre->getEmail(), $object, utf8_decode($emailMessage));
    }
}