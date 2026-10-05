# web-club-eleve-pole-sport
Sitio web deportivo de pole sport y sus derivados.
# Club Elevé — Sitio Web

Proyecto SENA — Sitio web personalizado para Club Elevé (Pole Sport Colombia).

## Stack tecnológico

- PHP 8
- MySQL 8
- Bootstrap 5
- PHPMailer
- Hosting: GoDaddy (clubeleve.com.co)

## Equipo y responsabilidades

| Rol | Responsable | Archivos a cargo |
|---|---|---|
| Frontend Developer | Emily | `*.php` (estructura HTML), `js/` |
| UX/UI Designer | Julián Monroy | `css/`, mockups en Figma/Stitch |

**Regla base:** Emily construye el marcado (HTML/PHP) usando las clases definidas en la convención BEM de este documento. Julián estiliza exactamente esas clases en `css/`. Si Julián necesita una clase que no existe en el HTML, la solicita a Emily en vez de editar el archivo directamente. Así ningún archivo lo tocan dos personas a la vez.

## Estructura de carpetas

```
club-eleve/
│
├── index.php                     # Página principal (hero, stats, CTAs)
├── atletas.php
├── eventos.php
├── galeria.php
├── contacto.php
│
├── css/
│   ├── variables.css             # Paleta de colores, tipografía, espaciados
│   ├── estilos.css               # Estilos generales / overrides de Bootstrap
│   └── componentes.css           # card-atleta, card-evento, nav-inferior, etc.
│
├── js/
│   ├── main.js                   # Menú, nav inferior, interacciones generales
│   ├── carrusel.js               # Slider/lightbox de galería (si aplica)
│   └── validaciones.js
|   └── atletas.js        # Validación del formulario de contacto
│
├── img/
│   ├── atletas/
│   │   └── jazmin-cardozo/
    |        └──     01.jpg      # portada (tarjeta)
│   ├── eventos/
│   │   └── evento-fecha.jpg
│   ├── galeria/
│   │   └── galeria-01.jpg
│   └── general/
│       └── hero-bg.jpg
│
├── .gitignore
├── php/
│   ├── config/
│   │   └── conexion.php          # Conexión a MySQL
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   ├── controllers/
│   │   ├── atletas.php           # Lógica que trae datos de atletas
│   │   ├── eventos.php
│   │   └── contacto.php          # Procesa el formulario + PHPMailer
│   └── mailer/
│       └── PHPMailer/            # Librería (idealmente vía Composer)
│
├── sql/
│   └── club_eleve.sql            # Script de creación de la base de datos
│
└── README.md
```

## Paleta de colores (colores del logo)

| Variable | HEX | Rol |
|---|---|---|
| `--color-primario` | `#008B8B` | Fondos de secciones, nav |
| `--color-secundario` | `#48D1CC` | Hover, bordes outline |
| `--color-acento` | `#FF8C00` | CTA principal (reemplaza el morado del mockup) |
| `--color-apoyo` | `#3CB371` | Badges, estado "activo" |
| `--color-info` | `#2E6FDB` | Color extra (fuera del logo) para selección/info, evita confundirse con verde/turquesa |
| `--color-fondo-oscuro` | `#0D1B1B` | Fondo del hero |

## Accesibilidad — daltonismo

- **El color nunca es el único portador de significado.** Todo estado (activo/inactivo, éxito/error, seleccionado) debe llevar un segundo indicador no cromático (ícono, forma, subrayado, texto).
- `--color-apoyo` (verde) y `--color-primario` (teal) se confunden en deuteranopia — no usarlos como únicos indicadores de dos cosas distintas si van adyacentes.
- `--color-acento` (naranja) es el color más distinguible en los tres tipos de daltonismo comunes — reservarlo para lo crítico (CTA principal, alertas).
- Verificar contraste de texto sobre `--color-secundario` (turquesa claro) con WebAIM Contrast Checker (mínimo WCAG AA, 4.5:1).

## Accesibilidad — lectores de pantalla / discapacidad visual

- **HTML semántico:** usar `<section>`, `<nav>`, jerarquía correcta de `<h1>`-`<h3>` sin saltos de nivel.
- **`alt` en imágenes:**
  - Informativa (atleta, evento) → describir el contenido: `alt="María López, atleta de pole sport"`
  - Decorativa (fondo del hero) → `alt=""` vacío intencional
- **Nav inferior:** cada ítem necesita texto accesible además del ícono, y `aria-current="page"` en el ítem activo (no depender solo del color).
- **Formularios:** cada `<input>` con su `<label for="">` asociado (no solo placeholder); mensajes de error con `aria-live="polite"`.
- **Links con contexto propio:** evitar "Ver más" repetidos sin contexto — usar `aria-label` descriptivo aunque el texto visible sea corto.
- **Orden de tabulación lógico:** revisar que el nav inferior fijo (aunque esté al final del HTML) no rompa el flujo de tabulación/lectura.

## Convención de nombres CSS (BEM)

Formato: `bloque__elemento--modificador`

```css
.hero { }
.hero__titulo { }
.hero__cta { }
.hero__cta--outline { }        /* botón "VER EVENTOS" vs "VER ATLETAS" */

.stats { }
.stats__item { }
.stats__numero { }

.card-atleta { }
.card-atleta__foto { }
.card-atleta__nombre { }

.card-evento { }
.card-evento__fecha { }

.galeria { }
.galeria__item { }

.nav-inferior { }
.nav-inferior__item { }
.nav-inferior__item--activo { }
```

## Nomenclatura de assets

