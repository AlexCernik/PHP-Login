<?php
// Base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_store";

// Conectamos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificamos la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtenemos los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM user WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Verificamos si se encontró el usuario
if ($result->num_rows == 1) {
    // Inicio de sesión exitoso
    echo "Inicio de sesión exitoso";
} else {
    // Inicio de sesión fallido
    echo "Inicio de sesión fallido. Usuario o contraseña incorrectos.";
}

// Cerramos la conexión
$stmt->close();
$conn->close();
?>
