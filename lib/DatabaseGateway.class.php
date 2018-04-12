<?php 


abstract class DatabaseGateway {
    
    // contains connection
    protected $connection;

    // Constructor is passed a database adapter (example of dependency injection)
    public function __construct($connect)  {
          if (is_null($connect) )
             throw new Exception("Connection is null");
             
          $this->connection = $connect;
       }

    // ABSTRACT METHODS
   
    abstract protected function getSelectStatement();
    
    abstract protected function getPrimaryKeyName();
    
    // select statement for joins 
    abstract protected function joinSelectStatement();
    
    // PUBLIC FINDERS 
   
    public function findAll($sortFields=null)
   { 
   $sql = $this->getSelectStatement();
   // add sort order if required
   if (! is_null($sortFields)) {
      $sql .= ' ORDER BY ' . $sortFields;
   }      
   $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
   return $statement->fetchAll(); 
   }   
   
   /*
      Returns all the records in the table sorted by the specified sort order
   */
   public function findAllSorted($ascending)
   { 
   $sql = $this->getSelectStatement() . ' ORDER BY ' . $this->getOrderFields();
   if (! $ascending) { 
      $sql .= " DESC";  
   }         
   $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
   return $statement->fetchAll(); 
   }  
   
   /*
      Returns a record for the specificed ID
   */
   public function findById($id)
   { 
   $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
   $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
   return $statement->fetch();
   }   
   
   // function to get just the id sets back
   public function findById2($id, $key)
   { 
   $sql = $this->getSelectStatement() . ' WHERE ' . $key . '=' . '"' . $id . '"';
   $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
   return $statement->fetchAll();
   }   
  
  
    //join with group by select statement 
    public function joinGroupBy() { 
    $sql = $this->joinSelectStatement();
    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    //return $sql;
    return $statement->fetchAll(); 
    } 
    
    
    // find by id with custom join sqls 
    public function findByIdJoin($id)
   { 
   $sql = $this->joinSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=' . '"' . $id . '"';
   $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
   return $statement->fetch();
   //return $sql;
   
   }  
   
    public function findByIdJoinSetKeySingle($id, $key)
   { 
   $sql = $this->joinSelectStatement() . ' WHERE ' . $key . '=' . '"' . $id . '"';
   $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
   return $statement->fetch();
   //return $sql;
   
   }  
   
    // find by id with custom join sqls 
    public function findByIdJoin2($id)
   { 
   $sql = $this->joinSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=' . '"' . $id . '"';
   $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
   return $statement->fetchAll();
   //return $sql;
   }
   
   
   
   //login functions
    public function getUserName2($id,$key){
    $sql = $this->getSelectStatement() . ' WHERE ' . $key . '=' . '"' . $id . '"';
    $statement = DatabaseHelper::runQuery($this->connection, $sql,null);
    return $statement->fetch();   
    }
    
    public function getPassword($username){    
    return "SELECT Password FROM UsersLogin WHERE UserName = $username ";
    }
    
    public function getSalt($username){    
    return "SELECT Salt FROM UsersLogin WHERE UserName = $username ";
    }
    
    public function compair(){    
    return false;
    }
   
   
}

?>