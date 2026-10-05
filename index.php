<?php
require_once __DIR__ . '/php/config/conexion.php';

function esc($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$atletas = [];
$eventos = [];
$galeria = [];

try {
    $atletas = $pdo->query(
        "SELECT id, nombre, foto, carpeta, estado FROM atletas WHERE destacado = 1 ORDER BY nombre ASC LIMIT 6"
    )->fetchAll(); 

    $eventos = $pdo->query(
        "SELECT nombre, fecha_texto, inscripciones_abiertas FROM eventos
         WHERE fecha_inicio >= CURDATE() ORDER BY fecha_inicio ASC LIMIT 3"
    )->fetchAll();

    $galeria = $pdo->query(
        "SELECT archivo, descripcion FROM galeria ORDER BY fecha DESC, id DESC LIMIT 6"
    )->fetchAll();
} catch (PDOException $e) {
    error_log('Inicio: error al cargar datos - ' . $e->getMessage());
}

$titulo = 'Club Elevé - Pole Sport Colombia';
$pagina_activa = 'inicio';
require __DIR__ . '/php/includes/header.php';
?>

  <!-- HERO -->
<div class="hero__contenido">
  <p class="hero__etiqueta">Club oficial de Pole Sport Colombia</p>
  <h1 class="hero__titulo">
    Elevá tu fuerza,
    <span class="hero__titulo-acento">supera tus límites</span>
  </h1>
  <p class="hero__subtitulo">
    La comunidad de atletas de pole sport de alto rendimiento en Colombia.
    Disciplina aérea, técnica y potencia.
  </p>
  <div class="hero__botones">
    <a href="atletas.php" class="hero__cta">
      VER ATLETAS
      <svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/></svg>
    </a>
    <a href="eventos.php" class="hero__cta hero__cta--outline">
      VER EVENTOS
      <svg viewBox="0 0 16 16" width="18" height="18" fill="currentColor" aria-hidden="true" focusable="false"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>
    </a>
  </div>
</div>

  <!-- STATS -->
  <section class="stats" aria-label="El club en cifras">
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
      <?php if (empty($atletas)): ?>
        <p class="atletas-preview__vacio">Pronto publicaremos a nuestros atletas destacados.</p>
      <?php endif; ?>
      <?php foreach ($atletas as $atleta): ?>
        <div class="card-atleta">
          <img src="img/atletas/<?= esc($atleta['foto']) ?>"
               alt="<?= esc($atleta['nombre']) ?>, atleta de pole sport"
               class="card-atleta__foto">
          <h3 class="card-atleta__nombre"><?= esc($atleta['nombre']) ?></h3>
          <span class="card-atleta__badge"><?= esc($atleta['estado']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <a href="atletas.php" class="atletas-preview__link">Ver todos los atletas</a>
  </section>

  <!-- EVENTOS -->
  <section class="eventos-preview">
    <h2 class="eventos-preview__titulo">Próximos eventos</h2>
    <div class="eventos-preview__lista">
      <?php if (empty($eventos)): ?>
        <p class="eventos-preview__vacio">No hay eventos programados por ahora.</p>
      <?php endif; ?>
      <?php foreach ($eventos as $evento): ?>
        <div class="card-evento">
          <span class="card-evento__fecha"><?= esc($evento['fecha_texto']) ?></span>
          <h3 class="card-evento__nombre"><?= esc($evento['nombre']) ?></h3>
          <?php if ($evento['inscripciones_abiertas']): ?>
            <span class="card-evento__badge card-evento__badge--info">Inscripciones abiertas</span>
          <?php else: ?>
            <span class="card-evento__badge card-evento__badge--cerrado">Inscripciones cerradas</span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <a href="eventos.php" class="eventos-preview__link">Ver todos los eventos</a>
  </section>

  <!-- GALERÍA -->
  <section class="galeria-preview">
    <h2 class="galeria-preview__titulo">Galería</h2>
    <div class="galeria-preview__grid">
      <?php if (empty($galeria)): ?>
        <p class="galeria-preview__vacio">Pronto subiremos nuevas fotos.</p>
      <?php endif; ?>
      <?php foreach ($galeria as $foto): ?>
        <img src="img/galeria/<?= esc($foto['archivo']) ?>"
             alt="<?= esc($foto['descripcion']) ?>"
             class="galeria-preview__item">
      <?php endforeach; ?>
    </div>
    <a href="galeria.php" class="galeria-preview__link">Ver galería completa</a>
  </section>

<?php require __DIR__ . '/php/includes/footer.php'; ?>
