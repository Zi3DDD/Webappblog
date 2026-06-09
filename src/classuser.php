<?php
require_once('classconnection.php');
class User extends Connection {


// Functies van Sammi
// hier wordt  input dat gefilterd zodat er geen ongwenste tekens in kunnen komen.


    // hier maakt iemand een acount aan. 
 public function register($user_email,$user_password,$role_id ,$user_nickname){
$hash_password =  password_hash($user_password, PASSWORD_DEFAULT);

    // Check of email al bestaat
    $stmt = $this->pdo->prepare('SELECT user_email FROM gebruiker WHERE user_email = ?');
    $stmt->bindParam(1, $user_email);
    $stmt->execute();

    if ($stmt->fetch()) {
        return "Email bestaat al";
    }else{

$stmt1 = $this->pdo->prepare('INSERT INTO gebruiker (user_email, user_password, role_id , user_nickname ) VALUES (?, ?, ? , ?)');
        $stmt1->bindParam(1, $user_email);
        $stmt1->bindParam(2, $hash_password);
        $stmt1->bindParam(3, $role_id);
        $stmt1->bindParam(4, $user_nickname);
        $stmt1->execute();
            return "Registratie gelukt";

    }
}

// Functies van Sammi
// Hier word er gekeken of de gebruiker kan inloggen op basis dat de persoon de juiste informatie invoerd. 
public function login($user_email, $user_password)
{
    $stmt = $this->pdo->prepare("
        SELECT
            gebruiker.role_id,
            gebruiker.user_email,
            gebruiker.user_password,
            rollen.role_name
        FROM gebruiker
        INNER JOIN rollen
        ON gebruiker.role_id = rollen.role_id
        WHERE user_email = ?
    ");

    $stmt->bindParam(1, $user_email);
    $stmt->execute();

    $data = $stmt->fetch();

    $valid = is_array($data);

    if ($valid) {

        if (password_verify($user_password, $data["user_password"])) {

            // sessie starten
            session_start();
            session_regenerate_id(true);

            $rol = $data["role_name"];

            $stmt = $this->pdo->prepare(
                "SELECT * FROM permissies WHERE perm_mod = ?"
            );

            $stmt->bindParam(1, $rol);
            $stmt->execute();

            $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $username = $data["user_email"];
            $gebruikerrol = $data["role_id"];

            $permissies = [];

            foreach ($data1 as $row) {
                $permissies[] = $row["perm_desc"];
            }

            $_SESSION["username"] = $username;
            $_SESSION["permissies"] = $permissies;
            $_SESSION["role_id"] = $gebruikerrol;

            include("header.php");

            return "Login gelukt";

        } else {

            return "Ongeldige inloggegevens";

        }

    } else {

        return "Gebruiker niet gevonden";

    }

}

// Functies van Sammi
 //Deze funtie zorgt er voor dat je alleen toegang hebt op de pagina als je de juiste rol hebt
 public function requireLogin($rol1,$rol2) {

    if (
        isset($_SESSION['role_id']) &&
        (
            $_SESSION['role_id'] == $rol1 ||
            $_SESSION['role_id'] == $rol2
        )
    ) {
        return; // toegang toegestaan
    } else {
        header("Location: loginform.php");
        exit;
    }
}    
// Hier worden de sessie gegevens vernietigd. 
public function logout() {
    session_start();
    session_destroy();
    header("Location: loginform.php");
    exit;
}

}
 





$_User = new User();




