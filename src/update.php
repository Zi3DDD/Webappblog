<?php
session_start();
require('classblog.php');
require_once('classuser.php');
$_User->requireLogin(2,2);
include('header.php');
// hier wordt oude informatie opgehaald van een blog en kan je die oude info bewerken en de gegevens updaten .

if (isset($_GET['id'])) {
    $id = $_GET['id'];





  if(isset($_POST["safe"])){    

    
    $filename = $_FILES['foto']['name'];
    $file_path = '/uploads/' . $filename;
    $title =  $_POST["title"];
    $text =  $_POST["text"];
    $category = $_POST["categorie"];
 echo $title. $text .$category;
 move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . $file_path);

$_Blog->updateBlog($id,$title,$text,$filename,$file_path,$category) ? "OK" : $_Blog->error;}

 $data1 = $_Blog->readUpdate($id);
foreach($data1 as $row){



?>


<?php
?>


<html>


<head>
<link rel="stylesheet" href="styles/createblog.css">
</head>
    
<body>

 <form  enctype="multipart/form-data" method="post">
     <br>
     <input class="input" type="text" name="title" value="<?php echo htmlspecialchars($row['titel']); ?>">
      <br>
     <input type="file"  name="foto" />
     <br>

        <select id="categorie" name="categorie" value="<?php echo htmlspecialchars($row['categorie']); ?>">
        <option value="Bergen">Bergen</option>
        <option value="Zee">Zee</option>
        <option value="Stad">Stad</option>
        <option value="Bossen">Bossen</option>
        </select>
        <label for="categorie">Kies een caterogie</label>
    <br>
     <textarea  name="text" rows="10" cols="50"><?php echo htmlspecialchars($row['text']); ?></textarea>
    <br>
     <button type="submit" name="safe">Blog aanmaken</button>
</form>
</body>





</html>

<?php   }}?>