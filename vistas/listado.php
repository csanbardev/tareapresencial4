<!DOCTYPE html>
<html lang="es">
<?php require_once 'includes/head.php' ?>

<body>
  <?php require_once 'includes/nav.php' ?>
  <div class="container center">
    <?php foreach ($parametros["mensajes"] as $mensaje) : ?>
      <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
    <?php endforeach; ?>
    <h1>Entradas de <?=$_SESSION['nick']?></h1>  
    <br>
    <div class="dropdown" <?= count($parametros['datos'])<=0? 'style="display: none"':''?>>
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Ordenar por fecha
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="index.php?accion=<?= $_GET['accion']?>&id=<?= $_SESSION['id']?>&orden=desc">Más reciente primero</a>
        <a class="dropdown-item" href="index.php?accion=<?= $_GET['accion']?>&id=<?= $_SESSION['id']?>&orden=asc">Más antiguo primero</a>
      </div>
    </div>
    <br>  
    <?php
       if(count($parametros['datos'])<=0){
        echo '<h2>No hay entradas para mostrar :C</h2>';
       } 
       ?>
    <div class="row">

      <?php
      $datos = $parametros['datos'];
      foreach ($datos as $dato) :
      ?>

        <div class="shadow-lg card col-lg-4 p-2" style="width:400px">
          <img class="card-img-top" src=<?= 'images/' . $dato['imagen'] ?> alt="Card image">
          <div class="card-body">
            <h4 class="card-title"><?= $dato['titulo'] ?></h4>
            <p class="card-text"><?= $dato['descripcion'] ?></p>
            <span class="badge badge-primary">Autor: <?= $dato['nick'] ?></span><br>
            <span class="badge badge-secondary"><?= $dato['nombre'] ?></span>
            <span class="badge badge-secondary"><?= date("d-m-Y",strtotime($dato['fecha'])) ?></span>
            <div class="pt-4">
              <a href=<?= 'index.php?accion=actEntrada&id=' . $dato['id'] ?> class="btn btn-secondary">Editar</a>
              <a class="btn btn-danger" data-toggle="modal" data-target=<?= '#modal-' . $dato['id'] ?>>Eliminar</a>
            </div>
          </div>
        </div>

        <!-- Ventana modal -->
        <div class="modal" id=<?= 'modal-' . $dato['id'] ?>>
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Eliminar entrada</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                ¿Seguro que quieres borrar esta entrada?
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <a class="btn btn-danger" href=<?= 'index.php?accion=delEntrada&id=' . $dato['id'] ?>>Aceptar</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
              </div>

            </div>
          </div>
        </div>


      <?php endforeach;
      ?>

    </div>
    <br>    
    <?php //Sólo mostramos los enlaces a páginas si existen registros a mostrar
    if ($parametros['paginacion']['totalregistros'] >= 1) :
    ?>
      <nav aria-label="Page navigation example" class="text-center">
        <ul class="pagination">

          <?php
          //Comprobamos si estamos en la primera página. Si es así, deshabilitamos el botón 'anterior'
          if ($parametros['paginacion']['pagina'] == 1) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="index.php?<?= $_SESSION['rol'] == 'user' ? 'accion=listadoUsuario' : 'accion=listadoAdmin' ?>&pagina=<?php echo $parametros['paginacion']['pagina'] - 1; ?>&regsxpag=<?= $parametros['paginacion']['regsxpag'] ?><?= isset($_GET['orden'])?'&orden='.$_GET['orden']:""?><?='&id='.$_SESSION['id']?>"> &laquo;</a></li>
          <?php
          endif;
          //Mostramos como activos el botón de la página actual
          for ($i = 1; $i <= $parametros['paginacion']['numpaginas']; $i++) {
            $orden = "&orden=desc"; // etiqueta de orden por defecto que aparecerá

            // si se especifica el orden, redefinimos la anterior variable
            if(isset($_GET['orden'])){
              $orden = "&orden=".$_GET['orden'];
            }


            if ($parametros['paginacion']['pagina'] == $i && $_SESSION['rol'] == 'user') {
              echo '<li class="page-item active"> 
                <a class="page-link" href="index.php?accion=listadoUsuario&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] .$orden.'&id='.$_SESSION['id'].'">' . $i . '</a></li>';
            } else if ($parametros['paginacion']['pagina'] == $i && $_SESSION['rol'] == 'admin') {
              echo '<li class="page-item active"> 
              <a class="page-link" href="index.php?accion=listadoAdmin&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'].$orden.'&id='.$_SESSION['id']. '">' . $i . '</a></li>';
            } else if ($_SESSION['rol'] == 'user') {
              echo '<li class="page-item"> 
                <a class="page-link" href="index.php?accion=listadoUsuario&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] .$orden.'&id='.$_SESSION['id']. '">' . $i . '</a></li>';
            } else {
              echo '<li class="page-item"> 
                <a class="page-link" href="index.php?accion=listadoAdmin&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] .$orden.'&id='.$_SESSION['id']. '">' . $i . '</a></li>';
            }
          }
          //Comprobamos si estamos en la última página. Si es así, deshabilitamos el botón 'siguiente'
          if ($parametros['paginacion']['pagina'] == $parametros['paginacion']['numpaginas']) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="index.php?<?= $_SESSION['rol'] == 'user' ? 'accion=listadoUsuario' : 'accion=listadoAdmin' ?>&pagina=<?php echo $parametros['paginacion']['pagina'] + 1; ?>&regsxpag=<?= $parametros['paginacion']['regsxpag'] ?><?= isset($_GET['orden'])?'&orden='.$_GET['orden']:""?><?='&id='.$_SESSION['id']?>"> &raquo; </a></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif;  //if($totalregistros>=1): 
    ?>
  </div>
  <?php require_once 'includes/footer.php' ?>
</body>

</html>