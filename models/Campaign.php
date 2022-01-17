<?php

require_once dirname(__FILE__) . '/Model.php';

final class Campaign
{
    private $id_camp;
    private $date_start;
    private $date_end;
    private $id_proj;


    public function __construct($id_proj, $nom_proj, $date_end, $nb_pts)
    {
        if (!is_null($id_proj)) { $this->id_camp = $id_proj ; }
        if (!is_null($nom_proj)) { $this->date_start = $nom_proj; }
        if (!is_null($date_end)) { $this->date_end = $date_end; }
        if (!is_null($nb_pts)) { $this->id_proj = $nb_pts; }

    }

    /**
     * @description Methode permettant à l'administrateur de créer une nouvelle campagne
     * @author Marius Ganier
     */
    public function addCampaign() {
        $reqI = "INSERT INTO `campaign` (camp_name, date_start, date_end, default_points ) VALUES (:cn, :ds, :de, :dp)";
        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            $values = array(
                "cn" => $_POST['nomC'],
                "ds" => date("Y-m-d"),
                "de" => $_POST['trip-end'],
                "dp" => $_POST['default_points'],
            );
            $req_prep->execute($values);

            return true;
        }
        catch (PDOException $e) {

            return false;
        }
    }

    /**
     * @description Methode permettant de savoir si une campagne est en cours ou non, en retournant l'id de la campagne actuelle, si elle existe
     * @author Marius Ganier
     */
    public function getCurrentCampaign(){
        $date = date("Y-m-d");
        $reqI = "SELECT * FROM campaign WHERE date_start <= :dE AND date_end > :dE";
        try {
            $req_prep = Model::getPDO()->prepare($reqI);
            $values = array(
                "dE" => $date
            );
            $req_prep->execute($values);
            $tab = $req_prep->fetch();

            return $tab['id_camp'];
        }
        catch (PDOException $e) {

            return null;
        }
    }


    /**
     * @description Méthode permettant de récupérer tous les évènements de la campagne en cours
     * @author Alexandre Arniaud
     */
    public function getAllEvents(){
        $req = "SELECT * FROM event WHERE id IN (SELECT id_event FROM lineCampaign WHERE id_camp = :cC ) ORDER BY totalPoints DESC";
        try {
            $req_prep = Model::getPDO()->prepare($req);
            $values = array(
                "cC" => self::getCurrentCampaign()
            );
            $req_prep->execute($values);
            $tab = $req_prep->fetchAll();

            return $tab;

        }
        catch (PDOException $e) {

            return null;
        }
    }


    /**
     * @param $$id_camp
     */
    public function setid_camp($id_camp)
    {
        $this->$id_camp = $id_camp;
    }


    /**
     * @return mixed $id
     */
    public function getid_camp()
    {
        return $this->id_camp;
    }


    /**
     * @param $date_start
     */
    public function setdate_start($date_start)
    {
        $this->date_start = $date_start;
    }


    /**
     * @return mixed $nom
     */
    public function getdate_start()
    {
        return $this->date_start;
    }


    /**
     * @param $date_end
     */
    public function setdate_end($date_end)
    {
        $this->date_end = $date_end;
    }


    /**
     * @return mixed $orga
     */
    public function getdate_end()
    {
        return $this->date_end;
    }


    /**
     * @param $id_proj
     */
    public function setid_proj($id_proj)
    {
        $this->id_proj = $id_proj;
    }


    /**
     * @return mixed $nb_pts
     */
    public function getIdproj()
    {
        return $this->id_proj;
    }
}