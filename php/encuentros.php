<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones presenciales</title>
    <link rel="stylesheet" type="text/css" href="../css/styleEncuentros.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
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

<main>

<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    $sql = "INSERT INTO meetings (title, description, date, location) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $date, $location);

    if ($stmt->execute()) {
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role']; // Obtenemos el rol del usuario
} else {
    $role = 'guest'; // Asignamos un rol predeterminado para los usuarios no autenticados
}

if ($role == 'admin' || $role == 'owner') {
    // Mostrar el formulario para crear un encuentro
    echo '<form method="post">
    <div style="display: flex; justify-content: space-between;">
    <div style="display: flex; flex-direction: column; align-items: flex-start; width: 50%;">
        <label for="title">Titulo:</label>
        <input type="text" id="title" name="title" style="width: 200px; height: 30px; margin-bottom: 10px;">
        <label for="description">Descripcion:</label>
        <input type="text" id="description" name="description" style="width: 200px; height: 30px; margin-bottom: 10px;">
        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" style="width: 200px; height: 30px; margin-bottom: 10px;">
        <label for="location">Ubicacion:</label>
        <input type="hidden" id="location" name="location">
        <input type="submit" value="Crear encuentro" style="width: 200px; height: 40px;">
    </div>
    <div id="map" style="width: 400px; height: 300px;"></div>
</div>
    <script>
        mapboxgl.accessToken = "pk.eyJ1IjoiZml4YW5kZ28iLCJhIjoiY2x3bXh2Z2U1MHVpbTJqbWo5cnR6MnBrMiJ9.r9FK66ArVUcn8sYbc4PLrA";
        var map = new mapboxgl.Map({
            container: "map",
            style: "mapbox://styles/mapbox/streets-v12",
            center: [-74.06581442603229, 4.632584654601695], // starting position [lng, lat]
            zoom: 9 // starting zoom 
        });

        // Crear un nuevo marcador
        const marker = new mapboxgl.Marker();  

        // Agregar un evento de clic al mapa
        map.on("click", function(e) {
            // Obtener las coordenadas del clic
            var coordinates = e.lngLat;

            // Configurar la posición del marcador con las coordenadas
            marker.setLngLat(coordinates).addTo(map);  

            document.getElementById("location").value = coordinates.lng + "," + coordinates.lat;
        });
        </script>

        <input type="submit" value="Crear encuentro" style="width: 200px; height: 40px;">
    </div>
    </form>';
} 
    echo '<div id="mapGen" style="width: 400px; height: 300px;""></div>
    <script>
        mapboxgl.accessToken = "pk.eyJ1IjoiZml4YW5kZ28iLCJhIjoiY2x3bXh2Z2U1MHVpbTJqbWo5cnR6MnBrMiJ9.r9FK66ArVUcn8sYbc4PLrA";
    var mapGen = new mapboxgl.Map({
        container: "mapGen",
        style: "mapbox://styles/mapbox/streets-v12",
        center: [-74.06581442603229, 4.632584654601695], // starting position [lng, lat]
        zoom: 9 // starting zoom 
    });
    </script>';

    // Cargar los encuentros disponibles
    $result = $conn->query("SELECT * FROM meetings");
    while($row = $result->fetch_assoc()) {
    // Agregar un marcador para la ubicación del encuentro
    echo "<script>
        new mapboxgl.Marker()
            .setLngLat([" . $row["location"] . "])
            .setPopup(new mapboxgl.Popup({ offset: 25 }) // agrega un popup
            .setHTML('<h3>" . $row["title"] . "</h3><p>" . $row["description"] . "</p><p>" . $row["date"] . "</p>')) // Aquí puedes poner la información que quieras mostrar
            .addTo(mapGen);
    </script>";
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