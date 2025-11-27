# 🎮 RetroCode - Documentación Técnica

## Información General

**Proyecto:** RetroCode - Blog de Videojuegos Clásicos  
**Equipo:** "Noobs con Código"  
**Versión:** 1.0  
**Fecha:** 2024-2025  
**Institución:** CFP20 - Trabajo Final  

## 📋 Descripción del Proyecto

RetroCode es una aplicación web dedicada a los videojuegos clásicos que permite a los usuarios explorar un catálogo de juegos retro organizados por categorías, leer información detallada de cada juego y participar mediante comentarios. Incluye un panel de administración completo para gestionar el contenido.

## 🏗️ Arquitectura del Sistema

### Patrón de Diseño
- **MVC (Modelo-Vista-Controlador):** Separación clara entre lógica de negocio, presentación y control
- **Active Record:** Para interacción con la base de datos
- **Singleton:** Para conexión única a la base de datos
- **Front Controller:** Enrutamiento centralizado

### Estructura de Directorios

```
retrocode-final/
├── admin/                  # Panel de administración
│   ├── actions/           # Acciones del admin (CRUD)
│   ├── views/             # Vistas del panel admin
│   └── index.php          # Controlador principal admin
├── api/                   # API REST
│   └── comentarios.php    # Endpoint de comentarios
├── class/                 # Modelos y clases
│   ├── Conexion.php       # Conexión base PDO
│   ├── JuegoModel.php     # Modelo de juegos
│   ├── ComentarioModel.php # Modelo de comentarios
│   ├── Autenticacion.php  # Sistema de login
│   └── Database.php       # Conexión Singleton
├── css/                   # Estilos
├── db/                    # Base de datos
│   └── juegos_db.sql      # Script de creación
├── functions/             # Funciones auxiliares
│   └── autoload.php       # Carga automática de clases
├── img/                   # Recursos gráficos
├── js/                    # JavaScript
│   └── comentarios.js     # Sistema AJAX comentarios
├── views/                 # Vistas del frontend
└── index.php              # Controlador principal
```

## 🗄️ Base de Datos

### Esquema de Datos

#### Tabla: `categorias`
```sql
- id (INT, PK, AUTO_INCREMENT)
- nombre (VARCHAR(100), UNIQUE)
```

#### Tabla: `juegos`
```sql
- id (INT, PK)
- nombre (VARCHAR(255))
- id_categoria (INT, FK)
- empresa (VARCHAR(255))
- publicacion (VARCHAR(100))
- bajada (TEXT)
- portada (VARCHAR(255))
- precio (VARCHAR(100))
- [otros campos de plataformas y características]
```

#### Tabla: `comentarios`
```sql
- id (INT, PK, AUTO_INCREMENT)
- juego_id (INT, FK)
- usuario_id (INT, FK, NULLABLE)
- nombre_usuario (VARCHAR(100))
- contenido (TEXT)
- creado_at (TIMESTAMP)
```

#### Tabla: `usuarios`
```sql
- id (INT, PK, AUTO_INCREMENT)
- email (VARCHAR(255), UNIQUE)
- nombre_usuario (VARCHAR(100), UNIQUE)
- password (VARCHAR(255))
- created_at (TIMESTAMP)
```

### Relaciones
- `juegos.id_categoria` → `categorias.id`
- `comentarios.juego_id` → `juegos.id`
- `comentarios.usuario_id` → `usuarios.id`

## 🔧 Componentes Técnicos

### 1. Sistema de Conexión a Base de Datos

#### Clase `Conexion` (Base)
```php
// Configuración PDO básica con constantes
public const DB_SERVER = "localhost";
public const DB_USER = "root";
public const DB_PASS = "";
public const DB_NAME = "juegos_db";
```

#### Clase `Database` (Singleton)
```php
// Patrón Singleton para conexión única
private static $instance = null;
public static function getInstance()
```

### 2. Modelos de Datos

#### `JuegoModel`
- `obtenerTodos()`: Lista completa de juegos
- `obtenerPorCategoria($categoria)`: Filtrado por categoría
- `obtenerPorId($id)`: Juego específico

#### `ComentarioModel`
- `obtenerPorJuego($juego_id)`: Comentarios de un juego
- `crear($juego_id, $contenido, $nombre)`: Nuevo comentario
- `contarPorJuego($juego_id)`: Estadísticas

### 3. Sistema de Autenticación

