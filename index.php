<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Elevé - Pole Sport Colombia</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/componentes.css">
</head>
<body>

  <?php include 'php/includes/header.php'; ?>

  <!-- HERO -->
  <section class="hero">
    <div class="hero__overlay"></div>
    <div class="hero__contenido">
      <h1 class="hero__titulo">Club Elevé</h1>
      <p class="hero__subtitulo">Pole Sport Colombia</p>
      <div class="hero__botones">
        <a href="atletas.php" class="hero__cta">VER ATLETAS</a>
        <a href="eventos.php" class="hero__cta hero__cta--outline">VER EVENTOS</a>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="stats">
    <div class="stats__item">
      <span class="stats__numero">50+</span>
      <span class="stats__label">Atletas</span>
    </div>
    <div class="stats__item">
      <span class="stats__numero">5</span>
      <span class="stats__label">Años</span>
    </div>
    <div class="stats__item">
      <span class="stats__numero">20+</span>
      <span class="stats__label">Eventos</span>
    </div>
  </section>

  <!-- ATLETAS DESTACADOS -->
  <section class="atletas-preview">
    <h2 class="atletas-preview__titulo">Atletas destacados</h2>
    <div class="atletas-preview__carrusel">

      <div class="card-atleta">
        <img src="img/atletas/atleta-nombre.jpg" alt="" class="card-atleta__foto">
        <h3 class="card-atleta__nombre">Nombre Atleta</h3>
        <span class="card-atleta__badge">Activo</span>
      </div>
      <!-- repetir .card-atleta para cada atleta destacado -->

    </div>
    <a href="atletas.php" class="atletas-preview__link">Ver todos los atletas</a>
  </section>

  <!-- EVENTOS -->
  <section class="eventos-preview">
    <h2 class="eventos-preview__titulo">Próximos eventos</h2>
    <div class="eventos-preview__lista">

      <div class="card-evento">
        <span class="card-evento__fecha">DD/MM</span>
        <h3 class="card-evento__nombre">Nombre del evento</h3>
        <span class="card-evento__badge card-evento__badge--info">Inscripciones abiertas</span>
      </div>
      <!-- repetir .card-evento -->

    </div>
    <a href="eventos.php" class="eventos-preview__link">Ver todos los eventos</a>
  </section>

  <!-- GALERÍA -->
  <section class="galeria-preview">
    <h2 class="galeria-preview__titulo">Galería</h2>
    <div class="galeria-preview__grid">
      <img src="img/galeria/galeria-01.jpg" alt="" class="galeria-preview__item">
      <!-- repetir .galeria-preview__item -->
    </div>
    <a href="galeria.php" class="galeria-preview__link">Ver galería completa</a>
  </section>

  <?php include 'php/includes/footer.php'; ?>

  <!-- NAV INFERIOR -->
  <nav class="nav-inferior">
    <a href="index.php" class="nav-inferior__item nav-inferior__item--activo">
      <i class="nav-inferior__icono nav-inferior__icono--relleno"></i>
      <span>Inicio</span>
    </a>
    <a href="atletas.php" class="nav-inferior__item">
      <i class="nav-inferior__icono"></i>
      <span>Atletas</span>
    </a>
    <a href="eventos.php" class="nav-inferior__item">
      <i class="nav-inferior__icono"></i>
      <span>Eventos</span>
    </a>
    <a href="galeria.php" class="nav-inferior__item">
      <i class="nav-inferior__icono"></i>
      <span>Galería</span>
    </a>
  </nav>

  <script src="js/main.js"></script>
</body>
</html>