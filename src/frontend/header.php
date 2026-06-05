<?php
require_once('classuser.php');

?>


<head>
<link rel="stylesheet" href="styles/header.css">
</head>
<nav>
    <img src="images/logo.png" alt="logo vakantie blog">

    <ul>
        <li><a href="index.php">Home pagina</a></li>
        <li><a href="dashboard.php">Mijn blogs</a></li>

        <li class="username">
             <?= htmlspecialchars($_SESSION["username"] ?? '') ?>
        </li>

        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</nav>