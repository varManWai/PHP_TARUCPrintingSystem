<?php

class Programme 
{
    private $programmeID;
    private $name;
    private $faculty;

    private function __construct($programmeID, $name, $faculty)
    {
        $this->programmeID = $programmeID;
        $this->name = $name;
        $this->faculty = $faculty;
    }

    public static function getInstance($programmeID, $name, $faculty)
    {
        if (self::$instance == null)
        {
            self::$instance = new Programme($programmeID, $name, $faculty);
        }
        return self::$instance;
    }

    public function getProgrammeID()
    {
        return $this->programmeID;
    }

    public function setProgrammeID($programmeID)
    {
        $this->programmeID = $programmeID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFaculty()
    {
        return $this->faculty;
    }

    public function setFaculty($faculty)
    {
        $this->name = $faculty;
    }



}