<?php

session_start(); // Iniciar la sesión

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();

  $result = $stmt->get_result();
  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      // Login correcto
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $username; 
      $_SESSION['loggedIn'] = true;
      $_SESSION['role'] = $user['role'];
      
      
      header("Location: ../index.php"); // volver a la página de inicio
      exit;
    } else {
      $loginError = "Contraseña incorrecta.";
    }
  } else {
    $loginError = "Username no encontrado.";
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesi�n</title>
    <link rel="stylesheet" href="../css/styleLogin.css">
</head>
<body>
    <div class="container">
        <form action="" id="loginForm" method="POST">
            <div class="card">
                <a class="singup">Bienvenidos</a>

                <div class="inputBox">
                    <input type="text" required="required" id="username" name="username">
                    <span>Usuario</span>
                </div>

                <div class="inputBox">
                    <input type="password" required="required" id="password" name="password">
                    <span>Password</span>
                </div>
                <?php if (isset($loginError)): ?>
                    <p class="error"><?php echo $loginError; ?></p>
                <?php endif; ?>
                <button class="enter" type="submit">Iniciar sesion</button>
            </div>
        </form>
    </div>
</body>
</html>