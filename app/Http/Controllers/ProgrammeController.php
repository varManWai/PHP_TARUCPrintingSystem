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

        $name = $request->input('name');
        $facultyID = $request->input('facultyID');
        // instantiate programme
        $programmeInstance = Programme::getInstance("null",$name,$facultyID);

        $programmeID = $programmeInstance->getProgrammeID();
        $programmeName = $programmeInstance->getName();
        $faculty = $programmeInstance->getFaculty();
        
        //Connect to the MySQL database using the PDO object.
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        $stmt = $pdo->prepare("INSERT INTO programme (programmeID, name, facultyID) VALUES (:programmeID, :name, :facultyID)");
        $stmt->bindParam('programmeID',  $programmeID);
        $stmt->bindParam('name', $programmeName);
        $stmt->bindParam('facultyID',  $faculty);
        
        if($stmt->execute()){
            return $this->retrieve();
        }else {
            return redirect()->back()->withErrors(['message' => 'Try again']);
        }
    }

    public function retrieve(){

        //Connect to the MySQL database using the PDO object.
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        $stmt = $pdo->prepare("SELECT  programme.programmeID, programme.name AS programme_name, faculty.name AS faculty_name from programme , faculty where programme.facultyID=faculty.facultyID");
        $stmt->execute();
        $programmeArr = $stmt->fetchAll();
        return view('admin.programmeDashboard')->with('programmes',$programmeArr);        
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

    // singleton
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