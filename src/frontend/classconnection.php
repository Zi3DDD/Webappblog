<?php
class Connection   {

  protected $pdo = null;
  protected $stmt = null;
  public $error;
 
  // pdo connectie  wordt hier gemaakt .
  function __construct () {
      $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
 
  //Connectie vernietigen zodat ombefoegde mensen er niet bij kunnen
  function __destruct(){
    if($this->stmt !== null){
        $this->stmt = null;
    }
    if ($this->pdo !== null){
        $this->pdo = null;
    }
  }

// hier wordt  input dat gefilterd zodat er geen ongwenste tekens in kunnen komen.

  function filter_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}
}

define("DB_HOST", "db");
define("DB_NAME", "db_blog");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
$connection = new Connection();


?>