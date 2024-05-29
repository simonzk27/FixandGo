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
            <?php
            include 'connect.php';

            $results = [];
            if (isset($_GET['search'])) {
                // Consulta de búsqueda
                $search = $_GET['search'];
                $stmt = $conn->prepare("SELECT * FROM Repairs WHERE title LIKE ?");
                $stmt->execute(["%$search%"]);
                $result = $stmt->get_result();
                $results = $result->fetch_all(MYSQLI_ASSOC);
            }
            ?>

            <div class="search-bar">
                <form action="" method="get">
                    <input type="text" name="search" placeholder="Buscar..." required>
                </form>
                <?php
                // Muestra los resultados
                foreach ($results as $result) {
                    echo '<div class="search-result">';
                    echo '<a href="' . $result['url'] . '">' . $result['title'] . '</a>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="card-container">
                <?php
                include 'connect.php';

                $result = $conn->query("SELECT id, title, url, authors_id, upload_date, image_url, descripcion, rating, votes FROM Repairs");
                
                if ($result->num_rows > 0) {
                    // Iterar sobre las guias y generar una tarjeta para cada una
                    while($row = $result->fetch_assoc()) {
                        $rating = $row['rating'] / $row['votes'];
                        $chartId = 'chartContainer' . $row['id'];  
                        echo '<div class="card transition">';
                        echo '<a href="'.$row['url'].'" class="card-link">';
                        echo '<div class="card_circle transition" style="background-image: url(\''.$row['image_url'].'\');"></div>';
                        echo '<h2 class="transition">'.$row['title'].'</h2>';
                        echo '<p>'.$row['descripcion'].'</p>';
                        
                        echo '<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>';
                        echo '<script>';
                        echo 'document.addEventListener(\'DOMContentLoaded\', function () {';
                        echo 'var rating = '.$rating.';';
                        echo 'var dataPoints = [{ y: rating, label: "Fue útil", color: "green" }, { y: 100 - rating, label: "No fue útil", color: "red" }];';
                        echo 'var chart = new CanvasJS.Chart("'.$chartId.'", {';  
                        echo 'animationEnabled: true,';
                        echo 'data: [{';
                        echo 'type: "pie",';
                        echo 'startAngle: 240,';
                        echo 'yValueFormatString: "##0.00\"%\"",';
                        echo 'indexLabel: "{label} {y}",';
                        echo 'dataPoints: dataPoints';
                        echo '}]';
                        echo '});';
                        echo 'chart.render();';
                        echo '});';
                        echo '</script>';
                        echo '<div id="'.$chartId.'" style="height: 370px; width: 100%;"></div>';  
                    
                        echo '</a>';
                        echo '</div>';
                        
                    }
                } else {
                    echo "No se encontraron guias-taller.";
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