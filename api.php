<?php
  // Open https://localhost/~ubuntu/index.php
  //print_r($_POST);
  $verb = $_SERVER["REQUEST_METHOD"];
  
  function handle_sql_errors($query, $error_message)
{
    echo '<pre>';
    echo $query;
    echo '</pre>';
    echo $error_message;
    die;
}
  
  $dbhandle = new PDO("sqlite:db/chat.db") or die("Failed to open DB");
  if (!$dbhandle) die ($error);
  $dbhandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  if ($verb == "GET"){
      $query = "SELECT * FROM msgs";
      $statement = $dbhandle->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      header('HTTP/1.1 200 OK');
      header('Content-Type: application/json');
      echo json_encode($results);
  } else if ($verb == "POST"){
      $author = "anonymous";
      $content = "secret message";
      if (isset($_POST["author"])){
          $author = $_POST["author"];
      }
      if (isset($_POST["content"])){
          $content = $_POST["content"];
      }
      $query = "INSERT into msgs ('author', 'content') VALUES (\"".$author."\",\"".$content."\")";
    try{
      $statement = $dbhandle->query($query);
      $statement->fetch(PDO::FETCH_ASSOC);
     } catch(PDOException $e)
    {
        handle_sql_errors($statement, $e->getMessage());
    }
      header('HTTP/1.1 200 OK');
      header('Content-Type: application/json');
      echo json_encode("hmm");
  }
?>