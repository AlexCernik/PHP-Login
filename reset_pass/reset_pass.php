<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si se ha enviado el formulario de restablecimiento de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se han enviado el correo electrónico, el token y la nueva contraseña
    if (isset($_POST["email"]) && isset($_POST["token"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $token = $_POST["token"];
        $new_password = $_POST["password"];

        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);


        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE user SET password = '$password_hash' WHERE email = '$email'";
        
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
