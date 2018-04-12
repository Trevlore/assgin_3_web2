<?php

class UsersLoginGateway extends DatabaseGateway { 
   
   public function __construct($connect)    {
    parent::__construct($connect);
   }    
   
   public function getSelectStatement(){    
   return "SELECT UserName,Password,Salt,UserID FROM UsersLogin";
   } 
   
   public function getOrderFields(){
   return 'UserName';
   } 

   public function getPrimaryKeyName() {
    return "UserName"; 
   }
   
   public function joinSelectStatement(){
      return null;
   }
}

?>