<?php
session_start(); 

include 'connect.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix and Go</title>
    <link rel="stylesheet" type="text/css" href="../css/stylePostedForum.css">
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
                <?php
                if ($_SESSION['role'] == 'owner') {
                ?>
                    <li><a href="../index.php" class="btn-header">Inicio</a></li>
                    <li><a href="../php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                    <li><a href="../php/foro.php" class="btn-header">Foro</a></li>
                    <li><a href="../php/live.php" class="btn-header">Live</a></li>
                    <li><a href="../php/encuentros.php" class="btn-header">Encuentros</a></li>
                    <li><a href="../php/administrar.php" class="btn-header">Administrar</a></li>
                <?php
                } else {
                ?>
                    <li><a href="../index.php" class="btn-header">Inicio</a></li>
                    <li><a href="../php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                    <li><a href="../php/foro.php" class="btn-header">Foro</a></li>
                    <li><a href="../php/live.php" class="btn-header">Live</a></li>
                    <li><a href="../php/encuentros.php" class="btn-header">Encuentros</a></li>
                <?php
                }
                ?>
            </ul>
                <ul class="right-side">
                    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
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
    <main>
    <?php

    // Obtén el ID del forum de la URL
    $id = $_GET['id'];

    // Verifica si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoge los datos del formulario
        $comentario = $_POST['comentario'];

        // Prepara la consulta SQL
        $stmt = $conn->prepare("INSERT INTO Comments (content, authors_id, forums_id) VALUES (?, ?, ?)");

        // Vincula los parámetros a la consulta
        $stmt->bind_param("sii", $comentario, $_SESSION['user_id'], $id);

        // Ejecuta la consulta
        $stmt->execute();
    }

    // Consulta para obtener el forum
    $stmt = $conn->prepare("SELECT * FROM Forums WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $forum = $result->fetch_assoc();

    // Muestra el forum
    echo '<main class="main-forum">';
    echo '<h1>' . $forum['title'] . '</h1>';
    echo '<p>' . $forum['theme'] . '</p>';
    echo '<div>' . $forum['content'] . '</div>';

    // Formulario para comentar
    echo '<form action="postedForum.php?id=' . $id . '" method="post">';
    echo '<textarea name="comentario" required></textarea>';
    echo '<input type="submit" value="Comentar">';
    echo '</form>';
    
    // Consulta para obtener los comentarios y sus autores
    $stmt = $conn->prepare("
        SELECT Comments.*, Users.username 
        FROM Comments 
        INNER JOIN Users ON Comments.authors_id = Users.id 
        WHERE Comments.forums_id = ? 
        ORDER BY Comments.upload_date DESC
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Muestra los comentarios
    while ($comment = $result->fetch_assoc()) {
        echo '<div>';
        echo '<p>' . $comment['content'] . '</p>';
        echo '<p>Publicado por ' . $comment['username'] . ' el ' . $comment['upload_date'] . '</p>';
        echo '</div>';
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