<?php


require('classuser.php');
$emailErr = "";
$passwordErr = "";
$role_idErr = "";
$nicknameErr = "";
$emailLoginErr = "";
$passwordLoginErr = "";
$registerMessage = "";




  if(isset($_POST["register"])) {

        if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
     $user_email = $_User->filter_email($_POST["email"]);
  }

    if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $user_password =  $_User->filter_text($_POST["password"]);
  }

      if (empty($_POST["role_id"])) {
    $role_idErr = "Role is required";
  } else {
    $role_id = $_User->filter_text($_POST["role_id"]);
  }

      if (empty($_POST["user_nickname"])) {
    $nicknameErr = "Nickname is required";
  } else {
    $user_nickname =  $_User->filter_text($_POST["user_nickname"]);
  }

   
//echo $user_email. $user_password .$role_id .$user_nickname;

$_User->register($user_email,$user_password,$role_id ,$user_nickname) ? "OK" : $_User->error;

if($_User->register($user_email,$user_password,$role_id,$user_nickname)) {
    $registerMessage = "Registratie gelukt!";
} else {
    $registerMessage = $_User->error;
}


}


  if(isset($_POST["login"])) {

    if (empty($_POST["email"])) {
    $emailLoginErr = "Email is required";
  } else {
     $user_email = $_User->filter_email($_POST["email"]);
  }

    if (empty($_POST["password"])) {
    $passwordLoginErr = "Password is required";
  } else {
    $user_password =  $_User->filter_text($_POST["password"]);
  }





$_User->login($user_email,$user_password) ? "OK" : $_User->error;

}


  ?>


<html>
    <head>
        <link rel="stylesheet" href="styles/form.css">
    </head>



<body>


<form  class="form"  method="post">
    <h1> Register </h1>
     <span class="error">  <?php echo $emailErr;?></span>
 <input placeholder="email"  class="input" type="text" name="email"><br>
  <span class="error">  <?php echo $passwordErr;?></span>
 <input placeholder="password"  class="input" type="password" name="password"><br>
  <span class="error">  <?php echo $nicknameErr;?></span>
   <input placeholder="Nickname"  class="input" type="text" name="user_nickname"><br>
      <br>
       <span class="error">  <?php echo $role_idErr;?></span>
     <label for="categorie">Kies een rol</label>
        <br>
        <select class="categorie" name="role_id" value="role_id">
        <option value="1">bezoeker</option>
        <option value="2">redacteur</option>
        <option value="3">beheerder</option>
        </select>
        
<input type="submit"  name="register" value="register">

<span class="error">
    <?php echo $registerMessage; ?>
</span>
</form>


<form  class="form"  method="post">
        <h1>Login
            </h1>

 <input placeholder="email"  class="input" type="text" name="email"><br>
 <span class="error">  <?php echo $emailLoginErr;?></span>

 <input placeholder="password"  class="input" type="password" name="password"><br>
 <span class="error"> <?php echo $passwordLoginErr;?></span>
<input type="submit" name="login" value="login" >
</form>

</body>


