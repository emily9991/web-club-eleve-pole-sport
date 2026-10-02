<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../mailer/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../mailer/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../mailer/PHPMailer/src/SMTP.php';

/**
 * Valida el formulario, guarda el mensaje en la base y envía el correo.
 * Devuelve ['errores' => [...], 'exito' => true|false]
 */
function procesarContacto(array $datos, PDO $pdo): array
{
    $nombre   = trim($datos['nombre'] ?? '');
    $email    = trim($datos['email'] ?? '');
    $telefono = trim($datos['telefono'] ?? '');
    $mensaje  = trim($datos['mensaje'] ?? '');

    // ---------- Validación ----------
    $errores = [];

    if ($nombre === '') {
        $errores[] = 'Escribe tu nombre.';
    } elseif (mb_strlen($nombre) > 100) {
        $errores[] = 'El nombre no puede superar los 100 caracteres.';
    }

    if ($email === '') {
        $errores[] = 'Escribe tu correo electrónico.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $errores[] = 'El correo electrónico no es válido.';
    }

    if ($telefono !== '' && !preg_match('/^[0-9+\-\s()]{7,20}$/', $telefono)) {
        $errores[] = 'El teléfono no es válido. Usa solo números, espacios y el signo +.';
    }

    if ($mensaje === '') {
        $errores[] = 'Escribe tu mensaje.';
    } elseif (mb_strlen($mensaje) < 10) {
        $errores[] = 'El mensaje es muy corto (mínimo 10 caracteres).';
    } elseif (mb_strlen($mensaje) > 2000) {
        $errores[] = 'El mensaje no puede superar los 2000 caracteres.';
    }

    if (!empty($errores)) {
        return ['errores' => $errores, 'exito' => false];
    }

    // ---------- Guardar en la base de datos ----------
    try {
        $stmt = $pdo->prepare(
            "INSERT INTO contactos (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$nombre, $email, ($telefono === '' ? null : $telefono), $mensaje]);
        $idContacto = (int) $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log('Contacto: error al guardar - ' . $e->getMessage());
        return [
            'errores' => ['No pudimos guardar tu mensaje. Intenta de nuevo más tarde.'],
            'exito'   => false,
        ];
    }

    // ---------- Enviar correo ----------
    // Si el correo falla, el mensaje ya quedó guardado (enviado_correo = 0)
    if (enviarCorreoContacto($nombre, $email, $telefono, $mensaje)) {
        try {
            $pdo->prepare("UPDATE contactos SET enviado_correo = 1 WHERE id = ?")
                ->execute([$idContacto]);
        } catch (PDOException $e) {
            error_log('Contacto: error al marcar el envío - ' . $e->getMessage());
        }
    }

    return ['errores' => [], 'exito' => true];
}

/**
 * Envía el mensaje al correo del club con PHPMailer.
 * Los datos SMTP salen de php/config/correo.php (no se sube a Git).
 */
function enviarCorreoContacto(string $nombre, string $email, string $telefono, string $mensaje): bool
{
    $ruta = __DIR__ . '/../config/correo.php';
    if (!file_exists($ruta)) {
        error_log('Contacto: falta php/config/correo.php');
        return false;
    }
    $cfg = require $ruta;

    // Evita que saltos de línea en el nombre inyecten encabezados
    $nombreSeguro = preg_replace('/[\r\n]+/', ' ', $nombre);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $cfg['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $cfg['usuario'];
        $mail->Password   = $cfg['clave'];
        $mail->Port       = (int) $cfg['puerto'];
        $mail->SMTPSecure = ($mail->Port === 465)
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Timeout    = 10;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom($cfg['usuario'], 'Club Elevé - Formulario web');
        $mail->addAddress($cfg['destino'] ?? $cfg['usuario']);
        $mail->addReplyTo($email, $nombreSeguro);

        $mail->isHTML(false);
        $mail->Subject = 'Nuevo mensaje de contacto: ' . $nombreSeguro;
        $mail->Body    = "Nombre: $nombreSeguro\n"
                       . "Correo: $email\n"
                       . "Teléfono: " . ($telefono !== '' ? $telefono : 'No indicado') . "\n\n"
                       . "Mensaje:\n$mensaje\n";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Contacto: error de PHPMailer - ' . $mail->ErrorInfo);
        return false;
    }
}