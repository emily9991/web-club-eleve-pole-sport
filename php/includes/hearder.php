<?php
// Variables que cada página define ANTES de incluir este archivo:
//   $titulo        -> título de la pestaña (opcional)
//   $pagina_activa -> 'inicio' | 'atletas' | 'eventos' | 'galeria' | 'contacto'
$titulo = $titulo ?? 'Club Elevé | Pole Sport Colombia';
$pagina_activa = $pagina_activa ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($titulo) ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Orden importa: variables primero -->
  <link href="css/variables.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">
  <link href="css/componentes.css" rel="stylesheet">
</head>
<body>
  <a class="salto-contenido" href="#contenido">Saltar al contenido</a>

  <header class="encabezado">
    <a class="encabezado__logo" href="index.php" aria-label="Club Elevé, ir al inicio">
      <img src="img/general/logo.png" alt="Club Elevé" class="encabezado__logo-img">
    </a>
  </header>

  <main id="contenido">