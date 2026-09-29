<?php
require_once 'php/config/conexion.php';
require_once 'php/controllers/eventos.php';
// $eventos = todos los eventos desde la BD (ver controller abajo)
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventos - Club Elevé</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/componentes.css">
</head>
<body>

  <?php include 'php/includes/header.php'; ?>

  <section class="eventos">
    <h1 class="eventos__titulo">Próximos Eventos</h1>
    <p class="eventos__subtitulo">Torneos, talleres y clasificatorios</p>

    <div class="eventos__lista">
      <?php foreach ($eventos as $evento): ?>
        <div class="card-evento">
          <div class="card-evento__etiquetas">
            <?php if ($evento['inscripciones_abiertas']): ?>
              <span class="card-evento__badge card-evento__badge--info">✓ Inscripciones abiertas</span>
            <?php endif; ?>
            <span class="card-evento__tipo">
              <?= htmlspecialchars($evento['tipo']) ?>
              <!-- ej: "Nacional", "Masterclass", "Torneo Abierto" -->
            </span>
          </div>

          <h3 class="card-evento__nombre"><?= htmlspecialchars($evento['nombre']) ?></h3>
          <p class="card-evento__descripcion"><?= htmlspecialchars($evento['descripcion']) ?></p>

          <div class="card-evento__meta">
            <span class="card-evento__fecha">📅 <?= htmlspecialchars($evento['fecha_texto']) ?></span>
            <span class="card-evento__lugar">📍 <?= htmlspecialchars($evento['lugar']) ?></span>
          </div>
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
    <a href="atletas.php" class="nav-inferior__item">
      <i class="nav-inferior__icono" aria-hidden="true"></i>
      <span>Atletas</span>
    </a>
    <a href="eventos.php" class="nav-inferior__item nav-inferior__item--activo" aria-current="page">
      <i class="nav-inferior__icono nav-inferior__icono--relleno" aria-hidden="true"></i>
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