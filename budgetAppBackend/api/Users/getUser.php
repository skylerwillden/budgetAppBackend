<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';
    
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
     $user = new Users($db);


  $result = $user->getUser($_GET['userID']);
 
  $num = $result->rowCount();

  if($num > 0) {

      $row = $result->fetch(PDO::FETCH_ASSOC); 
      extract($row);

      $singleUser = array(
        'userID' => $userID,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'password' => $password,
        'email' => $email 
      );

    echo json_encode($singleUser);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }

