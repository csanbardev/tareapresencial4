<!DOCTYPE html>
<html lang="es">
<?php require_once 'includes/head.php' ?>

<body>
  <?php require_once 'includes/nav.php' ?>

  <div class="container center">
    <?php foreach ($parametros["mensajes"] as $mensaje) : ?>
      <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
    <?php endforeach; ?>
    <form action="index.php?accion=addEntrada" method="POST" enctype="multipart/form-data">
      <label for="titulo">Título
        <input name="txttitulo" class="form-control" type="text" value="<?= $parametros["datos"]["txttitulo"] ?>">
        <?= isset($parametros['errores']['txttitulo']) ? '<div class="alert alert-danger">' . $parametros['errores']['txttitulo'] . '</div>' : "" ?>

      </label>
      <br>
      <label for="descripcion">Descripción
        <textarea name="txtdescripcion" class="form-control" name="" id="txtdescripcion" cols="30" rows="10">
          <?= $parametros["datos"]["txtdescripcion"] ?>
        </textarea>
        <?= isset($parametros['errores']['txtdescripcion']) ? '<div class="alert alert-danger">' . $parametros['errores']['txtdescripcion'] . '</div>' : "" ?>
      </label>
      <br>
      <label for="fecha">Inserta la fecha
        <input name="dtfecha" class="form-control" type="date" name="dtfecha" id="">
        <?= isset($parametros['errores']['dtfecha']) ? '<div class="alert alert-danger">' . $parametros['errores']['dtfecha'] . '</div>' : "" ?>

      </label>
      <br>
      <label for="imagen">Inserta la imagen
        <input name="imagen" class="form-control" type="file" name="imagen" id="">
        <?= isset($parametros['errores']['imagen']) ? '<div class="alert alert-danger">' . $parametros['errores']['imagen'] . '</div>' : "" ?>
      </label>
      <br>
      <label for="categoria">Elige una categoría
        <select class="form-control" name="slcategoria" id="">
          <?php
          foreach ($parametros['categorias'] as $ctg) :
          ?>
            <option value=<?= $ctg['id'] ?>><?= $ctg['nombre'] ?></option>
          <?php endforeach; ?>

        </select>
      </label>
      <br>
      <input type="hidden" name="txtid" value=<?= $_SESSION['id'] ?>>
      <input class="btn btn-primary" type="submit" name="submit">
    </form>
  </div>


  
  <?php require_once 'includes/footer.php' ?>
  <script>
    CKEDITOR.replace('txtdescripcion', {
      height: '500px',
    });
  </script>
</body>

</html>