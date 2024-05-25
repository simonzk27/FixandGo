<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones On Live</title>
    <link rel="stylesheet" type="text/css" href="../css/styleLive.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-section">
        <img src="../img/fixandgo.png" alt="Logo" class="logo">
        <h1>Fix and Go</h1>
        </div>
        <nav>
            <ul class="left-side">
                <li><a href="../index.php" class="btn-header">Inicio</a></li>
                <li><a href="Repair_Now.php" class="btn-header">Repair Now </a></li>
                <li><a href="foro.php" class="btn-header">Foro</a></li>
                <li><a href="live.php" class="btn-header">Live</a></li>
                <li><a href="encuentros.php" class="btn-header">Encuentros</a></li>

            </ul>
            <ul class="right-side">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="user-info"><a class="welcome-msg">Bienvenido, <?php echo $_SESSION['username']; ?></a></li>
                    <li class="user-info"><a href="logout.php" class="btn-header">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="user-info"><a href="register.php" class="btn-header">Registrarse</a></li>
                    <li class="user-info"><a href="login.php" class="btn-header">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<main class="main"> <!-- Añade la clase .main aquí -->
<?php

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role']; // Obtenemos el rol del usuario
} else {
    $role = 'guest'; // Asignamos un rol predeterminado para los usuarios no autenticados
}
if ($role == 'admin' || $role == 'owner') {
    // Mostrar el formulario para crear un directo
    echo '<form method="post">
            <input type="text" name="youtube_link" placeholder="Ingresa el enlace de YouTube aquí">
            <input type="submit" name="create_live" value="Crear directo">
          </form>';

          if (isset($_POST['create_live'])) {
            $youtube_link = $_POST['youtube_link']; 
            $video_id = substr($youtube_link, strrpos($youtube_link, '/') + 1); // Extraer el ID del video de YouTube del enlace
            echo '<iframe width="560" height="315" src="' . $youtube_link . '" frameborder="0" allowfullscreen></iframe>';
            echo '<iframe src="https://www.youtube.com/live_chat?v=' . $video_id . '&embed_domain=' . $_SERVER['SERVER_NAME'] . '" width="560" height="315"></iframe>'; // Mostrar el chat de YouTube
          }// Guardar el enlace de YouTube en una variable
        } else if ($role == 'user' || $role == 'guest') {
            if (isset($youtube_link)) {
                // Mostrar el directo
                echo '<iframe width="560" height="315" src="' . $youtube_link . '" frameborder="0" allowfullscreen></iframe>';
                echo '<iframe src="https://www.youtube.com/live_chat?v=' . $video_id . '&embed_domain=' . $_SERVER['SERVER_NAME'] . '" width="560" height="315"></iframe>'; // Mostrar el chat de YouTube
            } else {
                // Mostrar el recuadro negro de YouTube que dice "offline"
                echo '<iframe width="560" height="315" src="https://www.youtube.com/embed?status=offline" frameborder="0" allowfullscreen></iframe>';
            }
        } 

?>
</main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fix and Go</p>
            <ul>
                <li><a href="#">Aviso legal</a></li>
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
