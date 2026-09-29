<?php
$stmt = $pdo->query("SELECT archivo, descripcion FROM galeria ORDER BY fecha DESC");
$fotos = $stmt->fetchAll();