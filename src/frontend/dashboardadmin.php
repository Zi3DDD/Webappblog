<?php
require('classuser.php');
$check = $_User->requireLogin();

// Hier wodt allen blogs opgehaald uit de database afhankelijk welke rol je hebt. 

?>

<html>


<head>
<link rel="stylesheet" href="styles/dasboardadmin.css">
</head>
    
<body>

<nav>
    <img src="images/logo.png" alt="logo vacantie blog">

   
        <ul>
        <li><a href="contact.asp">Username</a></li>
        <li><button type="submit">Loguit</button></li>
        </ul>

</nav>




<div class="buttons">
<button type="button">Nieuwe blog aanmaken</button>
</div>
 <div class="blogs">
    <?php
 $data1 = $_Blog->readBlog();
foreach($data1 as $row){?>

<table class="overzicht">
<td><h3> <?php echo $row['titel'];  ?> </h3> </td>
<td> <button><a href="update.php?id=<? echo $row['id']; ?>">Update</a></button></td>
<td><button> <a href="delete.php?id=<? echo $row['id']; ?>">Verwijderen</a></button></td>
</table>



<?php
}

?>
</div>
</body>





<html>
