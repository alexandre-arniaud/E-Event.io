<?php

require_once dirname(__FILE__) . '/Model.php';

final class Campaign
{
    private $nom_camp;
    private $date_start;
    private $date_end;
    private $nb_pts;


    public function __construct($nom_camp, $date_start, $date_end, $nb_pts)
    {
        if (!is_null($nom_camp)) { $this->nom_camp = $nom_camp ; }
        if (!is_null($date_start)) { $this->date_start = $date_start; }
        if (!is_null($date_end)) { $this->date_end = $date_end; }
        if (!is_null($nb_pts)) { $this->nb_pts = $nb_pts; }

    }

    /**
     * @description Methode permettant à l'administrateur de créer une nouvelle campagne
     * Tous les utilisateurs ayant le rôle organisateur a la précédente campagne redeviennent donateur ( mais peuvent reproposer une idée d'évènement )
     * Tous les utilisateurs se voient attribuer le nombre de points par défault de la campagne
     * @author Marius Ganier
     */
    public function addCampaign() {
        $reqI = "INSERT INTO `campaign` (camp_name, date_start, date_end, default_points ) VALUES (:cn, :ds, :de, :dp);
                 UPDATE members SET role = 'donateur', points = :dp WHERE role NOT IN ('admin');";
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

            return $tab;
            var_dump($tab);
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
                "cC" => self::getCurrentCampaign()['id_camp']
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
     * @description Méthode permettant de récupérer tous les évènements de la campagne en cours superieur à N points
     * @author Marius Garnier & Anthony Ruiz
     */
    public function getMinPointsEvents(){
        $req = "SELECT * FROM event WHERE id IN (SELECT id_event FROM lineCampaign WHERE id_camp = :cC ) AND totalPoints >= '20' AND selected = '0' ORDER BY totalPoints DESC";
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
     * @param $nom_camp
     */
    public function setNameCamp($nom_camp)
    {
        $this->nom_camp = $nom_camp;
    }


    /**
     * @return mixed $nom_camp
     */
    public function getNameCamp()
    {
        return $this->nom_camp;
    }


    /**
     * @param $date_start
     */
    public function setStart($date_start)
    {
        $this->date_start = $date_start;
    }


    /**
     * @return mixed $nom
     */
    public function getStart()
    {
        return $this->date_start;
    }


    /**
     * @param $date_end
     */
    public function setEnd($date_end)
    {
        $this->date_end = $date_end;
    }


    /**
     * @return mixed $orga
     */
    public function getEnd()
    {
        return $this->date_end;
    }


    /**
     * @param $nb_pts
     */
    public function setPoints($nb_pts)
    {
        $this->nb_pts = $nb_pts;
    }


    /**
     * @return mixed $nb_pts
     */
    public function getPoints()
    {
        return $this->nb_pts;
    }
}