#### Clase `Autenticacion`
- `login($email, $password)`: Validación de credenciales
- `verify()`: Verificación de sesión activa
- `logout()`: Cierre de sesión
- `isLoggedIn()`: Estado de autenticación

**Credenciales por defecto:**
- Email: `admin@retrocode.com`
- Password: `admin123`

### 4. API REST

#### Endpoint: `/api/comentarios.php`

**GET** `?juego_id={id}`
```json
// Respuesta
[
  {
    "id": 1,
    "contenido": "Excelente juego!",
    "creado_at": "2024-01-01 12:00:00",
    "nombre_usuario": "Usuario"
  }
]
```

**POST** `juego_id, contenido`
```json
// Respuesta
{
  "success": true,
  "message": "Comentario guardado correctamente"
}
```

## 🎨 Frontend

### Tecnologías
- **Bootstrap 5.3.7:** Framework CSS responsivo
- **Font Awesome 6.5.0:** Iconografía
- **JavaScript ES6+:** Funcionalidad dinámica
- **CSS3:** Estilos personalizados con gradientes y efectos

### Características Visuales
- **Diseño responsivo:** Adaptable a dispositivos móviles
- **Tema oscuro:** Estética retro gaming
- **Efectos visuales:** Gradientes, sombras, transiciones
- **Galería interactiva:** Hover effects en portadas
- **Tipografía:** Fuente VT323 (estilo retro)

### Páginas Principales

#### 1. Home (`views/home.php`)
- Galería expandible de juegos
- Hero section con branding
- Secciones informativas
- Call-to-action al catálogo

#### 2. Catálogo por Categorías (`views/juegos.php`)
- Filtrado dinámico por categoría
- Cards de juegos con información
- Modales de vista previa
- Estilos temáticos por categoría

#### 3. Detalle de Juego (`views/juego.php`)
- Información completa del juego
- Sistema de comentarios AJAX
- Multimedia (imágenes, videos)
- Datos técnicos y descripción

### JavaScript Interactivo

#### Sistema de Comentarios (`js/comentarios.js`)
```javascript
// Envío AJAX sin recarga
fetch('api/comentarios.php', {
    method: 'POST',
    body: formData
})
```

## 🔐 Panel de Administración

### Funcionalidades
- **Dashboard:** Estadísticas y resumen
- **Gestión de Juegos:** CRUD completo
- **Autenticación:** Login/logout seguro
- **Interfaz moderna:** Bootstrap con sidebar

### Rutas Administrativas
- `/admin/?sec=dashboard` - Panel principal
- `/admin/?sec=admin_juegos` - Lista de juegos
- `/admin/?sec=add_juego` - Agregar juego
- `/admin/?sec=edit_juego&id={id}` - Editar juego
- `/admin/?sec=delete_juego&id={id}` - Eliminar juego

### Acciones CRUD (`admin/actions/`)
- `add_juego_acc.php` - Procesamiento de alta
- `edit_juego_acc.php` - Procesamiento de edición
- `delete_juego_acc.php` - Procesamiento de baja
- `auth_login.php` - Autenticación
- `auth_logout.php` - Cierre de sesión

## 🚀 Funcionalidades Principales

### 1. Catálogo de Juegos
- **15 juegos clásicos** organizados en 3 categorías:
  - **Terror:** Resident Evil, Silent Hill, Alone in the Dark, Clock Tower, Sweet Home
  - **Arcade:** Pac-Man, Final Fight, Tron, Space Invaders, Tetris
  - **Aventura:** Minecraft, Terraria, The Last of Us, Skyrim, Tomb Raider

### 2. Sistema de Comentarios
- Comentarios anónimos por juego
- Actualización en tiempo real (AJAX)
- Validación de contenido
- Ordenamiento cronológico

### 3. Navegación Intuitiva
- Menú principal con categorías
- Breadcrumbs y navegación contextual
- Búsqueda visual por portadas
- Enlaces directos a detalles

### 4. Responsive Design
- Adaptación automática a dispositivos
- Menú hamburguesa en móviles
- Grillas flexibles
- Imágenes optimizadas

## ⚙️ Configuración e Instalación

### Requisitos del Sistema
- **PHP 8.0+** con extensiones PDO y MySQL
- **MySQL 5.7+** o MariaDB 10.2+
- **Apache/Nginx** con mod_rewrite
- **Navegador moderno** con soporte ES6+

