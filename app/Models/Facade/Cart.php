<?php

class Cart{
    
    public function createUserCart($userID){
        $cartID = DB::table('cart')
        ->insertGetId([
            'studentID' => $userID
        ]);

        return $cartID;
    }

    public function addSubjectCart($cartID,$subjectID){
        
        

    }

    public function viewCart(){

    }

    public function deleteCart(){

    }
}