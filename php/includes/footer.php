<?php
$pagina_activa = $pagina_activa ?? '';

$items_nav = [
  'inicio'   => ['index.php',    'bi-house-door', 'Inicio'],
  'atletas'  => ['atletas.php',  'bi-person-arms-up', 'Atletas'],
  'eventos'  => ['eventos.php',  'bi-calendar-event', 'Eventos'],
  'galeria'  => ['galeria.php',  'bi-images', 'Galería'],
  'contacto' => ['contacto.php', 'bi-envelope', 'Contacto'],
];
?>
  </main>

  <footer class="footer">
    <p class="footer__texto">&copy; <?= date('Y') ?> Club Elevé · Pole Sport Colombia</p>
  </footer>

  <nav class="nav-inferior" aria-label="Navegación principal">
    <?php foreach ($items_nav as $clave => [$url, $icono, $texto]):
      $activo = ($clave === $pagina_activa); ?>
      <a href="<?= $url ?>"
         class="nav-inferior__item<?= $activo ? ' nav-inferior__item--activo' : '' ?>"
         <?= $activo ? 'aria-current="page"' : '' ?>>
        <i class="bi <?= $icono ?>" aria-hidden="true"></i>
        <span class="nav-inferior__texto"><?= $texto ?></span>
      </a>
    <?php endforeach; ?>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>
  <?php foreach (($scripts_extra ?? []) as $src): ?>
    <script src="<?= htmlspecialchars($src) ?>"></script>
  <?php endforeach; ?>
</body>
</html>