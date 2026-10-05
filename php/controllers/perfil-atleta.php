<a href="perfil-atleta.php?id=<?= (int) $atleta['id'] ?>"
   class="card-atleta"
   aria-label="Ver perfil de <?= esc($atleta['nombre']) ?>">
  <img src="img/atletas/<?= esc($atleta['foto']) ?>"
       alt="<?= esc($atleta['nombre']) ?>, atleta de pole sport"
       class="card-atleta__foto">
  <h3 class="card-atleta__nombre"><?= esc($atleta['nombre']) ?></h3>
  <span class="card-atleta__badge"><?= esc($atleta['estado']) ?></span>
</a>