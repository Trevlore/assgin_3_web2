<?php

class CitiesGateway extends DatabaseGateway { 
   
   public function __construct($connect)    {
    parent::__construct($connect);
   }    
   
   protected function getSelectStatement()
   {    
    return "SELECT CityCode, AsciiName, CountryCodeISO, Population, TimeZone, Elevation, Latitude, Longitude FROM Cities ";
   } 
   
    protected function getOrderFields()    {
    return 'LastName';
    } 

   protected function getPrimaryKeyName() {
    return "CityCode"; 
   }   
   
   
  protected function joinSelectStatement(){
      return "select Cities.CityCode, AsciiName from Cities join ImageDetails on Cities.CityCode = ImageDetails.CityCode group by AsciiName";
  }

}

?>