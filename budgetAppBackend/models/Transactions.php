<?php 
  class Transactions{
    private $conn;

    public $transID;
    public $accountID;
    public $transDescription;
    public $categoryID;
    public $actualAmount;
    public $actualTransDate;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    
     public function getIncomeTransactions($userID) {

      $query = 'SELECT * FROM Transaction t JOIN BankAccount b ON t.accountID=b.accountID WHERE userID= :userID AND categoryID= 1';
      $stmt = $this->conn->prepare($query);
      $stmt->bindparam(':userID', $userID);

      $stmt->execute();
      return $stmt;
    }   
    
        public function getExpenditureTransactions($userID) {

      $query = 'SELECT * FROM Transaction t JOIN BankAccount b ON t.accountID=b.accountID WHERE userID= :userID AND categoryID= 2';
      $stmt = $this->conn->prepare($query);
      $stmt->bindparam(':userID', $userID);

      $stmt->execute();
      return $stmt;
    }  
    
    }
  