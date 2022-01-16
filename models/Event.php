<?php

require_once(dirname(__FILE__) . '/Model.php');
require_once dirname(__FILE__) . '/../models/Campaign.php';

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

    /**
     * @description Méthode permettant de d'ajouter un évènement dans la campagne en cours - Le créateur de l'évènement devient organisateur
     * @author Alexandre Arniaud
     */
    public function addEvent() {
        $organizer = $_SESSION['prenom'] . ' ' . $_SESSION['nom'];

        $reqA = "INSERT INTO event (proj_name, organizer, location, description) VALUES (:nN, :nR, :nL, :nD)";
        $reqB = "SELECT * FROM event WHERE organizer = '$organizer' ORDER BY id DESC";
        $reqC = "INSERT INTO lineCampaign (id_camp, id_event) VALUES (:iC, :iE)";
        $reqD = "UPDATE members SET role = 'organisateur' WHERE id_member = :iiD";
        try {
            $req_prepA = Model::getPDO()->prepare($reqA);
            $req_prepC = Model::getPDO()->prepare($reqC);
            $req_prepD = Model::getPDO()->prepare($reqD);
            $values = array(
                "nN" => $_POST['name'],
                "nR" => $organizer,
                "nL" => $_POST['place'],
                "nD" => $_POST['desc'],
            );
            $req_prepA->execute($values);

            $req_prepB = Model::getPDO()->query($reqB);
            $tabB = $req_prepB->fetch();

            $camp = array(
                "iC" => Campaign::getCurrentCampaign(),
                "iE" => $tabB['id']
            );
            $req_prepC->execute($camp);

            $id = array(
                "iiD" => $_SESSION['id_member']
            );
            $req_prepD->execute($id);
            return true;
        }
        catch (PDOException $e) {

            return false;
        }
    }

    /**
     * @description Méthode permettant de voter pour un évènement et donc de lui donner des points
     * @author Karim Boudjaoui
     */
    public function addVote() {
        $id = $_SESSION['id_member'];
        $id_event = $_POST['id_event'];

        $reqA = "SELECT * FROM event WHERE id = '$id_event'";
        $reqB = "UPDATE event SET totalPoints = :P WHERE id = '$id_event'";
        $reqC = "UPDATE members SET points = :M WHERE id_member = '$id'";

        try {
            $req_A = Model::getPDO()->query($reqA);
            $tabA = $req_A->fetch();
            $add_pts = $tabA['totalPoints'] + $_POST['points'];

            $req_prepB = Model::getPDO()->prepare($reqB);
            $increment = array(
                "P" => $add_pts);
            $req_prepB->execute($increment);

            $sub_pts = $_SESSION['points'] - $_POST['points'];

            $req_prepC = Model::getPDO()->prepare($reqC);
            $decrement = array(
                "M" => $sub_pts);
            $req_prepC->execute($decrement);

            $_SESSION['points'] = $_SESSION['points'] - $_POST['points'];

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