<?php

class Faculty 
{
    private $facultyID;
    private $name;
    private static $instance = null;

    private function __construct($facultyID, $name)
    {
        $this->facultyID = $facultyID;
        $this->name = $name;
    }

    public static function getInstance($facultyID, $name)
    {
        if (self::$instance == null)
        {
            self::$instance = new Faculty($facultyID, $name);
        }
        return self::$instance;
    }

    public function getFacultyID()
    {
        return $this->facultyID;
    }

    public function setFacultyID($facultyID)
    {
        $this->facultyID = $facultyID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }



}