<?php
require_once('classconnection.php');
class User extends Connection {

     // pdo connectie  wordt hier gemaakt .

    
  

  //Connectie vernietigen zodat ombefoegde mensen er niet bij kunnen

  
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

$stmt = $this->pdo->prepare("SELECT gebruiker.role_id, gebruiker.user_email, gebruiker.user_password, rollen.role_name FROM gebruiker INNER JOIN rollen ON gebruiker.role_id = rollen.role_id WHERE user_email = ?");
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
      $gebruikerrol= $data["role_id"];
      $permissies = array();

      foreach($data1 as $row){  
        $permissies[] = $row["perm_desc"];

      };
$_SESSION["username"] = $username;
$_SESSION["permissies"] = $permissies;
$_SESSION["role_id"] = $gebruikerrol;


echo "Ingelogd als: " . $_SESSION["username"] . " met rol: " . $_SESSION["role_id"] ;

  } 
}

     }


 function requireLogin($rol) {

    session_start();

    if (!isset($_SESSION["$rol"])) {
        header("Location: loginform.php");
        exit;
    }
}    



}
 


 // hier worden de jusite  parameters aan de blog meegegeven zodat er een connectie gemaakt kan worden met de database.



$_User = new User();




