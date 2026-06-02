<?php
class Connection   {

  protected $pdo = null;
  protected $stmt = null;
  public $error;
  // Functies van Sammi
  // pdo connectie  wordt hier gemaakt .
  function __construct () {
      $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
  // Functies van Sammi
  //Connectie vernietigen zodat ombefoegde mensen er niet bij kunnen
  function __destruct(){
    if($this->stmt !== null){
        $this->stmt = null;
    }
    if ($this->pdo !== null){
        $this->pdo = null;
    }
  }
 // Functies van Sammi
// hier wordt  input dat gefilterd zodat er geen ongwenste tekens in kunnen komen.

  function filter_email($data) {
   // filter_input($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        ob_start();
        header("Location: loginform.php");
        echo "<script>alert('Hallo wereld');</script>";
        exit;
        ob_end_flush();
    }
    return $data;
}




  function filter_text($data) {
   // filter_input($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

     if (!preg_match("/^[a-z0-9+&@#A-Z-' ]*$/",$data)) {
        ob_start();
        header("Location: loginfoorm.php");
        echo "not right";
        exit;
        ob_end_flush();
    }
    return $data;
}




}

define("DB_HOST", "db");
define("DB_NAME", "db_blog");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
$connection = new Connection();


?>