<?php

class UserGateway extends DatabaseGateway { 
   
   public function __construct($connect)    {
    parent::__construct($connect);
   }    
   
   protected function getSelectStatement()
   {    
    return "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email FROM Users ";
   } 
   
    protected function getOrderFields()    {
    return 'LastName';
    } 

   protected function getPrimaryKeyName() {
    return "UserID"; 
   }   
   
   public function printbob()
   {    
    return "bob ";
   } 
   
  protected function joinSelectStatement(){
      return null;
  }

}

?>