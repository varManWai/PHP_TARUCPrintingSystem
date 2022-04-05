<?php

class Subject{
    
    public function getSubjectsAvailable(){
        
        $subjects = DB::select('select * from subjects');
        return $subjects;
    }
}