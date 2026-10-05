-- ============================================
-- Base de datos: club_eleve
-- Proyecto SENA - Club Elevé (Pole Sport Colombia)
-- ============================================
-- Instalación nueva: importar en phpMyAdmin (pestaña Importar).
-- Si ya tienes la BD creada con la versión anterior, NO importes este
-- archivo encima: usa solo el bloque "MIGRACIÓN" del final.
-- ============================================

CREATE DATABASE IF NOT EXISTS club_eleve
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE club_eleve;

-- ============================================
-- Tabla: atletas
-- ============================================
CREATE TABLE IF NOT EXISTS atletas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    carpeta VARCHAR(80) NOT NULL,              -- carpeta de la atleta en img/atletas/ (ej: jazmin-cardozo)
    foto VARCHAR(150) NOT NULL,                -- portada (tarjeta): solo el archivo, dentro de su carpeta
    categoria VARCHAR(50) NOT NULL,            -- ej: "elite", "juvenil", "instructores"
    estado VARCHAR(30) DEFAULT 'Activo',
    descripcion VARCHAR(150) NOT NULL,         -- frase corta para la tarjeta
    logro VARCHAR(150),
    biografia TEXT NULL,                       -- texto completo del perfil
    destacado TINYINT(1) DEFAULT 0,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_categoria (categoria),
    INDEX idx_destacado (destacado)
);

-- ============================================
-- Tabla: atleta_fotos (galería individual de cada atleta)
-- ============================================
CREATE TABLE IF NOT EXISTS atleta_fotos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    atleta_id INT NOT NULL,
    archivo VARCHAR(150) NOT NULL,             -- solo el archivo, ej: 02.jpg (vive en la carpeta de la atleta)
    descripcion VARCHAR(150) NOT NULL,         -- se usa como alt de la imagen
    orden TINYINT NOT NULL DEFAULT 0,
    FOREIGN KEY (atleta_id) REFERENCES atletas(id) ON DELETE CASCADE,
    INDEX idx_atleta_orden (atleta_id, orden)
);

-- ============================================
-- Tabla: eventos
-- ============================================
CREATE TABLE IF NOT EXISTS eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    tipo VARCHAR(50) NOT NULL,                 -- ej: "Nacional", "Masterclass", "Torneo Abierto"
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,                            -- NULL si es un solo día
    fecha_texto VARCHAR(50) NOT NULL,          -- ej: "15 - 17 Mayo, 2025" (formato para mostrar)
    lugar VARCHAR(100) NOT NULL,               -- ej: "Medellín, Antioquia"
    inscripciones_abiertas TINYINT(1) DEFAULT 1,
    INDEX idx_fecha (fecha_inicio)
);

-- ============================================
-- Tabla: galeria (galería general del club)
-- ============================================
CREATE TABLE IF NOT EXISTS galeria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    archivo VARCHAR(150) NOT NULL,             -- ej: galeria-01.jpg
    descripcion VARCHAR(150) NOT NULL,         -- ej: "Torneo Nacional"
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_fecha (fecha)
);

