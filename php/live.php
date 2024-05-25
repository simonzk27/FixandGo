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

        include 'connect.php';

        // Obtener el enlace de YouTube de la base de datos
        $stmt = $conn->prepare("SELECT link FROM lives LIMIT 1");
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $youtube_link = $row['link'];
        }


        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role']; // Obtenemos el rol del usuario
        } else {
            $role = 'guest'; // Asignamos un rol predeterminado para los usuarios no autenticados
        }

        if ($role == 'admin' || $role == 'owner') {
        if (isset($_POST['youtube_link'])) {
            $new_youtube_link = $_POST['youtube_link']; 

            // Actualizar el enlace de YouTube en la base de datos
            $stmt = $conn->prepare("UPDATE link SET lives = ? WHERE id = 1");
            $stmt->bind_param("s", $new_youtube_link);
            if ($stmt->execute()) {
            echo "Link updated successfully";
            } else {
            echo "Error updating link: " . $stmt->error;
            }
        }
        } elseif ($role == 'user' || $role == 'guest') {
        // Mostrar el chat y el video
        echo "<div class='chat'>Chat content here</div>";
        echo "<div class='video'><iframe src='" . $youtube_link . "'></iframe></div>";
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
