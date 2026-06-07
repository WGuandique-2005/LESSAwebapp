<div align="center">

# 🤲 LESSA — Lenguaje de Señas Salvadoreño

**Plataforma educativa interactiva para aprender el Lenguaje de Señas Salvadoreño**

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-003B57?style=flat&logo=sqlite&logoColor=white)](https://sqlite.org)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

[🌐 Ver Plataforma](https://lessa.website) · [🎨 Prototipo en Figma](https://www.figma.com/proto/5V4YvHq5NbadccEFSM99o6/LESSA---Sprint-Demo?node-id=548-552&p=f&t=uM673BkONCdW3Iuj-1&scaling=scale-down&content-scaling=fixed&page-id=0%3A1) · [📋 Product Backlog](https://docs.google.com/spreadsheets/d/1hzbgJDMGRnsYUfSIKFP_jNKFW4frKsqovEBlbz5If6U/edit?usp=sharing)

</div>

---

## 📖 Descripción

LESSA es una plataforma educativa gamificada diseñada para hacer que el aprendizaje del **Lenguaje de Señas Salvadoreño** sea fácil, divertido y accesible para todos. Nace como respuesta a la brecha comunicacional entre la comunidad sorda y las personas oyentes en El Salvador.

### ✨ Características principales

- 🎓 **Lecciones interactivas** organizadas por niveles (Básico, Intermedio, Avanzado)
- 🎮 **Minijuegos** — Memorama de Señas y Sopa de Señas
- 📷 **Detección inteligente** de señas en tiempo real con Computer Vision (MediaPipe/OpenCV)
- 🏆 **Sistema de gamificación** — insignias, ranking global y recompensas
- 📜 **Certificados digitales** con código QR verificable al completar cursos
- 📊 **Historial de progreso** con gráficas interactivas
- 🔐 **Autenticación** tradicional y mediante Google OAuth

---

## 🛠️ Tecnologías

| Área | Tecnología |
|------|-----------|
| Backend | PHP 8.1+ / Laravel |
| Frontend | HTML, CSS, JavaScript, Tailwind CSS |
| Base de datos | SQLite |
| Visión Artificial | MediaPipe / OpenCV.js |
| Autenticación | Google OAuth 2.0 |
| Despliegue | DigitalOcean VPS + Nginx + SSL |
| Diseño | Figma |
| Gestión | Trello, GitHub (Git Flow) |

---

## ⚙️ Requisitos Previos

Asegúrate de tener instalado lo siguiente antes de comenzar:

- **PHP** `8.1` o superior → verificar con `php -v`
- **Composer** (gestor de dependencias de PHP)
- **Git**
- **Servidor web**: Apache o Nginx (en Windows puedes usar XAMPP o WAMP)
- **SQLite** (incluido con PHP por defecto)

### Instalar Composer (si no lo tienes)

**Windows:**
1. Descarga el instalador desde [getcomposer.org](https://getcomposer.org/Composer-Setup.exe)
2. Ejecuta `Composer-Setup.exe` y **marca la opción para agregar Composer al PATH**
3. Verifica la instalación abriendo una nueva terminal:
   ```bash
   composer -V
   ```

**Linux / macOS:**
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

---

## 🚀 Instalación

Sigue estos pasos para levantar el proyecto en tu entorno local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/WGuandique-2005/LESSAwebapp
cd LESSAwebapp
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
```

Abre el archivo `.env` y ajusta las variables según tu entorno. Para SQLite no necesitas configurar credenciales de base de datos adicionales.

### 4. Generar la clave de aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar migraciones

```bash
php artisan migrate
```

> Esto creará el archivo de base de datos SQLite y todas las tablas necesarias automáticamente.

### 6. (Opcional) Cargar datos de prueba

```bash
php artisan db:seed
```

### 7. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

Abre [http://127.0.0.1:8000](http://127.0.0.1:8000) en tu navegador. ¡Listo!

---

## 🔑 Credenciales de Prueba

Después de ejecutar las migraciones, puedes ingresar con el usuario administrador por defecto:

| Campo | Valor |
|-------|-------|
| **Correo** | `admin@example.com` |
| **Contraseña** | `admin` |

> ⚠️ Cambia estas credenciales antes de hacer cualquier despliegue en producción.

---

## 📁 Estructura del Proyecto

```
LESSAwebapp/
├── app/
│   ├── Http/Controllers/     # Controladores de la aplicación
│   └── Models/               # Modelos Eloquent
├── database/
│   ├── migrations/           # Migraciones de la base de datos
│   └── seeders/              # Datos de prueba
├── public/                   # Archivos públicos (assets, index.php)
├── resources/
│   ├── views/                # Vistas Blade
│   └── js/                   # JavaScript (MediaPipe, lógica frontend)
├── routes/
│   └── web.php               # Rutas de la aplicación
├── .env.example              # Variables de entorno de ejemplo
└── README.md
```

---

## 🎯 Módulos de la Plataforma

| Módulo | Descripción |
|--------|-------------|
| **Perfil** | Registro, login, Google OAuth, edición de perfil y notificaciones |
| **Aprender** | Lecciones interactivas con progresión por niveles |
| **Practicar** | Detección de señas en tiempo real con la cámara web |
| **Mecánicas** | Sistema de niveles, barras de progreso e insignias |
| **Minijuegos** | Memorama de señas y Sopa de señas con ranking |
| **Ayuda** | Guía interactiva y preguntas frecuentes |
| **Gestión** | Panel de administración con CRUD de usuarios y anuncios |

---

## 👥 Equipo de Desarrollo

| Nombre | Rol |
|--------|-----|
| William Josué Guandique Rivera | Scrum Master / Full Stack |
| Briseily Yamileth Solórzano Hernández | Product Owner / Frontend |
| Tania del Carmen Quintanilla Lozano | Scrum Team / Frontend & QA |
| Noe Isaí Hernández Rivas | Scrum Team / Backend |

Proyecto desarrollado en la **Universidad Gerardo Barrios** — Facultad de Ciencia y Tecnología, como parte de la materia *Gestión de Proyectos Informáticos* (Ciclo 01-2026).

---

## 📄 Licencia

Este proyecto es de uso académico. El código fuente, diseños y documentación son propiedad compartida entre la Universidad Gerardo Barrios y el Ministerio de Educación de El Salvador.

---

<div align="center">

Hecho con ❤️ para la comunidad sorda de El Salvador

</div>
