<?php 
  class Users {
    private $conn;

    public $userID;
    public $firstName;
    public $lastName;
    public $password;
    public $email;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    public function getUsers() {

      $query = 'SELECT * FROM User';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

//     Get Single User
    public function getUser($id) {
         $query = 'SELECT * FROM User WHERE userID=' . $id;
         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         return $stmt;
    }
    
    public function createUser(){
      
       $query = 'INSERT INTO User (userID, firstName, lastName, password, email) VALUES (:userID, :firstName, :lastName, :password, :email)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        if ($stmt->execute()){
          return true;
        }

        
    }
  }