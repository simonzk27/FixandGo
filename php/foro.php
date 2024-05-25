<?php
session_start(); 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';

// Consulta para obtener todos los blogs
$stmt = $conn->prepare("SELECT * FROM Blogs");
$stmt->execute();
$result = $stmt->get_result();
$blogs = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix and Go</title>
    <link rel="stylesheet" type="text/css" href="../css/styleForo.css">
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
                    <?php if ($_SESSION['loggedIn'] === true): ?>
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
    <h1>Bienvenido al Foro</h1>
    <main>
        <?php foreach ($blogs as $blog): ?>
            <div class="blog-post">
                <h2 class="blog-title">
                    <a href="blog.php?id=<?php echo $blog['id']; ?>">
                        <?php echo $blog['titulo']; ?>
                    </a>
                </h2>
                <p class="blog-tema"><?php echo $blog['tema']; ?></p>
            </div>
        <?php endforeach; ?>   
        <?php if ($_SESSION['loggedIn'] === true): ?>
            <div class="button-container">
                <button class="crear" onclick="location.href='createForum.php'">Escribe un foro</button>
            </div>
        <?php else: ?>
            <div class="button-container">
                <p class="crear">Registrate o inicia sesión para escribir foros</p>
            </div>
        <?php endif; ?>      
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