<?php
$stmt = $pdo->query("SELECT nombre, foto, estado, categoria, descripcion FROM atletas ORDER BY nombre ASC");
$atletas = $stmt->fetchAll();