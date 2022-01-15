<?php

require_once(dirname(__FILE__) . '/Model.php');

final class Campaign
{
    private $id_camp;
    private $id_event;

    public function __construct($id_camp, $id_event)
    {
        if (!is_null($id_camp)) {
            $this->id_camp = $id_camp;
        }
        if (!is_null($id_event)) {
            $this->id_event = $id_event;
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
     * @param $$id_camp
     */
    public function setid_event($id_event)
    {
        $this->$id_event = $id_event;
    }


    /**
     * @return mixed $id
     */
    public function getid_event()
    {
        return $this->id_event;
    }
}

