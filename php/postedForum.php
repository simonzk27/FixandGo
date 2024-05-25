<?php
session_start(); 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';

// Consulta para obtener todos los forums
$stmt = $conn->prepare("SELECT * FROM Forums");
$stmt->execute();
$result = $stmt->get_result();
$forums = $result->fetch_all(MYSQLI_ASSOC);
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
    <?php

        // Obtén el ID del forum de la URL
        $id = $_GET['id'];

        // Consulta para obtener el forum
        $stmt = $conn->prepare("SELECT * FROM Blogs WHERE id = ?");
        $stmt->execute([$id]);
        $forum = $stmt->fetch();

        // Muestra el forum
        echo '<h1>' . $forum['title'] . '</h1>';
        echo '<p>' . $forum['theme'] . '</p>';
        echo '<div>' . $forum['content'] . '</div>';

        // Formulario para comentar
        echo '<form action="comentar.php" method="post">';
        echo '<input type="hidden" name="blog_id" value="' . $id . '">';
        echo '<textarea name="comentario" required></textarea>';
        echo '<input type="submit" value="Comentar">';
        echo '</form>';
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