- Atletas: `atleta-nombre.jpg`
- Eventos: `evento-fecha.jpg`
- Galería: `galeria-01.jpg`, `galeria-02.jpg`, ...

## Flujo de trabajo

- **Control de versiones (si aplica):**
  - `main` — solo código funcionando
  - `frontend-emily` — rama de trabajo de Emily
  - `ui-julian` — rama de trabajo de Julián
  - Merges frecuentes y pequeños, no al final del proyecto

- **Puntos de sincronización:** 2 revisiones semanales conjuntas para validar que el HTML y el CSS calcen correctamente antes de seguir avanzando.

-- **Enfoque:** mobile-first. El mockup de Stitch se usa como referencia de estructura (hero con fondo oscuro, CTA principal "VER ATLETAS", CTA outline "VER EVENTOS", fila de stats, cards de atletas, lista de eventos, grid de galería, nav inferior). Los colores son los de la paleta del logo: el CTA principal usa `--color-acento` (naranja), no el morado del mockup.

## Configuración inicial

Los archivos `php/config/conexion.php` y `php/config/correo.php` contienen credenciales y no se incluyen en el repositorio (están en `.gitignore`). Para ejecutar el proyecto en local es necesario crearlos manualmente o solicitarlos a la persona responsable del backend.

**`php/config/conexion.php`** debe definir las siguientes variables antes de crear la conexión PDO:

| Variable | Descripción |
|---|---|
| `$db_host` | Servidor de MySQL (normalmente `localhost`) |
| `$db_nombre` | Nombre de la base de datos |
| `$db_usuario` | Usuario de MySQL |
| `$db_clave` | Contraseña de MySQL |

La conexión queda disponible en la variable `$pdo`, que utilizan los controladores.

**`php/config/correo.php`** contiene los datos SMTP que utiliza PHPMailer para enviar los mensajes del formulario de contacto.

Pasos:

1. Clonar el repositorio.
2. Crear `conexion.php` y `correo.php` en `php/config/`.
3. Importar `sql/club_eleve.sql` en la base de datos.
4. Si PHPMailer se instala con Composer, ejecutar `composer install`.

## Uso de header y footer

Todas las páginas comparten `php/includes/header.php` y `php/includes/footer.php`. Estos archivos incluyen el `<head>`, los estilos, el encabezado, el menú de navegación inferior y los scripts, por lo que no deben repetirse en cada página.

Cada página define variables antes de incluir el header:

| Variable | Uso |
|---|---|
| `$titulo` | Texto de la pestaña del navegador |
| `$pagina_activa` | Ítem activo del menú: `inicio`, `atletas`, `eventos`, `galeria` o `contacto` |
| `$scripts_extra` | Arreglo con scripts adicionales de la página (opcional) |

Ejemplo:

```php
<?php
$titulo = 'Contacto | Club Elevé';
$pagina_activa = 'contacto';
$scripts_extra = ['js/validaciones.js'];
require __DIR__ . '/php/includes/header.php';
?>

<section> ... </section>

<?php require __DIR__ . '/php/includes/footer.php'; ?>
```

El ítem activo del menú se marca con `aria-current="page"` y la clase `nav-inferior__item--activo`.

Clases nuevas (pendientes de estilizar por Julián)
Clase	Dónde se usa	Qué necesita
.card-evento__badge--cerrado	index.php, eventos.php	Variante del badge para "Inscripciones cerradas". Debe distinguirse del estado abierto sin depender solo del color (el texto ya lo indica).
.atletas-preview__vacio	index.php	Mensaje cuando no hay atletas.
.eventos-preview__vacio	index.php	Mensaje cuando no hay eventos.
.galeria-preview__vacio	index.php	Mensaje cuando no hay fotos.
.atletas__vacio	atletas.php	Mensaje cuando el filtro no devuelve atletas o no hay datos.
.eventos__vacio	eventos.php	Mensaje cuando no hay eventos programados.
.atletas__filtro--activo	atletas.php	Además del color, un indicador visual extra (subrayado o borde).
Reglas CSS que Julián debe tener en cuenta
Las tarjetas de atletas se ocultan con el atributo hidden. Si .card-atleta define display (flex, grid, etc.), anula el atributo y el filtro deja de funcionar. Solución:
css
.card-atleta[hidden] { display: none; }
Datos y contenido
Fechas de eventos: se muestran desde fecha_texto, que ya viene formateada (ej. "15 - 17 Mayo, 2025"). La consulta solo trae eventos futuros.
Datos de ejemplo en sql/club_eleve.sql: las fechas de 2025 ya pasaron, por lo que la página mostrará "No hay eventos programados". Para probar, cambiarlas a 2026 o 2027 en el SQL.
Cifras del hero/stats (50+, 5, 20+): están escritas a mano en index.php. Confirmar con el club que sean reales antes de publicar.
Código compartido
esc() (escape de salida HTML) está definida en cada página dentro de if (!function_exists('esc')) para evitar errores por redeclaración.
Pendiente: al terminar la revisión de las cinco páginas, mover esc() a php/includes/helpers.php, incluirla una sola vez y quitarla de cada página.

## Pendientes antes de publicar
 Julián estiliza las clases nuevas de la tabla anterior.
 Agregar .card-atleta[hidden] { display: none; } en css/componentes.css.
 Cambiar las fechas de ejemplo del SQL a 2026/2027 y probar la lista de eventos.
 Confirmar con el club las cifras de index.php (50+, 5, 20+).
 Mover esc() a php/includes/helpers.php.
 Probar con lector de pantalla: filtros, aviso de resultados y nav inferior.