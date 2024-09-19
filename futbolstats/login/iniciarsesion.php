<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /Proyectos/futbolstats/index');
  }
  require '../database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /Proyectos/futbolstats/index");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio_de_sesion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action='../login/iniciarsesion.php' method="POST">

        <h2>Login</h2>
        <?php if(!empty($message)): ?>
            <p style="font-family:arial; color:aqua; text-align:center;"> <?= $message ?></p>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="email">

        <label for="password">Password</label>
        <input type="text" id="password" name="password">

        <div class="remember">
            <a href="../registro/registro.php" class="header__menu__link">Registrarse</a>
            <a href="../recuperar/recuperar.php" class="header__menu__link">¿Has olvidado tu contraseña?</a>
        </div>

        <input type="submit" class="btn-1" value="iniciar">


    </form>
    
</body>
</html>