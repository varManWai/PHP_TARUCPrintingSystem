<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDO;

class FacultyController extends Controller
{
    public function index(){
        return view('admin.addFaculty')->with('results', 'Welcome to this page' );
    }
    
    public function store(Request $request){

        // instantiate faculty
        $name = $request->input('name');
        $facultyInstance = Faculty::getInstance("null",$name);

        $facultyID = $facultyInstance->getFacultyID();
        $facultyName = $facultyInstance->getName();

        //Connect to the MySQL database using the PDO object.
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        // //Serialize the object into a string value that we can store in our database.
        // $serializedObject = serialize($facultyInstance);

        //Prepare our INSERT SQL statement.
        $stmt = $pdo->prepare("INSERT INTO faculty (facultyID, name) VALUES (:facultyID, :name)");
        $stmt->bindParam('facultyID',  $facultyID);
        $stmt->bindParam('name', $facultyName);

        //Execute the statement and insert our serializsed object string.
        if($stmt->execute()){
            return view('admin.addFaculty')->with('results', 'Faculty has been added' );
        }else {
            return view('admin.addFaculty')->with('results', 'Try again' );
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