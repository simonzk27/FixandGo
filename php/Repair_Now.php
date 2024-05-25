<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fix and Go</title>
        <link rel="stylesheet" href="../css/styleRepairnow.css">
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
        <main>
            <div class="search-bar">
                <form action="" method="get">
                    <input type="text" name="search" placeholder="Buscar..." required>
                </form>
                <?php
                include 'connect.php';
                // Consulta de búsqueda
                $search = $_GET['search'];
                $stmt = $conn->prepare("SELECT * FROM Repairs WHERE title LIKE ?");
                $stmt->execute(["%$search%"]);
                $results = $stmt->fetchAll();

                // Muestra los resultados
                foreach ($results as $result) {
                    echo $result['title'] . '<br>';
                }
                ?>
            </div>
            <div class="card-container">
                <?php
                include 'connect.php';
                $result = $conn->query("SELECT id, title, url, authors_id, upload_date, image_url, descripcion FROM Repairs");

                if ($result->num_rows > 0) {
                    // Iterar sobre los resultados y generar una tarjeta para cada uno
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card transition">';
                        echo '<a href="'.$row['url'].'" class="card-link">';
                        echo '<div class="card_circle transition" style="background-image: url(\''.$row['image_url'].'\');"></div>';
                        echo '<h2 class="transition">'.$row['title'].'</h2>';
                        echo '<p>'.$row['descripcion'].'</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "No se encontraron resultados";
                }

                $conn->close();
                ?>
            </div>
            <?php if ($_SESSION['loggedIn'] === true): ?>
                <div class="button-container">
                    <button class="crear" onclick="location.href='createGuide.php'">Crear guía-taller</button>
                </div>
            <?php else: ?>
                <div class="button-container">
                    <p class="crear">Registrate o inicia sesión para crear guías taller</p>
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