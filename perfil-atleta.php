<?php
require_once __DIR__ . '/php/config/conexion.php';

if (!function_exists('esc')) {
    function esc($valor)
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

// 1. Validar el id que llega por la URL (?id=1)
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$atleta = null;
$fotos  = [];

if ($id) {
    try {
        $stmt = $pdo->prepare(
            "SELECT id, nombre, foto, categoria, estado, descripcion, logro, biografia
             FROM atletas WHERE id = ?"
        );
        $stmt->execute([$id]);
        $atleta = $stmt->fetch();

        if ($atleta) {
            $stmt = $pdo->prepare(
                "SELECT archivo, descripcion FROM atleta_fotos
                 WHERE atleta_id = ? ORDER BY orden ASC"
            );
            $stmt->execute([$id]);
            $fotos = $stmt->fetchAll();
        }
    } catch (PDOException $e) {
        error_log('Perfil atleta: ' . $e->getMessage());
    }
}

// 2. Si no existe, responder 404
if (!$atleta) {
    http_response_code(404);
    $titulo = 'Atleta no encontrada - Club Elevé';
} else {
    $titulo = $atleta['nombre'] . ' - Club Elevé';
}

$pagina_activa = 'atletas';
require __DIR__ . '/php/includes/header.php';
?>

<?php if (!$atleta): ?>

  <section class="perfil perfil--vacio">
    <h1 class="perfil__titulo">Atleta no encontrada</h1>
    <p class="perfil__texto">No encontramos el perfil que buscas.</p>
    <a href="atletas.php" class="perfil__volver">Volver a atletas</a>
  </section>

<?php else: ?>

  <!-- ENCABEZADO DEL PERFIL -->
  <section class="perfil">
    <a href="atletas.php" class="perfil__volver">&larr; Volver a atletas</a>

    <div class="perfil__cabecera">
      <img src="img/atletas/<?= esc($atleta['foto']) ?>"
           alt="<?= esc($atleta['nombre']) ?>, atleta de pole sport"
           class="perfil__foto">
      <div class="perfil__datos">
        <h1 class="perfil__titulo"><?= esc($atleta['nombre']) ?></h1>
        <span class="perfil__badge"><?= esc($atleta['estado']) ?></span>
        <p class="perfil__categoria"><?= esc(ucfirst($atleta['categoria'])) ?></p>
        <p class="perfil__descripcion"><?= esc($atleta['descripcion']) ?></p>
        <?php if (!empty($atleta['logro'])): ?>
          <p class="perfil__logro">
            <span class="perfil__logro-etiqueta">Logro destacado:</span>
            <?= esc($atleta['logro']) ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- BIOGRAFÍA -->
  <?php if (!empty($atleta['biografia'])): ?>
  <section class="perfil-bio" aria-labelledby="bio-titulo">
    <h2 class="perfil-bio__titulo" id="bio-titulo">Sobre <?= esc($atleta['nombre']) ?></h2>
    <p class="perfil-bio__texto"><?= nl2br(esc($atleta['biografia'])) ?></p>
  </section>
  <?php endif; ?>

  <!-- GALERÍA DE LA ATLETA -->
  <section class="perfil-galeria" aria-labelledby="galeria-titulo">
    <h2 class="perfil-galeria__titulo" id="galeria-titulo">Galería</h2>
    <?php if (empty($fotos)): ?>
      <p class="perfil-galeria__vacio">Pronto subiremos más fotos.</p>
    <?php else: ?>
      <div class="perfil-galeria__grid">
        <?php foreach ($fotos as $foto): ?>
          <img src="img/atletas/<?= esc($foto['archivo']) ?>"
               alt="<?= esc($foto['descripcion']) ?>"
               class="perfil-galeria__item"
               loading="lazy">
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>

<?php endif; ?>

<?php require __DIR__ . '/php/includes/footer.php'; ?>