<?php
require_once __DIR__ . '/php/config/conexion.php';
require_once __DIR__ . '/php/controllers/atletas.php';
// $atletas = todos los atletas desde la BD

if (!function_exists('esc')) {
    function esc($valor)
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

$titulo = 'Atletas | Club Elevé';
$pagina_activa = 'atletas';
$scripts_extra = ['js/atletas.js'];
require __DIR__ . '/php/includes/header.php';
?>

  <section class="atletas">
    <h1 class="atletas__titulo">Nuestros Atletas</h1>
    <p class="atletas__subtitulo">Selección de alto rendimiento del club</p>

    <!-- FILTROS -->
    <div class="atletas__filtros" role="group" aria-label="Filtrar atletas por categoría">
      <button type="button" class="atletas__filtro atletas__filtro--activo" aria-pressed="true" data-categoria="todos">Todos</button>
      <button type="button" class="atletas__filtro" aria-pressed="false" data-categoria="elite">Élite</button>
      <button type="button" class="atletas__filtro" aria-pressed="false" data-categoria="juvenil">Juvenil</button>
      <button type="button" class="atletas__filtro" aria-pressed="false" data-categoria="instructores">Instructores</button>
    </div>

    <!-- Aviso para lectores de pantalla cuando cambia el filtro -->
    <p class="visually-hidden" id="atletas-estado" role="status" aria-live="polite"></p>

    <!-- GRID DE ATLETAS -->
    <h2 class="visually-hidden">Lista de atletas</h2>
    <div class="atletas__grid">
      <?php if (empty($atletas)): ?>
        <p class="atletas__vacio">Pronto publicaremos a nuestros atletas.</p>
      <?php endif; ?>
      <?php foreach ($atletas as $atleta): ?>
        <div class="card-atleta" data-categoria="<?= esc($atleta['categoria']) ?>">
          <img src="img/atletas/<?= esc($atleta['foto']) ?>"
               alt="<?= esc($atleta['nombre']) ?>, atleta de pole sport"
               class="card-atleta__foto">
          <span class="card-atleta__badge">✓ <?= esc($atleta['estado']) ?></span>
          <h3 class="card-atleta__nombre"><?= esc($atleta['nombre']) ?></h3>
          <p class="card-atleta__descripcion"><?= esc($atleta['descripcion']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

<?php require __DIR__ . '/php/includes/footer.php'; ?>