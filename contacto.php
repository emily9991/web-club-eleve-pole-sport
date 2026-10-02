            <li>✗ <?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form class="contacto__form" method="post" action="contacto.php" novalidate>
      <div class="contacto__campo">
        <label for="nombre" class="contacto__label">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="contacto__input"
               value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"
               autocomplete="name" required>
      </div>

      <div class="contacto__campo">
        <label for="email" class="contacto__label">Correo electrónico</label>
        <input type="email" id="email" name="email" class="contacto__input"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
               autocomplete="email" required>
      </div>

      <div class="contacto__campo">
        <label for="telefono" class="contacto__label">Teléfono (opcional)</label>
        <input type="tel" id="telefono" name="telefono" class="contacto__input"
               value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>"
               autocomplete="tel">
      </div>

      <div class="contacto__campo">
        <label for="mensaje" class="contacto__label">Mensaje</label>
        <textarea id="mensaje" name="mensaje" class="contacto__input contacto__input--area"
                  rows="5" required><?= htmlspecialchars($_POST['mensaje'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="contacto__boton">Enviar mensaje</button>
    </form>
  </section>

<?php require __DIR__ . '/php/includes/footer.php'; ?>