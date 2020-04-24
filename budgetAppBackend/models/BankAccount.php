<?php 
  class BankAccount{
    private $conn;

    public $accountID;
    public $userID;
    public $balance;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    public function getBalance($userID) {

      $query = 'SELECT * FROM BankAccount WHERE userID= :userID';
      $stmt = $this->conn->prepare($query);
      $stmt->bindparam(':userID', $userID);

      $stmt->execute();
      return $stmt;
    }   
    
     public function getIncomeTransactions($userID) {

      $query = 'SELECT * FROM Transaction t JOIN BankAccount b ON t.accountID=b.accountID WHERE userID= :userID AND categoryID= 1';
      $stmt = $this->conn->prepare($query);
      $stmt->bindparam(':userID', $userID);

      $stmt->execute();
      return $stmt;
    }   
    }
  