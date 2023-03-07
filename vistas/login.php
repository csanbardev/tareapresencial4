<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/head.php' ?>

<body>
  <?php require_once 'includes/nav.php' ?>

  <div class="container center">
    <form action="index.php?accion=iniciarSesion" method="post">
      <label for="titulo">Nick
        <input name="txtnick" class="form-control" type="text">
      </label>
      <br>
      <label for="titulo">Contraseña
        <input name="txtpass" class="form-control" type="password">
      </label>
      <br>
      <input type="submit" value="Iniciar sesión" name="submit">
    </form>
  </div>
</body>

</html>