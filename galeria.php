<?php
require_once __DIR__ . '/php/config/conexion.php';
require_once __DIR__ . '/php/controllers/galeria.php';
// $fotos = todas las fotos de galería desde la BD

if (!function_exists('esc')) {
    function esc($valor)
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

$titulo = 'Galería | Club Elevé';
$pagina_activa = 'galeria';
$scripts_extra = ['js/carrusel.js'];
require __DIR__ . '/php/includes/header.php';
?>

  <section class="galeria">
    <h1 class="galeria__titulo">Galería Club Elevé</h1>
    <p class="galeria__subtitulo">Momentos de superación, entrenamiento y competencia</p>

    <div class="galeria__grid">
      <?php if (empty($fotos)): ?>
        <p class="galeria__vacio">Pronto subiremos nuevas fotos.</p>
      <?php endif; ?>

      <?php foreach ($fotos as $foto): ?>
        <button type="button" class="galeria__item"
                data-src="img/galeria/<?= esc($foto['archivo']) ?>"
                data-alt="<?= esc($foto['descripcion']) ?>"
                aria-label="Ampliar foto: <?= esc($foto['descripcion']) ?>">
          <img src="img/galeria/<?= esc($foto['archivo']) ?>" alt="" loading="lazy">
          <span class="galeria__item-label"><?= esc($foto['descripcion']) ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LIGHTBOX -->
  <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Foto ampliada" hidden>
    <button type="button" class="lightbox__cerrar" aria-label="Cerrar imagen ampliada">✕</button>
    <img class="lightbox__imagen" src="" alt="">
  </div>

<?php require __DIR__ . '/php/includes/footer.php'; ?>