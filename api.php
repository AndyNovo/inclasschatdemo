<?php
  // Open https://localhost/~ubuntu/index.php
  //print_r($_POST);
  $verb = $_SERVER["REQUEST_METHOD"];
  
  if ($verb == "GET"){
      echo "GET HERE";
  } else if ($verb == "POST"){
      $author = "anonymous";
      $content = "secret message";
      if (isset($_POST["author"])){
          $author = $_POST["author"];
      }
      if (isset($_POST["content"])){
          $content = $_POST["content"];
      }
      echo "$author: $content";
  } else {
      echo "USAGE GET or POST";
  }
?>