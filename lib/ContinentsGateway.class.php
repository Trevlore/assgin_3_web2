<?php 

class ContinentsGateway extends DatabaseGateway { 
   
   public function __construct($connect)    {
    parent::__construct($connect);
   }    
   
   protected function getSelectStatement()
   {    
    return "select ContinentName, ContinentCode, GeoNameId from Continents";
   } 
   
    protected function getOrderFields()    {
    return 'LastName';
    } 

   protected function getPrimaryKeyName() {
    return "ContinentCode"; 
   }   
   
     protected function joinSelectStatement(){
      return "select Continents.ContinentCode, ContinentName from Continents join ImageDetails on Continents.ContinentCode = ImageDetails.ContinentCode group by ContinentName";
  }

}

?>