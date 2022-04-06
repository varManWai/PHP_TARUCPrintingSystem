<?php

class SubjectDetails
{
    private $subjectID;
    private $courseCode;
    private $title;
    private $page;
    private $price;
    private $image;

    private function __construct($subjectID, $courseCode, $title, $page, $price, $image)
    {
        $this->subjectID = $subjectID;
        $this->courseCode = $courseCode;
        $this->title = $title;
        $this->page = $page;
        $this->price = $price;
        $this->image = $image;
    }

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