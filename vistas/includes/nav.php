<?php
// session_start();
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-between">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Inicio</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="index.php?accion=listarLogs">Registros logs</a>
    </li>

    <?php


    if (isset($_SESSION['iniciada']) && $_SESSION['iniciada']) {

      $html = '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">';
      $html = $html . $_SESSION['nick'];
      $html = $html . '</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="' .
        'index.php?accion=';



      $html = $html . $_SESSION['nick'];
      $html = $html . '">Entradas</a>';
      if ($_SESSION['nick'] == 'user') { // el usuario podrá añadir entradas, el admin no
        $html = $html . '<a class="dropdown-item" href="index.php?accion=addTarea">Añadir</a>';
      }
      if ($_SESSION['nick'] == 'admin') { // el administrador podrá ver el listado de logs 
        $html = $html . '<a class="dropdown-item" href="index.php?accion=listarLogs">Ver logs</a>';
      }
      $html = $html .
        '<a class="dropdown-item" href="index.php?accion=cerrarSesion">Cerrar sesión</a>
    </div>
</li>';

      echo $html;
    }
    ?>
  </ul>

</nav>