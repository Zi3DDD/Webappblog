<?php
require('classconnection.php');
class Blog  {

  public $pdo;

  public function __construct() {
      $this->pdo = new Connection();
  }

  // Hier begint de crud operaties van de blog.

  // Bij create blog kan je  een blog toeveogen bij de aan de database. Tergelijkertijd wordt er ook een afbeelding toeggevoegd aan de database.
  function createBlog($title,$text,$filename,$file_path,$category){
 
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('INSERT INTO image(filename, url ) VALUES( ? ,?)');
        $stmt->bindParam(1, $filename);
        $stmt->bindParam(2, $file_path);
        $stmt->execute();
        $last_id = $this->pdo->lastInsertId();
        $this->pdo->commit();
 
        $this->pdo->beginTransaction();
        $stmt1 = $this->pdo->prepare('INSERT INTO blog(titel, text, header_image_id, categorie) VALUES( ? ,?,?,?)');
        $stmt1->bindParam(1, $title);
        $stmt1->bindParam(2, $text);
        $stmt1->bindParam(3, $last_id);
        $stmt1->bindParam(4, $category);
        $stmt1->execute();
        $this->pdo->commit();
  }
 
 
 
  // hier worden de bij elkaar hoorende blog en afbeelding geupdate.  Er wordt ook gegekeken of de afbeelding al bestaat zo ja dan krijgt de afbeelding de juiste waarde toegevoegd.
  function updateBlog($id,$title,$text,$filename,$file_path,$category){
 
       $stmt = $this->pdo->prepare("SELECT * FROM image WHERE filename = ?");
       $stmt->bindParam(1, $filename);
       $stmt->execute();
 
       if($row = $stmt->fetch()){
         $existing_image_id = $row['image_id'];
 
         $this->pdo->beginTransaction();
         $stmt2 = $this->pdo->prepare('UPDATE blog SET titel = ?, text = ?, header_image_id = ?, categorie = ? WHERE id = ?');
         $stmt2->bindParam(1, $title);
         $stmt2->bindParam(2, $text);
         $stmt2->bindParam(3, $existing_image_id);
         $stmt2->bindParam(4, $category);
         $stmt2->bindParam(5, $id);
         $stmt2->execute();
         $this->pdo->commit();
 
       } else {
 
         $stmt1 = $this->pdo->prepare('INSERT INTO image(filename, url ) VALUES( ? ,?)');
         $stmt1->bindParam(1, $filename);
         $stmt1->bindParam(2, $file_path);
         $stmt1->execute();
         $last_id = $this->pdo->lastInsertId();
 
         $this->pdo->beginTransaction();
         $stmt2 = $this->pdo->prepare('UPDATE blog SET titel = ?, text = ?, header_image_id = ?, categorie = ? WHERE id = ?');
         $stmt2->bindParam(1, $title);
         $stmt2->bindParam(2, $text);
         $stmt2->bindParam(3, $last_id);
         $stmt2->bindParam(4, $category);
         $stmt2->bindParam(5, $id);
         $stmt2->execute();
         $this->pdo->commit();
       }
  }
 
  // hier wordt je juiste blog en afbeelding informatie opgehaald om te laten zien wat er al was zodat je dat kan updaten.
  function readUpdate($id){
      $stmt = $this->pdo->prepare("SELECT * FROM blog WHERE id = ?");
      $stmt->bindParam(1, $id);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
 
  // hier wordt de juiste blog en afbeelding informatie verwijderd uit de database.
  function deleteBlog($id){
      $this->pdo->beginTransaction();
 
      $stmt = $this->pdo->prepare("SELECT header_image_id FROM blog WHERE id = ?");
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $header_image_id = $stmt->fetchColumn();
 
      $stmt2 = $this->pdo->prepare("DELETE FROM blog WHERE id = ?");
      $stmt2->bindParam(1, $id);
      $stmt2->execute();
 
      $stmt1 = $this->pdo->prepare("DELETE FROM image WHERE image_id = ?");
      $stmt1->bindParam(1, $header_image_id);
      $stmt1->execute();
 
      $this->pdo->commit();
  }
 

}
 
// hier worden de jusite  parameters aan de blog meegegeven zodat er een connectie gemaakt kan worden met de database.

$_Blog = new Blog();

?>
