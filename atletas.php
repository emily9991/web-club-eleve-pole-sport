<?php
require_once 'php/config/conexion.php';
require_once 'php/controllers/atletas.php';
// $atletas = todos los atletas desde la BD (ver controller abajo)
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atletas - Club Elevé</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/componentes.css">
</head>
<body>

  <?php include 'php/includes/header.php'; ?>

  <section class="atletas">
    <h1 class="atletas__titulo">Nuestros Atletas</h1>
    <p class="atletas__subtitulo">Selección de alto rendimiento del club</p>

    <!-- FILTROS -->
    <div class="atletas__filtros" role="tablist" aria-label="Filtrar atletas por categoría">
      <button class="atletas__filtro atletas__filtro--activo" role="tab" aria-selected="true" data-categoria="todos">Todos</button>
      <button class="atletas__filtro" role="tab" aria-selected="false" data-categoria="elite">Élite</button>
      <button class="atletas__filtro" role="tab" aria-selected="false" data-categoria="juvenil">Juvenil</button>
      <button class="atletas__filtro" role="tab" aria-selected="false" data-categoria="instructores">Instructores</button>
    </div>

    <!-- GRID DE ATLETAS -->
    <div class="atletas__grid">
      <?php foreach ($atletas as $atleta): ?>
        <div class="card-atleta" data-categoria="<?= htmlspecialchars($atleta['categoria']) ?>">
          <img src="img/atletas/<?= htmlspecialchars($atleta['foto']) ?>"
               alt="<?= htmlspecialchars($atleta['nombre']) ?> practicando pole sport"
               class="card-atleta__foto">
          <span class="card-atleta__badge">✓ <?= htmlspecialchars($atleta['estado']) ?></span>
          <h3 class="card-atleta__nombre"><?= htmlspecialchars($atleta['nombre']) ?></h3>
          <p class="card-atleta__descripcion"><?= htmlspecialchars($atleta['descripcion']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php include 'php/includes/footer.php'; ?>

  <nav class="nav-inferior">
    <a href="index.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Inicio</span>
    </a>
    <a href="atletas.php" class="nav-inferior__item nav-inferior__item--activo" aria-current="page">
      <i class="nav-inferior__icono nav-inferior__icono--relleno" aria-hidden="true"></i>
      <span>Atletas</span>
    </a>
    <a href="eventos.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Eventos</span>
    </a>
    <a href="galeria.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Galería</span>
    </a>
  </nav>

  <script src="js/main.js"></script>
</body>
</html>