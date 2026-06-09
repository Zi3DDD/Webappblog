<?php
session_start();
require('classblog.php');
require_once('classuser.php');
$_User->requireLogin(2,2);
include('header.php');


// Hier wodt allen blogs opgehaald uit de database afhankelijk welke rol je hebt. 

?>

<html>


<head>
<link rel="stylesheet" href="styles/dasboardadmin.css">
</head>
    
<body>





<div class="buttons">
<a  href="createblog.php">Nieuwe blog aanmaken</a>
                        <a href="blog.php?id=<?= $blog['id'] ?>" class="lees-meer-knop">Lees meer</a>

</div>
 <div class="blogs">
    <?php
 $data1 = $_Blog->readBlog();
foreach($data1 as $row){?>

<table class="overzicht">
<td><h3> <?php echo htmlspecialchars($row['titel']);  ?> </h3> </td>
<td> <button><a href="update.php?id=<? echo htmlspecialchars($row['id']); ?>">Update</a></button></td>
<td><button> <a href="delete.php?id=<? echo htmlspecialchars($row['id']); ?>">Verwijderen</a></button></td>
</table>



<?php
}

?>
</div>
</body>





<html>
