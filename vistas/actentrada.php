<!DOCTYPE html>
<html lang="es">
<?php require_once 'includes/head.php' ?>

<body>
  <?php require_once 'includes/nav.php' ?>

  <div class="container center">
    <?php foreach ($parametros["mensajes"] as $mensaje) : ?>
      <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
    <?php endforeach; ?>
    <form <?='action=index.php?accion=actEntrada&id='. $_GET['id'] ?> method="POST" enctype="multipart/form-data">
      <label for="titulo">Título
        <input name="txttitulo" class="form-control" type="text" value="<?= $parametros["datos"]["txttitulo"] ?>">
        <?= isset($parametros['errores']['txttitulo'])? '<div class="alert alert-danger">'.$parametros['errores']['txttitulo'].'</div>':"" ?>
      </label>
      <br>
      <label for="descripcion">Descripción
        <textarea name="txtdescripcion" class="form-control" name="" id="txtdescripcion" cols="30" rows="10" >
        <?= $parametros["datos"]["txtdescripcion"] ?>
        </textarea>
        <?= isset($parametros['errores']['txtdescripcion'])? '<div class="alert alert-danger">'.$parametros['errores']['txtdescripcion'].'</div>':"" ?>
      </label>
      <br>
      <label for="fecha">Inserta la fecha
        <input name="dtfecha" class="form-control" type="date" name="" id="" value="<?= $parametros["datos"]["dtfecha"] ?>">
        <?= isset($parametros['errores']['dtfecha'])? '<div class="alert alert-danger">'.$parametros['errores']['dtfecha'].'</div>':"" ?>
      </label>
      <br>
      <?php
        if($parametros['datos']['imagen'] != null && $parametros['datos']['imagen'] != ""){
          echo 'Imagen de la entrada: <img src="images/'.$parametros['datos']['imagen'].'" width="200">';
        }
      ?>
      <br>
      <label for="imagen">Inserta la imagen
        <input name="imagen" class="form-control" type="file" name="" id="" >
        <?= isset($parametros['errores']['imagen'])? '<div class="alert alert-danger">'.$parametros['errores']['imagen'].'</div>':"" ?>

      </label>
      <br>
      <label for="categoria">Elige una categoría
        <select class="form-control" name="slcategoria" id="">
          <?php
          foreach ($parametros['categorias'] as $ctg) :
          ?>
            <option <?= $parametros['datos']['slcategoria']==$ctg['id']? 'selected':'' ?> value=<?= $ctg['id'] ?>><?= $ctg['nombre'] ?></option>
          <?php endforeach; ?>

        </select>
      </label>
      <br>
      <input type="hidden" name="txtid" value=<?= $_GET['id']?>>
      <input type="hidden" name="txtusuario" value="<?= $parametros["datos"]["txtusuario"] ?>" >
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