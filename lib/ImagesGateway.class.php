<?php 

class ImagesGateway extends DatabaseGateway { 
   
    protected $connection;
   
   public function __construct($connect)    {
    parent::__construct($connect);
    
    $this->connection = $connect;
   }    
   
   protected function getSelectStatement()
   {    
    return "SELECT Path, ImageID, Description, Title, Latitude, Longitude, CountryCodeISO FROM ImageDetails";
   } 
   
    protected function getOrderFields()    {
    return 'LastName';
    } 

   protected function getPrimaryKeyName() {
    
    return "ImageID"; 
   }   
   
     protected function joinSelectStatement(){
      return "select Description, Path, FirstName, LastName, CountryName, ISO, Users.UserID, Title, AsciiName, Cities.CityCode from ImageDetails join Users on Users.UserID = ImageDetails.UserID join Countries on ISO = CountryCodeISO join Cities on Cities.CityCode = ImageDetails.CityCode";
  }

 function filter2(){
  
    //default all images  
    $sql = "Select Path, ImageID, Description, Title, CityCode, CountryCodeISO, ContinentCode from ImageDetails";
    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    return $statement->fetchAll(); 
   }
   
   function filterSearchBar($searchValue){
  
    //search title and discription.  
    $sql = "Select Path, ImageID, Description, Title, CityCode, CountryCodeISO, ContinentCode from ImageDetails WHERE Title LIKE '%$searchValue%'  OR Description LIKE '%$searchValue%';";
    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    return $statement->fetchAll(); 
   }
   
    function imageRating($imageID){
        //return average rating.
        $sql = "SELECT AVG(Rating) FROM ImageRating WHERE $imageID = ImageID ;";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        $star = $statement->fetch(); 
        $print;
        for($count = 0; $count < 5; $count++) {
            if($count >= (int)$star[0] ){ 
               $print = $print."<span class='glyphicon glyphicon-star-empty rating'></span>";}
            else {
                 $print =  $print."<span class='glyphicon glyphicon-star rating'></span>";                }
        }
        return $print;
    }
 
 
}

?>