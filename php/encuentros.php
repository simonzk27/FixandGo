<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-section">
            <img src="img/fixandgo.png" alt="Logo" class="logo">
            <h1>Fix and Go</h1>
        </div>
        <nav>
            <ul class="left-side">
                <li><a href="index.php" class="btn-header">Inicio</a></li>
                <li><a href="php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                <li><a href="php/foro.php" class="btn-header">Foro</a></li>
                <li><a href="php/live.php" class="btn-header">Live</a></li>
                <li><a href="php/encuentros.php" class="btn-header">Encuentros</a></li>

            </ul>
            <ul class="right-side">
                <?php if ($_SESSION['loggedIn'] === true): ?> 
                    <li class="user-info"><a class="welcome-msg">Bienvenido, <?php echo $_SESSION['username']; ?></a></li>
                    <li class="user-info"><a href="php/logout.php" class="btn-header">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="user-info"><a href="php/register.php" class="btn-header">Registrarse</a></li>
                    <li class="user-info"><a href="php/login.php" class="btn-header">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main>
    
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