<?php
session_start();
require('classblog.php');
require_once('classuser.php');
$_User->requireLogin(2,2);
include('header.php');

// afhankelijk welke rol je hebt kun je een blog aanmaken.
// hier form informatie gevalideerd. en wordt de data naar de juiste plekken toegestuurd fotos gaan naar de upload map en allen andere waarden gaat de database in . 

  if(isset($_POST["safe"])){    

    
    $filename = $_FILES['foto']['name'];
    $file_path = '/uploads/' . $filename;
    $title =  $_User->filter_text($_POST["title"]);
    $text = $_User->filter_text($_POST["text"]);
    $category = $_User->filter_text($_POST["categorie"]);
 move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . $file_path);

$_Blog->createBlog($title,$text,$filename,$file_path,$category) ? "OK" : $_Blog->error; }


?>

<html>


<head>
<link rel="stylesheet" href="styles/createblog.css">
</head>
    
<body>




 <form  enctype="multipart/form-data" method="post">
     <br>
     <input placeholder="Title"  class="input" type="text" name="title">
      <br>
     <input type="file"  name="foto" />
     <br>
     
        <select id="categorie" name="categorie" value="categorie">
        <option value="Bergen">Bergen</option>
        <option value="Zee">Zee</option>
        <option value="Stad">Stad</option>
        <option value="Bossen">Bossen</option>
        </select>
        <label for="categorie">Kies een caterogie</label>
    <br>
     <textarea  name="text" rows="10" cols="50">Begin you story here</textarea>
    <br>
     <button type="submit" name="safe">Blog aanmaken</button>
</form>
</body>





<html>
