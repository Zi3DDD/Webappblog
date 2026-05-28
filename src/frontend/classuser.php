<?php
class User {

     // pdo connectie  wordt hier gemaakt .

  private $pdo = null;
  private $stmt = null;
  public $error;

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
    // hier maakt iemand een acount aan. 
function register($user_email,$user_password,$role_id ,$user_nickname){
$hash_password =  password_hash($user_password, PASSWORD_DEFAULT);


$stmt = $this->pdo->prepare('INSERT INTO gebruiker (user_email, user_password, role_id , user_nickname ) VALUES (?, ?, ? , ?)');
        $stmt->bindParam(1, $user_email);
        $stmt->bindParam(2, $hash_password);
        $stmt->bindParam(3, $role_id);
        $stmt->bindParam(4, $user_nickname);
        $stmt->execute();
}


// Hier word er gekeken of de gebruiker kan inloggen op basis dat de persoon de juiste informatie invoerd. 



function login ($user_email, $user_password){

$stmt = $this->pdo->prepare("SELECT gebruiker.user_id, gebruiker.user_email, gebruiker.user_password, rollen.role_name FROM gebruiker INNER JOIN rollen ON gebruiker.role_id = rollen.role_id WHERE user_email = ?");
$stmt->bindParam(1, $user_email);
 $stmt->execute();
$data = $stmt->fetch();
$valid = is_array($data);
  if($valid){

    echo $user_email. $user_password;
     if(password_verify($user_password, $data["user_password"])){
      $rol = $data["role_name"];
      $stmt = $this->pdo->prepare("SELECT * from permissies WHERE perm_mod = ?");
      $stmt->bindParam(1, $rol);
      $stmt->execute();
      $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $username = $data["user_email"];
      $permissies = array();

      foreach($data1 as $row){  
        $permissies[] = $row["perm_desc"];

      };
$_SESSION["username"] = $username;
$_SESSION["permissies"] = $permissies;

  } 
}

     }


 function requireLogin() {

    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: n.php");
        exit;
    }
}    



}
 


 // hier worden de jusite  parameters aan de blog meegegeven zodat er een connectie gemaakt kan worden met de database.



define("DB_HOST", "db");
define("DB_NAME", "db_blog");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
$_User = new User();




