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
│   └── validaciones.js           # Validación del formulario de contacto
│
├── img/
│   ├── atletas/
│   │   └── atleta-nombre.jpg
│   ├── eventos/
│   │   └── evento-fecha.jpg
│   ├── galeria/
│   │   └── galeria-01.jpg
│   └── general/
│       └── hero-bg.jpg
│
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
├── vendor/                       # Si se usa Composer para PHPMailer
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

- **Enfoque:** mobile-first, siguiendo el mockup de Stitch (hero con fondo oscuro, CTA morado "VER ATLETAS", CTA outline "VER EVENTOS", fila de stats, cards de atletas, lista de eventos, grid de galería, nav inferior).