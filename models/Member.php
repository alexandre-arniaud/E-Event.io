<?php

require_once dirname(__FILE__) . '/Model.php';
require_once dirname(__FILE__) . '/Campaign.php';

final class Member
{

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $login;
    private $pass;

    public function __construct($id, $nom, $prenom, $email, $login, $pass)
    {
        if (!is_null($id)) { $this->id = $id ; }
        if (!is_null($nom)) { $this->nom = $nom; }
        if (!is_null($prenom)) { $this->prenom = $prenom; }
        if (!is_null($email)) { $this->email = $email; }
        if (!is_null($login)) { $this->login = $login; }
        if (!is_null($pass)) { $this->pass = $pass; }
    }

    /**
     * @return bool
     * @description Méthode permettant a l'administrateur de générer un login et un mot de passe valider l'inscription d'un utilisateur
     * @author Alexandre Arniaud
     */
    public function signup() {
        $contr = new ControllerUser();
        $password = $contr->generateRandomPass();
        $cryptpass = $contr->encryptPass($password);
        $login = self::verifyLogin(strtolower(self::getFirstNameValidation()) . '.' . strtolower(self::getNameValidation()));

        $reqI = "INSERT INTO members (login, mail, lastname, firstname, password, role, points) VALUES (:nL, :nM, :nN, :nP, :nU, :nR, :nPo);
                 DELETE FROM validation WHERE mail = :nM; ";

        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            /* Vérification campagne en cours :
            Oui → l'utilisateur se voit attribuer le nombre de points de la campagne
            Non → l'utilisateur est créé avec 0 points
            */
            if (Campaign::getCurrentCampaign() == null) {
               $points =  0;
            }
            else {
                $points = Campaign::getCurrentCampaign()['default_points'];
            }
            $values = array(
                "nL" => $login,
                "nM" => strtolower(self::getMailValidation()),
                "nN" => (ucfirst(strtolower(self::getNameValidation()))),
                "nP" => (ucfirst(strtolower(self::getFirstNameValidation()))),
                "nU" => $cryptpass,
                "nR" => 'donateur',
                "nPo" => $points
            );
            $req_prep->execute($values);

            if(password_verify($password, $cryptpass))
            {
                $membre = new Member(null, ucfirst(strtolower(self::getNameValidation())), ucfirst(strtolower(self::getFirstNameValidation())), self::getMailValidation(), $login, $password);
                $inscription = new ControllerUser();
                $inscription->sendEmail($membre); // Envoi du mail a l'utilisateur avec ses identifiants de connexion
                return true;
            }
            else {
                return false;
            }
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @return bool
     * @description Méthode permettant a l'administrateur de refuser l'inscription d'un utilisateur avec l'envoi d'un mail le lui indiquant
     * @author Alexandre Arniaud
     */
    public function refuse_signup() {
        $reqI = "DELETE FROM validation WHERE mail = :nM ;";

        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            $values = array(
                "nM" => strtolower(self::getMailValidation())
            );
            $req_prep->execute($values);
            $refus = new ControllerUser();
            $refus->sendEmailEchec(strtolower(self::getMailValidation())); // Envoi du mail a l'utilisateur lui indiquant que son inscription a été refusée et l'invitant à se ré-inscrire.
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }


    /**
     * @return bool
     * @description Méthode permettant a l'utilisateur de valider son inscription et de la mettre en liste d'attente chez l'administrateur
     * @author Alexandre Arniaud
     */
    public function validation() {
        $mail = strtolower($_POST['mail']);
        $reqV = "SELECT * FROM validation WHERE validation.mail = '" . $mail . "'";
        $reqM = "SELECT * FROM members WHERE members.mail = '" . $mail . "'";
        $req_v = Model::getPDO()->query($reqV);
        $req_m = Model::getPDO()->query($reqM);

        $reqI = "INSERT INTO validation (nom, prenom, mail) VALUES (:nL, :nM, :nN)";

        try {
            if (!$req_v->fetch() AND !$req_m->fetch())
            {
                $req_prepare = Model::getPDO()->prepare($reqI);
                $values = array(
                    "nL" => (ucfirst(strtolower($_POST['nom']))),
                    "nM" => (ucfirst(strtolower($_POST['prenom']))),
                    "nN" => strtolower($_POST['mail'])
                );
                $req_prepare->execute($values);
                return true;
            } else {
                return false;
            }
        }
        catch (PDOException $e) {
            return false;
        }
    }


    /**
     * @return bool
     * @description Méthode permettant a de générer un nouveau mot de passe alétoire pour l'utilisateur si celui-ci l'a oublié ( envoi par mail )
     * @author Alexandre Arniaud
     */
    public function resetPass() {
        $reqR = "UPDATE members SET password = :nP, is_pass_change = 0 WHERE mail = :nM";
        try {
            $req_prep = Model::getPDO()->prepare($reqR);
            $password = (new ControllerUser)->generateRandomPass();
            $encrypt_pass = (new ControllerUser()) -> encryptPass($password);
            $values = array(
                "nP" => $encrypt_pass,
                "nM" => $_POST['mail']
            );
            $req_prep->execute($values);
            if(password_verify($password, $encrypt_pass))
            {
                $inscription = new ControllerUser();
                $inscription->sendEmailReset($_POST['mail'], $password); // Envoi du mail a l'utilisateur avec son nouveau mot de passe
                return true;
            }
            else {
                return false;
            }

        }
        catch (PDOException $e) {
            return false;
        }
    }


    /**
     * @return bool
     * @description Méthode permettant de forcer le changement de mot de passe a la première connexion
     * @author Alexandre Arniaud
     */
    public function forceChangePass() {
        session_start();

        $pass = $_POST['mdp'];
        $confirm_pass = $_POST['mdp2'];

        if ($pass != $confirm_pass) {
            return false;
        }

        $crypt = new ControllerUser();
        $encrypt_pass = $crypt->encryptPass($pass);

        $reqA = "UPDATE members SET password = :nP WHERE mail = :nM";
        $reqB = "UPDATE members SET is_pass_change = :nI WHERE mail = :nM";

        try {
            $req_prepA = Model::getPDO()->prepare($reqA);
            $req_prepB = Model::getPDO()->prepare($reqB);
            $valuesA = array(
                "nP" => $encrypt_pass,
                "nM" => $_SESSION['mail']
            );
            $valuesB = array(
                "nI" => '1',
                "nM" => $_SESSION['mail']
            );
            $req_prepA->execute($valuesA);
            $req_prepB->execute($valuesB);
            $_SESSION['is_pass_change'] = '1';
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }



    /**
     * @description Méthode permettant de vérifier les identifiants de connexion puis de lancer la connexion et le démarrage de la $_SESSION
     * @author Alexandre Arniaud
     */
    public function loginMember() {
        if (isset($_POST['login']) AND isset($_POST['password'])) {
            if (!empty($_POST['login']) and !empty($_POST['password'])) {
                $login = $_POST['login'];
                $req = Model::getPDO()->prepare('SELECT * FROM members WHERE login = :login');
                $req->execute(array(
                    'login' => $login));
                $resultat = $req->fetch();

                if (password_verify($_POST['password'], $resultat['password'])) {
                    session_start();

                    $_SESSION['id_member'] = $resultat['id_member'];
                    $_SESSION['nom'] = $resultat['lastname'];
                    $_SESSION['prenom'] = $resultat['firstname'];
                    $_SESSION['mail'] = $resultat['mail'];
                    $_SESSION['role'] = $resultat['role'];
                    $_SESSION['points'] = $resultat['points'];
                    $_SESSION['is_pass_change'] = $resultat['is_pass_change'];
                    return true;
                } else {
                    return false;
                }
            }
            else return false;
        }
        else return false;
    }

    /**
     * @description Methode permettant à l'utilisateur de changer son mot de passe a tout moment
     * @author Alexandre Arniaud et Marius Garnier
     */
    public function ChangePass() {
        session_start();

        $req = "SELECT * FROM members WHERE mail = :mail";
        $reqA = "UPDATE members SET password = :nP WHERE mail = :nM";

        try {
            $req_prep = Model::getPDO()->prepare($req);

            $values = array(
                "mail" => $_SESSION['mail']
            );
            $req_prep->execute($values);
            $resultat = $req_prep->fetch();
            var_dump($resultat['password']);

            if (password_verify($_POST['ancienMdp'], $resultat['password'])) {
                $new_Pass = $_POST['nouveauMdp'];
                $confirm_New_pass = $_POST['confirmeMdp'];

                if ($new_Pass != $confirm_New_pass) {
                    return false;
                }
                else{
                    $crypt = new ControllerUser();
                    $encrypt_pass = $crypt->encryptPass($new_Pass);

                    $req_prepA = Model::getPDO()->prepare($reqA);
                    $valuesA = array(
                        "nP" => $encrypt_pass,
                        "nM" => $_SESSION['mail']
                    );
                    $req_prepA->execute($valuesA);
                    $_SESSION['password'] = $new_Pass;
                    return true;
                }
            }
            else{
                return false;
            }

        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @description Méthode permettant de mettre à jour le rôle de l'utilisateur
     * @author Marius Garnier
     */
    public function updateRoleAdmin(){
        $sql = 'UPDATE members SET role = :ro WHERE mail = :m';

        $rep = Model::getPDO()->prepare($sql);
        $values = array("ro" => $_POST['update'],
            "m" => $_POST['mail']);
        echo $_POST['update'];
        $rep-> execute($values);
        return true;
    }


    public function updateSessionValues() {
        $login = $_SESSION['login'];
        $req = Model::getPDO()->prepare('SELECT * FROM members WHERE login = :login');
        try {
            $req->execute(array(
                'login' => $login));
            $resultat = $req->fetch();

            session_start();
            $_SESSION['role'] = $resultat['role'];
            $_SESSION['points'] = $resultat['points'];
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @description Méthode permettant de récupérer tous les utilisateurs en attente de leurs inscription
     * @author Marius Garnier
     */
    public function getAllValidation(){
        $rep = Model::getPDO()->query("SELECT * FROM validation ");
        $tab = $rep->fetchAll();
        return $tab;
    }

    /**
     * @description Méthode permettant de récupérer tous les utilisateurs
     * @author Marius Garnier
     */
    public function getAllMembers(){
        $rep = Model::getPDO()->query("SELECT * FROM members ");
        $tab = $rep->fetchAll();
        return $tab;
    }

    /**
     * @description Méthode permettant de récupérer le nom de l'utilisateur précis en attente de son inscription
     * @author Marius Garnier
     */
    public function getNameValidation(){
        $nom = $_POST['nom'];
        return $nom;
    }

    /**
     * @description Méthode permettant de récupérer le prénom de l'utilisateur précis en attente de son inscription
     * @author Marius Garnier
     */
    public function  getFirstNameValidation(){
        $prenom = $_POST['prenom'];
        return $prenom;
    }

    /**
     * @description Méthode permettant de récupérer le mail de l'utilisateur précis en attente de son inscription
     * @author Marius Garnier
     */
    public function  getMailValidation(){
        $mail = $_POST['mail'];
        return $mail;
    }


    /**
     * @description Méthode permettant de générer un login unique, même si deux personnes ont le même prénom et nom
     * @author Alexandre Arniaud & Marius Garnier
     */
    public function verifyLogin($login){
        $sql = "SELECT * FROM members WHERE login = '$login'";
        try {
            $req = Model::getPDO()->query($sql);
            if ($req->fetch() > 0) {
                $newLogin = $login . rand(0, 100);
                self::verifyLogin($newLogin); // En considérant qu'il n'y aura pas plus de 100 personnes ayant le même prénom et nom
                }
            else {
                return $login;
            }
            return $newLogin;
        }
        catch (PDOException $e) {
            return NULL;
        }
    }


    public function updateDefaultPoint(){
        $sql = 'UPDATE members SET nb_points = :p WHERE role = :r';
        $rep = Model::getPDO()->prepare($sql);
        $values = array("p" => $_POST['default_points'],
            "r" => 'donateur',
        );
        $rep-> execute($values);
        return true;
    }


    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed $id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    /**
     * @return mixed $nom
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * @param $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


    /**
     * @return mixed $prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return mixed $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }


    /**
     * @return mixed $login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }


    /**
     * @return mixed $pass
     */
    public function getPass()
    {
        return $this->pass;
    }


}
