<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDO;

class SubjectController 
{
    public function index(){
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');
        $stmt = $pdo->prepare("SELECT * from programme");
        $stmt->execute();
        $programmeArr;
        while($row =  $stmt->fetch()){
            $programmeArr[$row['programmeID']] = $row['name'];
        }
        return view('admin.addSubject')->with('programmes',$programmeArr);
    }
    
    public function store(Request $request){
        
        $cc = $request->input('courseCode');
        $title = $request->input('title');
        $pages = $request->input('pages');
        $price = $request->input('price');
        $image = "public/image/subjects/";            
        $image .= $request->file('image')->getClientOriginalName();  
        
        // array of programmes
        $programme = $request->input('programmeID');  

        // store images into local folder
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/image/subjects/', $filename);

        //Connect to the MySQL database using the PDO object.
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');
       
        // instantiate programme
        $subjectInstance = SubjectDetails::getInstance("null",$cc,$title,$pages,$price,$image);
        $subjectID = $subjectInstance->getSubjectID();
        $subjectCourseCode = $subjectInstance->getCourseCode();
        $subjectTitle = $subjectInstance->getTitle();
        $subjectPage = $subjectInstance->getPage();
        $subjectPrice = $subjectInstance->getPrice();
        $subjectImage = $subjectInstance->getImage();
         
        // done
        // insert subject
        $stmt1 = $pdo->prepare("INSERT INTO subject (subjectID, courseCode, title, pages, price, image) VALUES (:subjectID, :courseCode, :title, :pages, :price, :image)");
        $stmt1->bindParam('subjectID', $subjectID);
        $stmt1->bindParam('courseCode', $subjectCourseCode);
        $stmt1->bindParam('title', $subjectTitle);
        $stmt1->bindParam('pages', $subjectPage);
        $stmt1->bindParam('price', $subjectPrice);
        $stmt1->bindParam('image', $subjectImage);
        $stmt1->execute();

    // get the subject id after inserting
        $stmt2 = $pdo->prepare("SELECT subjectID FROM subject ORDER BY subjectID DESC LIMIT 1");
        $stmt2->execute();
        $actualSubjectID = $stmt2->fetchColumn();    
    
        // store into subjectprogramme database
        foreach($programme as $eachProgramme){
            $stmt3 = $pdo->prepare("INSERT INTO programmesubject (programmeID, subjectID) VALUES (:programmeID, :subjectID)");
            $stmt3->bindParam('programmeID', $eachProgramme);
            $stmt3->bindParam('subjectID', $actualSubjectID);
            $stmt3->execute();
        }        
        
        return redirect()->back()->withErrors(['message' => 'Subject has been created']);
    }

    public function retrieve(){

        //Connect to the MySQL database using the PDO object.
        $pdo = new PDO('mysql:host=localhost;dbname=taruc_printing_system', 'root', '');

        $stmt = $pdo->prepare("SELECT * FROM subject");
        $stmt->execute();
        $subjectArr = $stmt->fetchAll();
        return view('admin.subjectDashboard')->with('subjects',$subjectArr);         
        
    }

}

class SubjectDetails
{
    private $subjectID;
    private $courseCode;
    private $title;
    private $page;
    private $price;
    private $image;
    private static $instance = null;

    private function __construct($subjectID, $courseCode, $title, $page, $price, $image)
    {
        $this->subjectID = $subjectID;
        $this->courseCode = $courseCode;
        $this->title = $title;
        $this->page = $page;
        $this->price = $price;
        $this->image = $image;
    }

    // singleton
    public static function getInstance($subjectID, $courseCode, $title, $page, $price, $image)
    {
        if (self::$instance == null)
        {
            self::$instance = new SubjectDetails($subjectID, $courseCode, $title, $page, $price, $image);
        }
        return self::$instance;
    }

    public function getSubjectID()
    {
        return $this->subjectID;
    }

    public function setSubjectID($subjectID)
    {
        $this->subjectID = $subjectID;
    }

    public function getCourseCode()
    {
        return $this->courseCode;
    }

    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    
}