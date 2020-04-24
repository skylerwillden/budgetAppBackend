<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/BankAccount.php';


  $database = new Database();
  $db = $database->connect();

  $bankAccount = new BankAccount($db);

  $result = $bankAccount->getBalance($_GET['userID']);
 
  $num = $result->rowCount();

  if($num > 0) {

      $row = $result->fetch(PDO::FETCH_ASSOC);
      extract($row);

      $accountBalance = array(
        'accountID' => $accountID,
        'userID' => $userID,
        'balance' => $balance
      );

    echo json_encode($accountBalance);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }


