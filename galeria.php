<?php
require_once 'php/config/conexion.php';
require_once 'php/controllers/galeria.php';
// $fotos = todas las fotos de galería desde la BD (ver controller abajo)
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería - Club Elevé</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/componentes.css">
</head>
<body>

  <?php include 'php/includes/header.php'; ?>

  <section class="galeria">
    <h1 class="galeria__titulo">Galería Club Elevé</h1>
    <p class="galeria__subtitulo">Momentos de superación, entrenamiento y competencia</p>

    <div class="galeria__grid">
      <?php foreach ($fotos as $foto): ?>
        <button class="galeria__item" data-src="img/galeria/<?= htmlspecialchars($foto['archivo']) ?>"
                aria-label="Ampliar foto: <?= htmlspecialchars($foto['descripcion']) ?>">
          <img src="img/galeria/<?= htmlspecialchars($foto['archivo']) ?>"
               alt="<?= htmlspecialchars($foto['descripcion']) ?>">
          <span class="galeria__item-label"><?= htmlspecialchars($foto['descripcion']) ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LIGHTBOX -->
  <div class="lightbox" id="lightbox" hidden>
    <button class="lightbox__cerrar" aria-label="Cerrar imagen ampliada">✕</button>
    <img class="lightbox__imagen" src="" alt="">
  </div>

  <?php include 'php/includes/footer.php'; ?>

  <nav class="nav-inferior">
    <a href="index.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Inicio</span>
    </a>
    <a href="atletas.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Atletas</span>
    </a>
    <a href="eventos.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Eventos</span>
    </a>
    <a href="galeria.php" class="nav-inferior__item nav-inferior__item--activo" aria-current="page">
      <i class="nav-inferior__icono nav-inferior__icono--relleno" aria-hidden="true"></i>
      <span>Galería</span>
    </a>
  </nav>

  <script src="js/main.js"></script>
  <script src="js/carrusel.js"></script>
</body>
</html>