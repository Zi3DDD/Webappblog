<?php
session_start();

// Hier form validatie gedaan of je de juiste id hebt van een blog en als het de jusite is kan je de blog verwijderen  ?
require('classuser.php');
$_User->requireLogin(2,2);
include 'classblog.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


$_Blog->deleteBlog($id);

header("Location: dashboard.php");
        exit;

}
?>


