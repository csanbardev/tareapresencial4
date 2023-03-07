<?php
  require_once 'controladores/controlador.php';

  $controlador = new controlador();


  // compruebo que se haya iniciado la sesión
  if(isset($_SESSION['iniciada'])&& $_SESSION['iniciada']){

    if(isset($_GET) && isset($_GET["accion"])){
      $accion = (string)filter_input(INPUT_GET, "accion", FILTER_UNSAFE_RAW);
  
      if(method_exists($controlador, $accion)){
        if($accion == "actEntrada" || $accion == "delEntrada" || $accion == "listadoUsuario"){
          $id = filter_input(INPUT_GET, "id", FILTER_UNSAFE_RAW);
          $controlador->$accion($id);
        }else{
          $controlador->$accion();
        }
      }else{
        $controlador->index();
      }
    }else{
      $controlador->index();
    }
  }else{
    $controlador->iniciarSesion();
  }



?>