<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDO;

class ProgrammeController 
{
    public function index(){
        return view('admin.addProgramme');
    }
    
    public function store(Request $request){

        // // instantiate faculty
        // $name = $request->input('name');
        // $facultyInstance = Faculty::getInstance("null",$name);

        // $facultyID = $facultyInstance->getFacultyID();
        // $facultyName = $facultyInstance->getName();

        // //Connect to the MySQL database using the PDO object.
        // $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        // // //Serialize the object into a string value that we can store in our database.
        // // $serializedObject = serialize($facultyInstance);

        // //Prepare our INSERT SQL statement.
        // $stmt = $pdo->prepare("INSERT INTO faculty (facultyID, name) VALUES (:facultyID, :name)");
        // $stmt->bindParam('facultyID',  $facultyID);
        // $stmt->bindParam('name', $facultyName);

        // //Execute the statement and insert our serializsed object string.
        // if($stmt->execute()){
        //     return view('admin.addFaculty')->with('results', 'Faculty has been added' );
        // }else {
        //     return view('admin.addFaculty')->with('results', 'Try again' );
        // }
        
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