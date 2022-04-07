<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDO;

class FacultyController 
{
    public function index(){
        return view('admin.addFaculty');
    }
    
    public function store(Request $request){

        $name = $request->input('name');
        // instantiate faculty
        $facultyInstance = Faculty::getInstance("null",$name);

        $facultyID = $facultyInstance->getFacultyID();
        $facultyName = $facultyInstance->getName();

        //Connect to the MySQL database using the PDO object.
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        $stmt = $pdo->prepare("INSERT INTO faculty (facultyID, name) VALUES (:facultyID, :name)");
        $stmt->bindParam('facultyID',  $facultyID);
        $stmt->bindParam('name', $facultyName);
        
        if($stmt->execute()){            
            return redirect()->back()->withErrors(['message' => 'Faculty has been added']);
        }else {
            return redirect()->back()->withErrors(['message' => 'Try again']);
        }                
    }
}

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

    // singleton
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