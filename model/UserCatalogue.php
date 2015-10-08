<?php

class UserCatalogue {
    
    private $users = array();
    private $DAL;
    
    public function __construct() {
        
        $DAL = new UsersDAL();
        $users = $DAL->getUsers();
        
        if($users !== null) {
            $this->users = $users;
        }
        else {
            $this->users = array();
        }
        
        $this->DAL = $DAL;
    }
    
    public function getUsers() {
        return $this->users;
    }
    
    public function addUser($userName, $userPassword) {
        
        $exist = false;
        
        foreach($this->users as $user) {
            if($userName == $user->getName()) {
                $exist = true;
            }
        }
        
        if($exist) {
            return false;
        }
        else {
            $newUser = new UserModel($userName, $userPassword);
            $this->users[] = $newUser;
            $this->DAL->saveUsers($this->users);
            //Kanske fixa med try ctach etc steg för steg här och bakåt??
            return true;
        }
    }
}