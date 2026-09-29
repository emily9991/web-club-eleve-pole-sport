-- ============================================
-- Base de datos: club_eleve
-- Proyecto SENA - Club Elevé (Pole Sport Colombia)
-- ============================================

CREATE DATABASE IF NOT EXISTS club_eleve
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE club_eleve;

-- ============================================
-- Tabla: atletas
-- ============================================
CREATE TABLE atletas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    foto VARCHAR(150) NOT NULL,
    categoria VARCHAR(50) NOT NULL,           -- ej: "elite", "juvenil", "instructores"
    estado VARCHAR(30) DEFAULT 'Activo',
    descripcion VARCHAR(150) NOT NULL,
    logro VARCHAR(150),
    destacado TINYINT(1) DEFAULT 0,
    fecha_registro DATE DEFAULT (CURRENT_DATE),
    INDEX idx_categoria (categoria),
    INDEX idx_destacado (destacado)
);

-- ============================================
-- Tabla: eventos
-- ============================================
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    tipo VARCHAR(50) NOT NULL,                -- ej: "Nacional", "Masterclass", "Torneo Abierto"
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,                           -- NULL si es un solo día
    fecha_texto VARCHAR(50) NOT NULL,          -- ej: "15 - 17 Mayo, 2025" (formato para mostrar)
    lugar VARCHAR(100) NOT NULL,               -- ej: "Medellín, Antioquia"
    inscripciones_abiertas TINYINT(1) DEFAULT 1,
    INDEX idx_fecha (fecha_inicio)
);

-- ============================================
-- Tabla: galeria
-- ============================================
CREATE TABLE galeria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    archivo VARCHAR(150) NOT NULL,             -- ej: galeria-01.jpg
    descripcion VARCHAR(150) NOT NULL,         -- ej: "Torneo Nacional"
    fecha DATE DEFAULT (CURRENT_DATE),
    INDEX idx_fecha (fecha)
);

-- ============================================
-- Tabla: contactos (para el formulario de contacto.php)
-- ============================================
CREATE TABLE contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefono VARCHAR(20),
    mensaje TEXT NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    enviado_correo TINYINT(1) DEFAULT 0        -- si PHPMailer logró enviarlo o no
);

-- ============================================
-- Datos de ejemplo (opcional, para probar el sitio)
-- ============================================
INSERT INTO atletas (nombre, foto, categoria, estado, descripcion, logro, destacado) VALUES
('Valentina Gómez', 'atleta-valentina-gomez.jpg', 'elite', 'Activo', 'Pole Sport Élite - Campeona Nal.', 'Medalla de Oro Nal. 2024', 1),
('Camila Restrepo', 'atleta-camila-restrepo.jpg', 'elite', 'Activo', 'Pole Art & Flexibilidad Avanzada', 'Master Flexibilidad e Inversiones', 1),
('Daniela Morales', 'atleta-daniela-morales.jpg', 'instructores', 'Activo', 'Pole Fitness & Acondicionamiento', 'Fuerza Calisténica & Core', 1);

INSERT INTO eventos (nombre, descripcion, tipo, fecha_inicio, fecha_fin, fecha_texto, lugar, inscripciones_abiertas) VALUES
('Campeonato Nacional Pole Sport 2025', 'Categorías Profesional, Élite y Amateur. Avalado por federación.', 'Nacional', '2025-05-15', '2025-05-17', '15 - 17 Mayo, 2025', 'Medellín, Antioquia', 1),
('Workshop Internacional: Dynamic Tricks', 'Transiciones de poder, dinamismo y caídas seguras con entrenadores IPSF.', 'Masterclass', '2025-06-28', NULL, '28 Junio, 2025', 'Bogotá D.C.', 1),
('Copa Elevé: Flexibilidad & Fuerza', 'Exhibición abierta, competencia interclubes y división juvenil.', 'Torneo Abierto', '2025-08-12', NULL, '12 Agosto, 2025', 'Cali, Valle', 1);