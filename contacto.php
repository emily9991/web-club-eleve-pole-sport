<?php
require_once 'php/config/conexion.php';

$errores = [];
$exito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'php/controllers/contacto.php';
    $resultado = procesarContacto($_POST, $pdo);
    $errores = $resultado['errores'];
    $exito = $resultado['exito'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto - Club Elevé</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/componentes.css">
</head>
<body>

  <?php include 'php/includes/header.php'; ?>

  <section class="contacto">
    <h1 class="contacto__titulo">Contáctanos</h1>
    <p class="contacto__subtitulo">¿Listo para entrenar con nosotros? Escríbenos.</p>

    <?php if ($exito): ?>
      <p class="contacto__mensaje contacto__mensaje--exito" role="status">
        ✓ ¡Mensaje enviado! Te contactaremos pronto.
      </p>
    <?php endif; ?>

    <?php if (!empty($errores)): ?>
      <div class="contacto__mensaje contacto__mensaje--error" role="alert" aria-live="polite">
        <ul>
          <?php foreach ($errores as $error): ?>
            <li>✗ <?=