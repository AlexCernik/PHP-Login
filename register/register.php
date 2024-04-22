<?php
// Base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "project_store";

// Conectamos
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificamos la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtenemos los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$dni = $_POST['dni'];
$rol = $_POST['rol'];

// Consulta SQL para insertar los datos en la base de datos
$sql = "INSERT INTO user (username, password, name, last_name, dni, rol) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssis", $username, $password, $name, $last_name, $dni, $rol);
$result = $stmt->execute();

// Verificamos si la inserción fue exitosa
if ($result === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

// Cerramos la conexión
$stmt->close();
$conn->close();
?>
