<?php

session_start();

require('classuser.php');
  if(isset($_POST["register"])) {

    $user_email =  $_POST["email"];
    $user_password =  $_POST["password"];
    $user_nickname = $_POST["user_nickname"];
    $role_id = $_POST["role_id"];
   
//echo $user_email. $user_password .$role_id .$user_nickname;

$_User->register($user_email,$user_password,$role_id ,$user_nickname) ? "OK" : $_User->error;

}



  if(isset($_POST["login"])) {

    $user_email =  $_POST["email"];
    $user_password =  $_POST["password"];
    $user_nickname = $_POST["user_nickname"];
    $role_id = $_POST["role_id"];
   

$_User->login($user_email,$user_password) ? "OK" : $_User->error;

}


  ?>


<html>
    <head>
        <link rel="stylesheet" href="styles/form.css">
    </head>



<body>
<nav>
    <img src="images/logo.png" alt="logo vacantie blog">

   
        <ul>
        <li><a href="default.asp">Home</a></li>
        <li><a href="news.asp">News</a></li>
        <li><a href="contact.asp">Contact</a></li>
        <li><a href="about.asp">About</a></li>
        </ul>

</nav>

<form  class="form"  method="post">
    <h1> Register </h1>
 <input placeholder="email"  class="input" type="text" name="email"><br>
 <input placeholder="password"  class="input" type="password" name="password"><br>
 <input placeholder="Nickname"  class="input" type="text" name="user_nickname"><br>
      <br>
     <label for="categorie">Kies een rol</label>
        <br>
        <select class="categorie" name="role_id" value="role_id">
        <option value="1">bezoeker</option>
        <option value="2">redacteur</option>
        <option value="3">beheerder</option>
        </select>
        
<input type="submit"  name="register" value="register">
</form>


<form  class="form"  method="post">
        <h1>Login
            </h1>
 <input placeholder="email"  class="input" type="text" name="email"><br>
 <input placeholder="password"  class="input" type="password" name="password"><br>
<input type="submit" name="login" value="login" >
</form>

</body>


