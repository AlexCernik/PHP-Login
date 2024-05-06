<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_store";

$conn = new mysqli($servername, $username, $password, $dbname);

$message = "";

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];

    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Genera un token único para el enlace de restablecimiento de contraseña (puedes usar esta lógica o la que prefieras)
            $token = md5(uniqid(rand(), true));


            $subject = "Recuperación de contraseña";
            $message = "Hola,\n\nHas solicitado restablecer tu contraseña. Por favor, haz clic en el siguiente enlace para crear una nueva contraseña:\n\n";
            $message .= "http://localhost/reset_password.php?email=$email&token=$token\n\n"; // Cambia 'localhost' por tu dirección local si es diferente
            $message .= "Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje.\n\nGracias.";
            $headers = "From: tuemail@tudominio.com";

            if (mail($email, $subject, $message, $headers)) {
                $message = "Se ha enviado un correo electrónico de recuperación de contraseña.";
            } else {
                $message = "Error al enviar el correo electrónico de recuperación de contraseña.";
            }
        } else {
            $message = "El correo electrónico ingresado no existe en nuestra base de datos.";
        }
    } else {
        $message = "Error al conectar a la base de datos.";
    }
}
?>
