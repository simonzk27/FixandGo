<?php
require_once 'vendor/autoload.php';

function generateConfirmationCode() {
    // Genera un código de confirmación de 6 dígitos
    return rand(100000, 999999);
}

include 'connect.php';

$showConfirmationForm = false;
$confirmationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmation_code'])) {
        // Verificar el código de confirmación
        session_start();
        if ($_POST['confirmation_code'] == $_SESSION['confirmation_code']) {
            // Código correcto, insertar el usuario en la base de datos
            $stmt = $conn->prepare("INSERT INTO Users (username, password, email, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $_SESSION['username'], $_SESSION['password'], $_SESSION['email'], $_SESSION['first_name'], $_SESSION['last_name']);
            $stmt->execute();
            $message = "Usuario registrado exitosamente.";
            $confirmationSuccess = true;
            session_destroy();
        } else {
            // Código incorrecto
            $message = "Código de confirmación incorrecto.";
            $showConfirmationForm = true;
        }
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $nombre = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $apellido = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Comprobar si el nombre de usuario o el correo electrónico ya existen
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "El nombre de usuario o el correo electrónico ya están en uso.";
        } else {
            // Usuario registrado exitosamente, mostrar HTML de confirmación
            $confirmationCode = generateConfirmationCode();
            $subject = "Confirmación de registro";
            $messageMail = "Gracias por registrarte. Tu código de confirmación es: $confirmationCode";
            $message = "Gracias por registrarte. Ingresa el codigo de verificacion enviado a tu direccion de correo electronico.";

            // Crear el Transporte
            $transport = (new Swift_SmtpTransport('smtp.hostinger.com', 587))
                ->setUsername('support@fixandgo.site')
                ->setPassword('Fixandgosupport2024*');

            // Crear el Mailer usando el Transporte creado
            $mailer = new Swift_Mailer($transport);

            // Crear un mensaje
            $messageMail = (new Swift_Message($subject))
                ->setFrom(['support@fixandgo.site' => 'fixandgo'])
                ->setTo([$email])
                ->setBody($messageMail);

            // Enviar el mensaje
            $mailer->send($messageMail);

            // Guardar los datos del usuario y el código de confirmación en la sesión
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $nombre;
            $_SESSION['last_name'] = $apellido;
            $_SESSION['confirmation_code'] = $confirmationCode;

            $showConfirmationForm = true;
        }
    }
}

if ($confirmationSuccess) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/styleRegister.css">
</head>
<body>
    <div class="container">
        <?php if ($showConfirmationForm) { ?>
        <div class="container">
            <div class="card">
                <form action="../php/register.php" id="confirmationForm" method="POST">
                    <h2 class="singup">Confirmacion</h2>
                    <div class="inputBox">
                        <input type="number" id="confirmation_code" name="confirmation_code" required>
                        <span>Codigo</span>
                    </div>
                    <br>
                    <button type="submit" class="enter">Confirmar</button>
                </form>
		<?php if (isset($message)) { ?>
    			<div class="message">
        			<h2><?php echo $message; ?></h2>
    			</div>
    		<?php } ?>
            </div>
        </div>
        <?php } else { ?>
        <form action="../php/register.php" id="registerForm" method="POST">
            <div class="card">
                <a class="singup">Unete a nosotros!</a>

                <div class="inputBox">
                    <input type="text" required="required" id="username" name="username">
                    <span>Usuario</span>
                </div>

                <div class="inputBox">
                    <input type="text" required="required" id="first_name" name="first_name">
                    <span>Nombre</span>
                </div>

                <div class="inputBox">
                    <input type="text" required="required" id="last_name" name="last_name">
                    <span>Apellido</span>
                </div>

                <div class="inputBox1">
                    <input type="email" required="required" id="email" name="email">
                    <span class="user">Email</span>
                </div>

                <div class="inputBox">
                    <input type="password" required="required" id="password" name="password">
                    <span>Password</span>
                </div>

                <button class="enter" type="submit">Registrarse</button>
            </div>
        </form>
        <?php } ?>
    </div> 
</body>
</html>