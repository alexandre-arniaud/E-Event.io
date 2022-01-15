<?php

require_once(dirname(__FILE__) . '/Model.php');

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


    public function addCampaign() {
        $reqI = "INSERT INTO `campaign` (`camp_name`,`date_start`, `date_end`,`default_points` ) VALUES (:cn, :ds, :de, :dp)";
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
//une campagne est deja en cours -> renvoie vraie
    public function getCurrentCampaign(){
        $date = date("Y-m-d");
        $rep = Model::getPDO()->query("SELECT * FROM campaign WHERE date_end > $date ");
        try{
            $tab = $rep->fetch();
            return $tab['id_camp'];
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