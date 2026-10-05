<?php
require_once __DIR__ . '/php/config/conexion.php';
require_once __DIR__ . '/php/controllers/eventos.php';
// $eventos = eventos desde la BD

if (!function_exists('esc')) {
    function esc($valor)
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

$titulo = 'Eventos | Club Elevé';
$pagina_activa = 'eventos';
require __DIR__ . '/php/includes/header.php';
?>

  <section class="eventos">
    <h1 class="eventos__titulo">Próximos Eventos</h1>
    <p class="eventos__subtitulo">Torneos, talleres y clasificatorios</p>

    <h2 class="visually-hidden">Lista de eventos</h2>
    <div class="eventos__lista">
      <?php if (empty($eventos)): ?>
        <p class="eventos__vacio">No hay eventos programados por ahora. ¡Vuelve pronto!</p>
      <?php endif; ?>

      <?php foreach ($eventos as $evento): ?>
        <div class="card-evento">
          <div class="card-evento__etiquetas">
            <?php if ($evento['inscripciones_abiertas']): ?>
              <span class="card-evento__badge card-evento__badge--info">✓ Inscripciones abiertas</span>
            <?php else: ?>
              <span class="card-evento__badge card-evento__badge--cerrado">✗ Inscripciones cerradas</span>
            <?php endif; ?>
            <span class="card-evento__tipo"><?= esc($evento['tipo']) ?></span>
          </div>

          <h3 class="card-evento__nombre"><?= esc($evento['nombre']) ?></h3>
          <p class="card-evento__descripcion"><?= esc($evento['descripcion']) ?></p>

          <div class="card-evento__meta">
            <span class="card-evento__fecha">
              <span aria-hidden="true">📅</span>
              <span class="visually-hidden">Fecha:</span>
              <?= esc($evento['fecha_texto']) ?>
            </span>
            <span class="card-evento__lugar">
              <span aria-hidden="true">📍</span>
              <span class="visually-hidden">Lugar:</span>
              <?= esc($evento['lugar']) ?>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

<?php require __DIR__ . '/php/includes/footer.php'; ?>