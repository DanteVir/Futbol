<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if ($results !== false && !empty($results)) {
        $user = $results;
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>FutbolStats</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<?php if(!empty($user)): ?>
    <br> Welcome. <?= $user['email']; ?>
<!-- partial:index.partial.html -->
<div class="container">
    <header class="header">
        <a href="./index.html" class="header__logo">FutbolStats</a>
        <nav class="header__menu">
            <ul class="header__menu__list">
                <li class="header__menu__item"><a href="../calendario/calendario.html"class="header__menu__link">Calendario</a></li>
                <li class="header__menu__item"><a href="../estadisticas/goles.html" class="header__menu__link">Estadisticas</a></li>
                <li class="header__menu__item"><a href="../equipos/equipos.html" class="header__menu__link">Equipos</a></li>        
                <li class="header__menu__item"><a href="../login/iniciarsesion.html" class="header__menu__link">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <!-- Container for all sliders, and pagination -->
    <main class="sliders-container">
        <!-- Here will be injected sliders for images, numbers, titles and links -->

        <!-- Simple pagination for the slider -->
        <ul class="pagination">
            <li class="pagination__item"><a class="pagination__button"></a></li>
            <li class="pagination__item"><a class="pagination__button"></a></li>
            <li class="pagination__item"><a class="pagination__button"></a></li>
            <li class="pagination__item"><a class="pagination__button"></a></li>
        </ul>
    </main>
  
  <!-- El contenido principal de la página -->
  <main>
    <!-- ... -->
  </main>
    </div>

    <footer class="footer">
      <div class="footer-content">
          <div class="footer-section about">
              <h2>FutbolStats</h2>
              <p>Descubre las historias y resultados de cada partido en nuestra pagina. Sigue a tu equipo favorito y únete a esta comunidad</p>
          </div>
          <div class="footer-section links">
              <h2>Links Rápidos</h2>
              <ul>
                  <li><a href="./index.html">Inicio</a></li>
                  <li><a href="../calendario/calendario.html">Calendario</a></li>
                  <li><a href="../estadisticas/goles.html">Estadísticas</a></li>
                  <li><a href="../equipos/equipos.html">Equipos</a></li>
                  <li><a href="../login/iniciarsesion.html">Inciar Sesión</a></li>
              </ul>
          </div>
          <div class="footer-section contact-form">
              <h2>Contacto</h2>
              <form action="#" method="post">
                  <input type="email" name="email" placeholder="Tu correo" required>
                  <textarea name="message" rows="4" placeholder="Tu mensaje" required></textarea>
                  <button type="submit">Enviar</button>
              </form>
          </div>
      </div>
      <div class="footer-bottom">
          &copy; 2024 FutbolStats | Diseñado por Mario
      </div>
  </footer>

</div>
<?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="../login/iniciarsesion.php">Login</a> or
      <a href="../registro/registro.php">SignUp</a>
    <?php endif; ?>
<!-- partial -->
  <script src='https://rawgit.com/lmgonzalves/momentum-slider/master/dist/momentum-slider.min.js'></script><script  src="./script.js"></script>
</body>
</html>
