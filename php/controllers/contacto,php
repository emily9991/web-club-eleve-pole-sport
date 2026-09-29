<?php
require_once __DIR__ . '/../mailer/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../mailer/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../mailer/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function procesarContacto($datos, $pdo) {
    $errores = [];
    $exito = false;

    $nombre = trim($datos['nombre'] ?? '');
    $email = trim($datos['email'] ?? '');
    $telefono = trim($datos['telefono'] ?? '');
    $mensaje = trim($datos['mensaje'] ?? '');

    // Validación en servidor (nunca confiar solo en la del navegador/JS)
    if (empty($nombre)) $errores[] = 'El nombre es obligatorio.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingresa un correo electrónico válido.';
    }
    if (empty($mensaje)) $errores[] = 'El mensaje no puede estar vacío.';

    if (!empty($errores)) {
        return ['errores' => $errores, 'exito' => false];
    }

    // Guardar en la base de datos primero (aunque falle el correo, no perdemos el contacto)
    $stmt = $pdo->prepare(
        "INSERT INTO contactos (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$nombre, $email, $telefono, $mensaje]);
    $contactoId = $pdo->lastInsertId();

    // Enviar correo con PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';           // o el que use GoDaddy
        $mail->SMTPAuth = true;
        $mail->Username = 'notificaciones@clubeleve.com.co';
        $mail->Password = getenv('MAIL_PASSWORD'); // nunca hardcodear la clave aquí
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('notificaciones@clubeleve.com.co', 'Club Elevé - Web');
        $mail->addAddress('contacto@clubeleve.com.co');
        $mail->addReplyTo($email, $nombre);

        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto: $nombre";
        $mail->Body = "
            <strong>Nombre:</strong> " . htmlspecialchars($nombre) . "<br>
            <strong>Email:</strong> " . htmlspecialchars($email) . "<br>
            <strong>Teléfono:</strong> " . htmlspecialchars($telefono ?: 'No proporcionado') . "<br>
            <strong>Mensaje:</strong><br>" . nl2br(htmlspecialchars($mensaje));

        $mail->send();

        $pdo->prepare("UPDATE contactos SET enviado_correo = 1 WHERE id = ?")->execute([$contactoId]);
        $exito = true;

    } catch (Exception $e) {
        // El mensaje ya quedó guardado en la BD aunque el correo falle
        $errores[] = 'Tu mensaje se guardó, pero hubo un problema enviando la notificación por correo.';
    }

    return ['errores' => $errores, 'exito' => $exito];
}
