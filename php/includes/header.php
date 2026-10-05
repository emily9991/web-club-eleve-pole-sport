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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

  <!-- Orden importa: variables primero -->
  <link href="css/variables.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">
  <link href="css/componentes.css" rel="stylesheet">
</head>
<body>

  <header class="encabezado">
    <a class="encabezado__logo" href="index.php" aria-label="Club Elevé, ir al inicio">
      <img src="img/general/Logo_Eleve.png" alt="Club Elevé" class="encabezado__logo-img">
    </a>


    <a class="encabezado__icono" href="eventos.php" aria-label="Ver próximos eventos">
      <i class="bi bi-bell" aria-hidden="true"></i>
    </a>

    <button class="encabezado__icono encabezado__menu-btn" type="button"
            aria-label="Abrir menú" aria-expanded="false" aria-controls="menu-panel">
      <i class="bi bi-list" aria-hidden="true"></i>
    </button>

    <nav id="menu-panel" class="menu-panel" aria-label="Menú secundario" hidden>
      <a href="index.php">Sobre el club</a>
      <a href="contacto.php">Contacto</a>
    </nav>
  </header>

  <main id="contenido"></main>