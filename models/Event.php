<?php

require_once(dirname(__FILE__) . '/Model.php');

final class Event
{
    private $id_proj;
    private $nom_proj;
    private $orga;
    private $nb_pts;
    private $desc;
    private $comm;

    public function __construct($id_proj, $nom_proj, $orga, $nb_pts, $desc, $comm)
    {
        if (!is_null($id_proj)) { $this->id_proj = $id_proj ; }
        if (!is_null($nom_proj)) { $this->nom_proj = $nom_proj; }
        if (!is_null($orga)) { $this->orga = $orga; }
        if (!is_null($nb_pts)) { $this->nb_pts = $nb_pts; }
        if (!is_null($desc)) { $this->desc = $desc; }
        if (!is_null($comm)) { $this->comm = $comm; }
    }

    public function addEvent() {
        $reqI = "INSERT INTO event (proj_name, organizer, description) VALUES (:nN, :nR, :nD)";
        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            $values = array(
                "nN" => $_POST['nomP'],
                "nR" => $_POST['numOrg'], //session_id(),
                "nD" => $_POST['description']
            );
            $req_prep->execute($values);

            return true;
        }
        catch (PDOException $e) {

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
     * @param $orga
     */
    public function setOrga($orga)
    {
        $this->orga = $orga;
    }


    /**
     * @return mixed $orga
     */
    public function getOrga()
    {
        return $this->orga;
    }


    /**
     * @param $nb_pts
     */
    public function setNb_pts($nb_pts)
    {
        $this->nb_pts = $nb_pts;
    }


    /**
     * @return mixed $nb_pts
     */
    public function getNb_pts()
    {
        return $this->nb_pts;
    }

    /**
     * @param $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }


    /**
     * @return mixed $desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param $comm
     *
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
    }


    /**
     * @return mixed $comm
     */
    public function getComm()
    {
        return $this->comm;
    }
}