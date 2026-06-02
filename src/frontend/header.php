<html>
<head>
<link rel="stylesheet" href="styles/header.css">
</head>
    
<body>

<nav>
    <img src="images/logo.png" alt="logo vacantie blog">

   
        <ul> 
            <li><a href="contact.asp">Home pagina</a></li>
            <li><a href="contact.asp">Mijn blogs </a></li>
        <li><?php echo $_SESSION['username']; ?></li>
        <li><button type="submit"><a>Loguit</a></button></li>
        </ul>

</nav>


</html>