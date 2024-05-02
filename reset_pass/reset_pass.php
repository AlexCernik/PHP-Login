<?php
// Verifica si se ha enviado el formulario de restablecimiento de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se han enviado el correo electrónico, el token y la nueva contraseña
    if (isset($_POST["email"]) && isset($_POST["token"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $token = $_POST["token"];
        $new_password = $_POST["password"];

        // Verifica si el token y el correo electrónico coinciden en la base de datos
        // Aquí deberías tener una lógica similar a la que usaste para el envío del correo
        // Supongamos que el token y el correo electrónico coinciden
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        // Actualiza la contraseña en la base de datos
        // Suponiendo que la tabla de usuarios se llama 'usuarios' y el campo de contraseña se llama 'password'
        $servername = "localhost"; // Cambia 'localhost' si tu servidor de base de datos tiene un nombre diferente
        $username = "tu_usuario";
        $password = "tu_contraseña";
        $dbname = "tu_base_de_datos";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE usuarios SET password = '$password_hash' WHERE email = '$email'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Contraseña actualizada correctamente.";
        } else {
            echo "Error al actualizar la contraseña: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Datos incompletos.";
    }
}
?>
