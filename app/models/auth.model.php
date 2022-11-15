<?php

class AuthModel {
 
  private $db;

  public function __construct(){
    $this->db = new PDO('mysql:host=localhost;'.'dbname=db_zapatillas;charset=utf8', 'root', '');
  }

  public function userDB($email){
    $query = $this->db->prepare("SELECT * FROM user WHERE usuario = ? ");
    $query->execute([$email]);  
    
       
    return  $query->fetch(PDO::FETCH_OBJ);
  }
}
