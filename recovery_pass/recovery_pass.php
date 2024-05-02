<?php
// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el correo electrónico enviado desde el formulario
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user_exists) {
        // Genera un token único para el enlace de restablecimiento de contraseña (puedes usar esta lógica o la que prefieras)
        $token = md5(uniqid(rand(), true));

        // Enviar el correo electrónico de recuperación de contraseña
        $subject = "Recuperación de contraseña";
        $message = "Hola,\n\nHas solicitado restablecer tu contraseña. Por favor, haz clic en el siguiente enlace para crear una nueva contraseña:\n\n";
        $message .= "http://localhost/reset_password.php?email=$email&token=$token\n\n";
        $message .= "Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje.\n\nGracias.";
        $headers = "From: tuemail@tudominio.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Se ha enviado un correo electrónico de recuperación de contraseña.";
        } else {
            echo "Error al enviar el correo electrónico de recuperación de contraseña.";
        }
    } else {
        echo "El correo electrónico ingresado no existe en nuestra base de datos.";
    }
}
?>
