<?php

final class Member extends Model
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $login;

    public function __construct($id, $nom, $prenom, $email, $login)
    {
        parent::__construct();
        if (!is_null($id)) { $this->id = $id ; }
        if (!is_null($nom)) { $this->nom = $nom; }
        if (!is_null($prenom)) { $this->prenom = $prenom; }
        if (!is_null($email)) { $this->email = $email; }
        if (!is_null($login)) { $this->login = $login; }
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
    public function setLogin($email)
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
