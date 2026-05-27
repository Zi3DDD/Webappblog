<?php
class Blog {

  private $pdo = null;
  private $stmt = null;
  public $error;

  // pdo connectie  wordt hier gemaakt .
  function __construct () {
      $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  //Connectie vernietigen zodat ombefoegde mensen er niet bij kunnen
  function __destruct(){
    if($this->stmt !== null){
        $this->stmt = null;
    }
    if ($this->pdo !== null){
        $this->pdo = null;
    }
  }
 
// Functies voor Zahied
  // Hier wordt de opgeslagen blog informatie  opgehaald uit de database. Tergelijkten tijd wordt er ook de jusite afbeelding opgehaaldt uit de database.
  function readBlog(){
        $stmt = $this->pdo->prepare("
        SELECT blog.id, blog.titel, blog.text, image.filename, blog.created_at, blog.categorie, image.url
        FROM blog
        INNER JOIN image ON blog.header_image_id = image.image_id
        ORDER BY blog.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

// Zoekt in de database op basis van zoek worden op basis van titel zie Where blog.titel.
  function zoek($zoekwoord){
      $stmt = $this->pdo->prepare("
      SELECT blog.*, image.filename
      FROM blog
      INNER JOIN image ON blog.header_image_id = image.image_id
      WHERE blog.titel LIKE ?
      ");
      $stmt->execute(["%$zoekwoord%"]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
// filterr op categorie  in de database zie Where blog.categorie.
  function filtercategorie($categorie){
      $stmt = $this->pdo->prepare("
      SELECT blog.*, image.filename
      FROM blog
      INNER JOIN image ON blog.header_image_id = image.image_id
      WHERE blog.categorie = ?
      ");
      $stmt->bindParam(1, $categorie);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
// slaat gegevens van geintresseerde op voor nieuwsbrief.
  function nieuwsbrief($email){
      $stmt = $this->pdo->prepare('INSERT INTO subscriber (email) VALUES (?)');
      $stmt->bindParam(1, $email);
      $stmt->execute();
  }
}

// hier worden de jusite  parameters aan de blog meegegeven zodat er een connectie gemaakt kan worden met de database.
define("DB_HOST", "db");
define("DB_NAME", "db_blog");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "root");

$_Blog = new Blog();

?>