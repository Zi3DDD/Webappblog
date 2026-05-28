<?php
require('classblog.php');

// afhankelijk welke rol je hebt kun je een blog aanmaken.
// hier form informatie gevalideerd. en wordt de data naar de juiste plekken toegestuurd fotos gaan naar de upload map en allen andere waarden gaat de database in . 

  if(isset($_POST["safe"])){    

    
    $filename = $_FILES['foto']['name'];
    $file_path = '/uploads/' . $filename;
    $title =  $_POST["title"];
    $text =  $_POST["text"];
    $category = $_POST["categorie"];
 echo $title. $text .$category;
 move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . $file_path);

$_Blog->createBlog($title,$text,$filename,$file_path,$category) ? "OK" : $_Blog->error; }


?>

<html>


<head>
<link rel="stylesheet" href="styles/createblog.css">
</head>
    
<body>

<nav>
    <img src="images/logo.png" alt="logo vacantie blog">

   
        <ul>
        <li><a href="contact.asp">Username</a></li>
        <li><button type="submit">Loguit</button></li>
        </ul>

</nav>


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
