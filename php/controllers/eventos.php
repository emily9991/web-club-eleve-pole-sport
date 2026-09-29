<?php
$stmt = $pdo->query(
  "SELECT nombre, descripcion, tipo, fecha_texto, lugar, inscripciones_abiertas
   FROM eventos
   ORDER BY fecha_orden ASC"
);
$eventos = $stmt->fetchAll();