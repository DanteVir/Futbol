<?php

  require '../database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
      $message = 'Usuario creado exitosamente';
    } else {
      $message = 'Lo sentimos no fue registrada con exito';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario_de_cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="registro.php">

        <h2>Creacion Cuenta</h2>
        <?php if(!empty($message)): ?>
      <p style="font-family:arial; color:aqua; text-align:center;"> <?= $message ?></p>
    <?php endif; ?>


        <label for="username">Correo Electronico</label>
        <input type="text" id="username" name="email">

        <label for="password">contraseña</label>
        <input type="text" id="password"name="password">

        <label for="password">Confirmar contraseña</label>
        <input type="text" id="password" name="password">

        <div class="remember">
            <a href="../recuperar/recuperar.php" class="header__menu__link">¿Has olvidado tu contraseña?</a>
        </div>

        <input type="submit" class="btn-1" value="iniciar"><li href="../login/iniciarsesion.html" class="header__menu__link"></a>
        

    </form>
    
</body>
</html>