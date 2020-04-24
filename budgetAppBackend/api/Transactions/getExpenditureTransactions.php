<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Transactions.php';


  $database = new Database();
  $db = $database->connect();

  $transactions = new Transactions($db);

  $result = $transactions->getExpenditureTransactions($_GET['userID']);
 
  $num = $result->rowCount();

  if($num > 0) {

      $incomeArray = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
         extract($row);

      $transaction = array(
        'transID' => $transID,
        'accountID' => $accountID,
        'transDescription'  => $transDescription,
        'categoryID' => $categoryID,
        'actualAmount'  => $actualAmount,
        'actualTransDate' => $actualTransDate
      );
        array_push($incomeArray, $transaction);
      }
     

    echo json_encode($incomeArray);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }




