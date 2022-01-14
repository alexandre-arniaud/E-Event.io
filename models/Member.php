<?php

require_once dirname(__FILE__) . '/Model.php';

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
     * @description Méthode permettant a l'administrateur de valider l'inscription d'un utilisateur
     * @author Alexandre Arniaud
     */
    public function signup() {
        $contr = new ControllerUser();
        $password = $contr->generateRandomPass();
        $cryptpass = $contr->encryptPass($password);

        $reqI = "INSERT INTO members (login, mail, lastname, firstname, password) VALUES (:nL, :nM, :nN, :nP, :nU);
                 DELETE FROM validation WHERE mail = :nM; ";

        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            $values = array(
                "nL" => (strtolower(self::getFirstNameValidation()) . '.' . strtolower(self::getNameValidation())),
                "nM" => strtolower(self::getMailValidation()),
                "nN" => (ucfirst(strtolower(self::getNameValidation()))),
                "nP" => (ucfirst(strtolower(self::getFirstNameValidation()))),
                "nU" => $cryptpass
            );
            $req_prep->execute($values);

            if(password_verify($password, $cryptpass))
            {
                $membre = new Member(null, ucfirst(strtolower(self::getNameValidation())), ucfirst(strtolower(self::getFirstNameValidation())), self::getMailValidation(), strtolower(self::getFirstNameValidation()) . '.' . strtolower(self::getNameValidation()), $password);
                $inscription = new ControllerUser();
                $inscription->sendEmail($membre); // Envoi du mail a l'utilisateur avec ses identifiants de connexion
                return true;
            }
            else {
                return false;
            }
        }
        catch (PDOException $e) {
            require_once ('../views/error.php'); // fichier error.php a créer pour répertorier toutes les erreurs
            return false;
        }
    }

    /**
     * @return bool
     * @description Méthode permettant a l'administrateur de refuser l'inscription d'un utilisateur
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
            require_once ('../views/error.php'); // fichier error.php a créer pour répertorier toutes les erreurs
            return false;
        }
    }


    /**
     * @return bool
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
     * @author Alexandre Arniaud
     */
    public function resetPass() {
        $reqR = "UPDATE members SET password = :nP WHERE mail = :nM";
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
//                    ControllerSession::OpenSession();
                    session_start();

                    $_SESSION['nom'] = $resultat['lastname'];
                    $_SESSION['prenom'] = $resultat['firstname'];
                    $_SESSION['role'] = $resultat['role'];

                    return true;
                } else {
                    return false;
                }
            }
        }
    }


    public function getAllValidation(){
        $rep = Model::getPDO()->query("SELECT * FROM validation ");
        $tab = $rep->fetchAll();
        return $tab;
    }
    public function getAllMembers(){
        $rep = Model::getPDO()->query("SELECT * FROM members ");
        $tab = $rep->fetchAll();
        return $tab;
    }


    public function getNameValidation(){
        $nom = $_POST['nom'];
        return $nom;
    }

    public function  getFirstNameValidation(){
        $prenom = $_POST['prenom'];
        return $prenom;
    }

    public function  getMailValidation(){
        $mail = $_POST['mail'];
        return $mail;
    }

    public function updateRole(){
        $sql = 'UPDATE members SET role = :ro WHERE mail = :m';
        $rep = Model::getPDO()->prepare($sql);
        $values = array("ro" => $_POST['update'],
            "m" => $_POST['mail']);
        echo $_POST['update'];
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
