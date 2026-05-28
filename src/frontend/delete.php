<?php
// Hier form validatie gedaan of je de juiste id hebt van een blog en als het de jusite is kan je de blog verwijderen  ?


include 'classblog.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


$_Blog->deleteBlog($id);

}
?>


