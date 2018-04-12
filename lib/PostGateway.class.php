<?php

class PostGateway extends DatabaseGateway { 
   
   public function __construct($connect)    {
    parent::__construct($connect);
    
    $this->connection = $connect;
   }    
   
   protected function getSelectStatement()
   {    
    return "SELECT PostID, MainPostImage, UserID, Title, Message, PostTime FROM Posts";
   } 
   
    protected function getOrderFields()    {
    return 'LastName';
    } 

   protected function getPrimaryKeyName() {
    return "PostID"; 
   }   
   
   
  protected function joinSelectStatement(){
      return "SELECT PostID, MainPostImage, Posts.UserID, Posts.Title, Message, PostTime, Path, FirstName, LastName, ImageDetails.ImageID FROM Posts Join ImageDetails on MainPostImage = ImageID JOIN Users on Posts.UserID = Users.UserID";
  }

}

?>