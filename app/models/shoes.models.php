<?php

class ShoesModel {
 
  private $db;

  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;'.'dbname=db_zapatillas;charset=utf8', 'root', '');
  }
     

function getAll($start_where, $size_pages, $sort= null, $order=null) {
    if ($sort && $order){
  
      $query = $this->db->prepare("SELECT a.* FROM zapatillas a INNER JOIN marca b ON a.id_marca = b.id ORDER BY  $sort $order LIMIT $start_where, $size_pages");
      $query->execute();
    } else {
      $query = $this->db->prepare("SELECT a.* FROM zapatillas a INNER JOIN marca b ON a.id_marca = b.id   LIMIT $start_where, $size_pages");
      $query->execute();
    }

    $shoes = $query->fetchAll(PDO::FETCH_OBJ); 
    
    return $shoes;
}


function filterByFields($section, $value, $start, $size_pages, $sort="id", $order="asc"){
  $query = $this->db->prepare("SELECT a.* FROM zapatillas a INNER JOIN marca b ON a.id_marca = b.id  WHERE $section = ? ORDER BY $sort $order LIMIT $start, $size_pages");
  $query->execute([$value]);
  $shoe = $query->fetchAll(PDO::FETCH_OBJ);
  return $shoe;
}

//obtengo solo un par
function getShoe($id){

  $query= $this->db->prepare("SELECT * FROM zapatillas WHERE id = ?");
  $query->execute([$id]);

  $shoe =$query->fetch(PDO::FETCH_OBJ);

  return $shoe;

}

 // Inserta una zapas en la base de datos.

function insert($modelo, $color, $talle,$precio,$id_marca) {
  $query = $this->db->prepare("INSERT INTO zapatillas (modelo, color, talle, precio, id_marca) VALUES (?, ?, ?, ?, ?)");
    $query->execute([$modelo, $color, $talle, $precio, $id_marca]);

    return $this->db->lastInsertId();
}


  //Elimina unas zapas dado su id.
 
function delete($id) {
  $query = $this->db->prepare('DELETE FROM zapatillas WHERE id = ?');
  $query->execute([$id]);
}


 //EDITAR UN ITEM 


function editShoe($modelo, $color, $talle, $precio, $id_marca, $id) {  //update al item

  $query = $this->db->prepare("UPDATE zapatillas SET modelo = ?, color = ?, talle = ?, precio = ?, id_marca = ? WHERE id = ?");
  $query->execute([$modelo, $color, $talle, $precio, $id_marca, $id]);
}

}



