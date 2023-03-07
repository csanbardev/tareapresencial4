<!DOCTYPE html>
<html lang="es">
<?php require_once 'includes/head.php' ?>

<body>
  <?php require_once 'includes/nav.php' ?>
  <div class="container center">
    <?php foreach ($parametros["mensajes"] as $mensaje) : ?>
      <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
    <?php endforeach; ?>
    <div class="dropdown" <?= count($parametros['datos'])<=0? 'style="display: none"':''?>>
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Ordenar por fecha
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="index.php?accion=listarLogs&orden=desc">Más reciente primero</a>
        <a class="dropdown-item" href="index.php?accion=listarLogs&orden=asc">Más antiguo primero</a>
      </div>
    </div>
    <br>  
    <h1>Listado de logs</h1>
    <table class="table table-striped">
      <tr>
        <th>Operación</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th></th>
      </tr>

      <?php foreach($parametros['datos'] as $dato): ?>
        <tr>
          <td><?= $dato['operacion'] ?></td>
          <td><?= $dato['usuario'] ?></td>
          <td><?=  date("d-m-Y",strtotime($dato['fecha'])) ?></td>
          <td><?= $dato['hora'] ?></td>
          <td><a class="btn btn-danger" data-toggle="modal" data-target=<?= '#modal-' . $dato['id'] ?>>Eliminar</a></td>
        </tr>
        <!-- Ventana modal -->
        <div class="modal" id=<?= 'modal-' . $dato['id'] ?>>
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Eliminar registro de log</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                ¿Seguro que quieres borrar este registro?
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <a class="btn btn-danger" href=<?= 'index.php?accion=eliminarLog&id=' . $dato['id'] ?>>Aceptar</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
              </div>

            </div>
          </div>
        </div>
     <?php endforeach; ?>   
    </table>
    <br>
    <?php //Sólo mostramos los enlaces a páginas si existen registros a mostrar
    if ($parametros['paginacion']['totalregistros'] >= 1) :
    ?>
      <nav aria-label="Page navigation example" class="text-center">
        <ul class="pagination">

          <?php
          //Comprobamos si estamos en la primera página. Si es así, deshabilitamos el botón 'anterior'
          if ($parametros['paginacion']['pagina'] == 1) : ?>
            <li class="page-item disabled"><a class="page-link" href="#<?= isset($_GET['orden']) ? '?orden=' . $_GET['orden'] : "" ?>">&laquo;</a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="index.php?accion=listarLogs&pagina=<?php echo $parametros['paginacion']['pagina'] - 1; ?>&regsxpag=<?= $parametros['paginacion']['regsxpag'] ?><?= isset($_GET['orden']) ? '&orden=' . $_GET['orden'] : "" ?>"> &laquo;</a></li>
          <?php
          endif;
          //Mostramos como activos el botón de la página actual
          for ($i = 1; $i <= $parametros['paginacion']['numpaginas']; $i++) {
            if ($parametros['paginacion']['pagina'] == $i) {
              // compruebo que se haya indicado un orden
              if (isset($_GET['orden'])) {
                echo '<li class="page-item active"> 
                <a class="page-link" href="index.php?accion=listarLogs&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] . '&orden=' . $_GET['orden'] . '">' . $i . '</a></li>';
              } else {
                echo '<li class="page-item active"> 
                <a class="page-link" href="index.php?accion=listarLogs&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] . '">' . $i . '</a></li>';
              }
            } else {
              // compruebo que se haya indicado un orden
              if (isset($_GET['orden'])) {
                echo '<li class="page-item"> 
                <a class="page-link" href="index.php?accion=listarLogs&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] .'&orden=' . $_GET['orden'] . '">' . $i . '</a></li>';
              } else {
                echo '<li class="page-item"> 
                  <a class="page-link" href="index.php?accion=listarLogs&pagina=' . $i . '&regsxpag=' . $parametros['paginacion']['regsxpag'] . '">' . $i . '</a></li>';
              }
            }
          }
          //Comprobamos si estamos en la última página. Si es así, deshabilitamos el botón 'siguiente'
          if ($parametros['paginacion']['pagina'] == $parametros['paginacion']['numpaginas']) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="index.php?accion=listarLogs&pagina=<?php echo $parametros['paginacion']['pagina'] + 1; ?>&regsxpag=<?= $parametros['paginacion']['regsxpag'] ?><?= isset($_GET['orden'])?'&orden='.$_GET['orden']:""?>"> &raquo; </a></li>
          <?php endif; ?>
        </ul>
        
      </nav>

    <?php endif;  //if($totalregistros>=1): 
    ?>
    <br>
    <a <?= count($parametros['datos'])<=0? 'style="display: none"':''?> href="index.php?accion=imprimirLogs" class="btn btn-primary">Imprimir en pdf</a>
  </div>
  <?php require_once 'includes/footer.php' ?>
</body>

</html>