### Instalación

1. **Clonar/Descargar** el proyecto en el directorio web
2. **Importar base de datos:**
   ```bash
   mysql -u root -p < db/juegos_db.sql
   ```
3. **Configurar conexión** en `class/Conexion.php`:
   ```php
   public const DB_SERVER = "localhost";
   public const DB_USER = "tu_usuario";
   public const DB_PASS = "tu_password";
   public const DB_NAME = "juegos_db";
   ```
4. **Verificar permisos** de escritura en `img/covers/`
5. **Acceder** via navegador: `http://localhost/retrocode-final/`

### Estructura de URLs

#### Frontend Público
- `/` - Página principal
- `/?sec=home` - Home
- `/?sec=juegos&ser={categoria}` - Juegos por categoría
- `/?sec=juego&id={id}` - Detalle de juego
- `/?sec=todos` - Catálogo completo
- `/?sec=quienes_somos` - Información del equipo

#### Panel Administrativo
- `/admin/` - Dashboard
- `/admin/?sec=login` - Login
- `/admin/?sec=admin_juegos` - Gestión de juegos

## 🔒 Seguridad

### Medidas Implementadas
- **Prepared Statements:** Prevención de SQL Injection
- **Validación de entrada:** Filtrado de datos POST/GET
- **Autenticación de sesiones:** Control de acceso admin
- **Escape de salida:** Prevención de XSS
- **Validación de archivos:** Control de uploads

### Consideraciones de Producción
- Cambiar credenciales por defecto
- Implementar HTTPS
- Configurar variables de entorno
- Habilitar logs de errores
- Implementar rate limiting

## 📊 Datos de Prueba

### Categorías Incluidas
1. **Terror (ID: 1)** - 5 juegos
2. **Arcade (ID: 2)** - 5 juegos  
3. **Aventura (ID: 3)** - 5 juegos

### Juegos Destacados
- **Resident Evil** (1996) - Survival Horror clásico
- **Pac-Man** (1980) - Icono de los arcades
- **Minecraft** (2009) - Sandbox infinito
- **Silent Hill** (1999) - Horror psicológico
- **Tetris** (1984) - Puzzle atemporal

## 🎯 Características Técnicas Destacadas

### 1. Autoload PSR-4
```php
function autoloadClases($nombreClase) {
    $archivoClase = __DIR__ . "/../class/" . $nombreClase . ".php";
    if (file_exists($archivoClase)) {
        require_once $archivoClase;
    }
}
```

### 2. Enrutamiento Dinámico
```php
$secciones_validas = [
    "home" => ["titulo" => "Bienvenidos"],
    "juegos" => ["titulo" => "Nuestro Catalogo"],
    // ...
];
```

### 3. Templating Modular
```php
$ruta_vista = __DIR__ . "/views/{$vista}.php";
if (!file_exists($ruta_vista)) {
    $ruta_vista = __DIR__ . "/views/404.php";
}
require $ruta_vista;
```

### 4. API RESTful
```php
// GET: Obtener comentarios
// POST: Crear comentario
// Respuestas JSON estructuradas
// Manejo de errores HTTP
```

## 🚧 Posibles Mejoras Futuras

### Funcionalidades
- Sistema de usuarios registrados
- Calificaciones y reviews
- Búsqueda avanzada con filtros
- Favoritos y listas personales
- Integración con APIs externas (IGDB, Steam)

### Técnicas
- Implementar caché (Redis/Memcached)
- Optimización de imágenes (WebP, lazy loading)
- PWA (Progressive Web App)
- Tests unitarios (PHPUnit)
- CI/CD pipeline

### UX/UI
- Modo claro/oscuro
- Animaciones más fluidas
- Filtros en tiempo real
- Infinite scroll
- Comparador de juegos

## 📝 Notas de Desarrollo

### Convenciones de Código
- **PSR-4** para autoloading
- **camelCase** para métodos
- **snake_case** para base de datos
- **PascalCase** para clases
- Documentación PHPDoc

### Buenas Prácticas Aplicadas
- Separación de responsabilidades
- Reutilización de código
- Validación de datos
- Manejo de errores
- Código autodocumentado

---

**Desarrollado por:** Equipo "Noobs con Código"  
**Contacto:** admin@retrocode.com  
**Licencia:** Proyecto Educativo - CFP20  
**Año:** 2024-2025