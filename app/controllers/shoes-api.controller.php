<?php

require_once './app/models/shoes.models.php';
require_once './app/view/api.view.php';
require_once './app/helpers/auth.helper.php';
 
class ShoesController{
    private $model;
    private $view;
    private $helper;
    private $data;

   public function __construct(){
   $this->helper = new AuthApiHelper();
   $this->model  = new ShoesModel();
   $this->view = new ApiView();

   $this->data =file_get_contents("php://input");
   }
   
   private function getData(){
      return json_decode($this->data);
   }
      

function getShoes(){
   $sortByDefault = "id";
   $orderDefault = "asc";
   $size_pages = 3;
   $page = 1;
  
   if (isset($_GET["sortby"])){
      $sortby = $this->Sanitize($_GET["sortby"]);

   }
   if (isset($_GET["section"])) {
      $section = $this->Sanitize($_GET["section"]);
  }
   if (isset($_GET["page"])){
      $page = $this->transformNatural($_GET["page"],$page);
   }
   if(isset($_GET["order"])){
      $order = $this->Sanitize($_GET["order"]);
   }
    $start = ($page - 1) * $size_pages;

   try {
      if (!empty($sortby) && !empty($order) && empty($section) && empty($_GET["value"])) {
         $shoe = $this->model->getAll($start, $size_pages, $sortby, $order);
     } else if (!empty($section) && !empty($_GET["value"]) && !empty($sortby) && !empty($order)) {
         $shoe = $this->model->filterByFields($section, $_GET["value"], $start, $size_pages, $sortby, $order);
     } else if (!empty($sortby)) {
         $shoe = $this->model->getAll($start, $size_pages, $sortby, $orderDefault);
     } else if (!empty($order)) {
         $shoe = $this->model->getAll($start, $size_pages, $sortByDefault, $order);
     } else if (!empty($section) && !empty($_GET["value"])) {
         $shoe = $this->model->filterByFields($section, $_GET["value"], $start, $size_pages, $sortByDefault, $orderDefault);
     } else {
         $shoe = $this->model->getAll($start, $size_pages);
     }
    }catch(Exception) {
      $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
   }
   if (isset($shoe)) {
      $this->view->response($shoe, 200);
  }

}
    public  function getShoe($params =null){


    $id= $params[':ID'];
    $shoe = $this->model->getShoe($id);

   if ($shoe)
    $this->view->response($shoe);
    else 
    $this->view->response("El par de zapatilla con el id= $id no existe", 404);
}




 public function deleteShoe($params = null){
    if (!$this->helper->isLoggedIn()){

      $this->view->response("No estas logueado", 401);
      return;
    } 
   
   $id= $params[':ID'];
    $shoe = $this->model->getShoe($id);
    
    if ($shoe) {
        $this->model->delete($id);
        
        $this->view->response("El par de zapatilla con el id=$id se  elimino con éxito" , 200);
    } else 
        $this->view->response("El par de zapatilla con el id=$id no existe", 404);
    }




 public function insertShoe($params = null) {

    if (!$this->helper->isLoggedIn()) {
        $this->view->response("No estas logeado", 401);
        return;
    }
  

    $shoe = $this->getData();

      if (empty($shoe->modelo) || empty($shoe->color) || empty($shoe->talle) || empty($shoe->precio) || empty($shoe->id_marca)) {
       $this->view->response("Complete los datos", 400);        } 
       else {
        $id = $this->model->insert($shoe->modelo, $shoe->color, $shoe->talle, $shoe->precio, $shoe->id_marca);
        $this->view->response("El par de zapatilla con el id=$id se insertó con éxito ", 201);
        }
    }


    public function editShoe ($params = null) {
        $id = $params [':ID'];
        $shoe = $this->model->getShoe($id);
        
        try { 
                if($shoe) {
                    $newShoe = $this->getData();
                    if (empty($newShoe->modelo) || empty($newShoe->color) || empty($newShoe->talle) || empty($newShoe->precio) || empty($newShoe->id_marca) ){
                        $this->view->response("Faltan completar campos", 400);
                    } else {
                            $this->model->editShoe($newShoe->modelo, $newShoe->color, $newShoe->talle, $newShoe->precio ,$newShoe->id_marca, $id);
                            $this->view->response("Par de zapatilla con el id $id se modifico exitosamente", 200);
                        }
                }else {
                    $this->view->response("Par de zapatilla con el id $id que quieres modificar no existe", 404);
                }
        } catch (Exception) {
                 $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
            }
    }
   

 public function Sanitize($params){
   $columns = array(
       'modelo' => 'modelo',
       'color' => 'color',
       'talle' => 'talle',
       'precio' => 'precio',
       'id_marca' => 'id_marca',
   );
   $order = array(
       'asc' => 'asc',
       'desc' => 'desc'
   );
   if (isset($columns[$params])||(isset($order[$params]))) {
       return $params;
   } else {
       return null;
   }
}
public function transformNatural($param, $defaultParam) {
   $result = intval($param);
   if ($result > 0) {
       $result = $param;
   } else {
       $result = $defaultParam;
   }
   return $result;
}

    
}