<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDO;

class ProgrammeController 
{
    public function index(){
        
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        $stmt = $pdo->prepare("SELECT * from faculty");
        $stmt->execute();
        $facultyArr;
        while($row =  $stmt->fetch()){
            $facultyArr[$row['facultyID']] = $row['name'];
        }

        return view('admin.addProgramme')->with('faculties',$facultyArr);
    }
    
    public function store(Request $request){

        return view('admin.addProgramme');
    }
}

class Programme 
{
    private $programmeID;
    private $name;
    private $faculty;
    private static $instance = null;

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