-- ============================================
-- Tabla: contactos (formulario de contacto.php)
-- ============================================
CREATE TABLE IF NOT EXISTS contactos (
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
INSERT INTO atletas (nombre, carpeta, foto, categoria, estado, descripcion, logro, destacado) VALUES
('Valentina Gómez', 'valentina-gomez', '01.jpg', 'elite', 'Activo', 'Pole Sport Élite - Campeona Nal.', 'Medalla de Oro Nal. 2024', 1),
('Camila Restrepo', 'camila-restrepo', '01.jpg', 'elite', 'Activo', 'Pole Art & Flexibilidad Avanzada', 'Master Flexibilidad e Inversiones', 1),
('Daniela Morales', 'daniela-morales', '01.jpg', 'instructores', 'Activo', 'Pole Fitness & Acondicionamiento', 'Fuerza Calisténica & Core', 1);

INSERT INTO eventos (nombre, descripcion, tipo, fecha_inicio, fecha_fin, fecha_texto, lugar, inscripciones_abiertas) VALUES
('Campeonato Nacional Pole Sport 2025', 'Categorías Profesional, Élite y Amateur. Avalado por federación.', 'Nacional', '2025-05-15', '2025-05-17', '15 - 17 Mayo, 2025', 'Medellín, Antioquia', 1),
('Workshop Internacional: Dynamic Tricks', 'Transiciones de poder, dinamismo y caídas seguras con entrenadores IPSF.', 'Masterclass', '2025-06-28', NULL, '28 Junio, 2025', 'Bogotá D.C.', 1),
('Copa Elevé: Flexibilidad & Fuerza', 'Exhibición abierta, competencia interclubes y división juvenil.', 'Torneo Abierto', '2025-08-12', NULL, '12 Agosto, 2025', 'Cali, Valle', 1);

-- ============================================
-- Atleta real: Jazmín Cardozo (13 fotos en img/atletas/jazmin-cardozo/)
-- PENDIENTE: confirmar escritura del nombre y reemplazar los textos
-- marcados con [EDITAR] por los reales.
-- ============================================
INSERT INTO atletas (nombre, carpeta, foto, categoria, estado, descripcion, logro, biografia, destacado)
VALUES ('Jazmín Cardozo', 'jazmin-cardozo', '01.jpg', 'elite', 'Activo',
        '[EDITAR] Frase corta para la tarjeta (máx. 150 caracteres)',
        '[EDITAR] Logro principal',
        '[EDITAR] Texto completo del perfil de Jazmín.',
        1);

SET @jazmin_id = LAST_INSERT_ID();

INSERT INTO atleta_fotos (atleta_id, archivo, descripcion, orden) VALUES
(@jazmin_id, '01.jpg', 'Jazmín Cardozo en escena con traje morado y negro, brazo en alto', 1),
(@jazmin_id, '02.jpg', 'Jazmín Cardozo trepando el tubo con traje morado en escenario', 2),
(@jazmin_id, '03.jpg', 'Jazmín Cardozo invertida en el tubo con traje naranja bajo luz azul', 3),
(@jazmin_id, '04.jpg', 'Jazmín Cardozo en posición invertida plegada sobre el tubo dorado', 4),
(@jazmin_id, '05.jpg', 'Jazmín Cardozo en el tubo con las piernas abiertas, sesión de estudio', 5),
(@jazmin_id, '06.jpg', 'Jazmín Cardozo en el tubo con las piernas cruzadas y traje con cadenas', 6),
(@jazmin_id, '07.jpg', 'Jazmín Cardozo en el tubo con falda de tul negra, sesión de estudio', 7),
(@jazmin_id, '08.jpg', 'Jazmín Cardozo en el tubo con las piernas cruzadas en el aire', 8),
(@jazmin_id, '09.jpg', 'Jazmín Cardozo arqueada hacia atrás en el tubo con falda de tul negra', 9),
(@jazmin_id, '10.jpg', 'Jazmín Cardozo invertida en el tubo con las piernas flexionadas', 10),
(@jazmin_id, '11.jpg', 'Jazmín Cardozo invertida en el tubo con una pierna cruzada', 11),
(@jazmin_id, '12.jpg', 'Jazmín Cardozo en escena con telas naranja y blanca en movimiento', 12),
(@jazmin_id, '13.jpg', 'Jazmín Cardozo en el tubo al aire libre, foto en blanco y negro con una rosa roja', 13);

-- ============================================================
-- MIGRACIÓN (solo si ya tenías la BD creada con la versión anterior)
-- Ejecuta ÚNICAMENTE estas sentencias en phpMyAdmin y luego
-- el bloque "Atleta real" de arriba. No vuelvas a correr el resto.
-- ============================================================
-- ALTER TABLE atletas ADD COLUMN carpeta VARCHAR(80) NOT NULL DEFAULT '' AFTER nombre;
-- ALTER TABLE atletas ADD COLUMN biografia TEXT NULL AFTER logro;
-- -- Rellena la carpeta de las atletas que ya existían (una por atleta):
-- UPDATE atletas SET carpeta = 'valentina-gomez' WHERE nombre = 'Valentina Gómez';
--
-- CREATE TABLE atleta_fotos (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     atleta_id INT NOT NULL,
--     archivo VARCHAR(150) NOT NULL,
--     descripcion VARCHAR(150) NOT NULL,
--     orden TINYINT NOT NULL DEFAULT 0,
--     FOREIGN KEY (atleta_id) REFERENCES atletas(id) ON DELETE CASCADE,
--     INDEX idx_atleta_orden (atleta_id, orden)
-- );