<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
//   include_once '../../models/Post.php';
  include_once '../../models/Users.php';
    
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
//   $post = new Post($db);
     $users = new Users($db);


  $result = $users->getUsers();
 
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $usersArray = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $singleUser = array(
        'userID' => $userID,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'password' => $password,
        'email' => $email 
      );

      // Push to "data"
      array_push($usersArray, $singleUser);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($usersArray);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
