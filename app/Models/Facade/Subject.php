<?php

class Subject{
    
    public function getSubjectsAvailable($studentID){
        $programmeID = DB::table('students')
        ->select('programmeID')
        ->where('studentID', '=', $studentID)
        ->get();

        $subjectsID = DB::table('programmesubject')
        ->select('subjectID')
        ->where('programmeID','=',$programmeID)
        ->get();

        return $subjectsID;
    }
}