<?php
session_start(); 
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

// Supongamos que la autenticación ya está implementada
$role = $_SESSION['role']; // Obtenemos el rol del usuario

if ($role == 'admin' || $role == 'owner') {
    // Mostrar el formulario para crear un directo
    echo '<form action="create_live.php" method="post">
            <input type="submit" value="Crear directo">
          </form>';
} else if (!($role == 'admin' || $role == 'owner')) {
    // Comprobar si hay directos en vivo
    $live = check_live(); // Supongamos que esta función comprueba si hay directos en vivo

    if ($live) {
        // Mostrar el directo
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $live . '" frameborder="0" allowfullscreen></iframe>';
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
