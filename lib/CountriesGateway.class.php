<?php 

class CountriesGateway extends DatabaseGateway { 
   
   public function __construct($connect)    {
    parent::__construct($connect);
   }    
   
   protected function getSelectStatement()
   {    
    return "select CountryName, Area, Capital, Population, CurrencyName, CountryDescription from Countries ";
   } 
   
    protected function getOrderFields()    {
    return 'LastName';
    } 

   protected function getPrimaryKeyName() {
    return "ISO"; 
   }   
   
     protected function joinSelectStatement(){
      return "select ISO, CountryName from Countries join ImageDetails on ISO = CountryCodeISO group by CountryName";
  }

}

?>