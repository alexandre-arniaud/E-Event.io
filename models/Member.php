<?php

require_once ('Model.php');

final class Member
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $login;
    private $pass;

    public function __construct($id, $nom, $prenom, $email, $login)
    {
        if (!is_null($id)) { $this->id = $id ; }
        if (!is_null($nom)) { $this->nom = $nom; }
        if (!is_null($prenom)) { $this->prenom = $prenom; }
        if (!is_null($email)) { $this->email = $email; }
        if (!is_null($login)) { $this->login = $login; }
    }

    public function signup() {
        $reqI = "INSERT INTO members (login, mail, lastname, firstname, password) VALUES (:nL, :nM, :nN, :nP, :nU)";
        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            $encrypt_pass = (new ControllerSignup()) -> encryptPass();
            $values = array(
                "nL" => (strtolower($_POST['prenom']) . '.' . strtolower($_POST['nom'])),
                "nM" => $_POST['mail'],
                "nN" => $_POST['nom'],
                "nP" => $_POST['prenom'],
                "nU" => $encrypt_pass
            );
            $req_prep->execute($values);
            echo "CA MARCHE !!!";
            $membre = new Member(null, $_POST['nom'], $_POST['prenom'], $_POST['mail'], strtolower($_POST['prenom']) . '.' . strtolower($_POST['nom']));
            $inscription = new ControllerSignup();
            $inscription->sendEmail($membre); // Envoi du mail a l'utilisateur avec ses identifiants de connexion
            return true;
        }
        catch (PDOException $e) {
            require_once ('../views/error.php'); // fichier error.php a créer pour répertorier toutes les erreurs
            return false;
        }
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


}
