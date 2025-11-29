# LESSA – Lenguaje de Señas Salvadoreño👋
# GPO01-LESSA-2025
LESSA es una **plataforma educativa interactiva** diseñada para hacer que el aprendizaje del Lenguaje de Señas Salvadoreño (LESSA) sea **fácil, divertido y accesible**. Nos enfocamos en la inclusión comunicacional, ofreciendo una experiencia gamificada con:

* ✨ Animaciones detalladas de señas
* 🎮 Minijuegos y desafíos interactivos
* 📈 Progresión por niveles para un aprendizaje estructurado
* 🔍 Sistema de retroalimentación visual para mejorar la precisión

---

## 🎯 Objetivos del Proyecto

* **Fomentar** el aprendizaje de LESSA de manera accesible e inclusiva.
* **Ofrecer** una experiencia atractiva basada en mecánicas de juego (gamificación).
* **Brindar** una plataforma web amigable e interactiva para usuarios de todas las edades.
* **Permitir** un seguimiento del progreso mediante niveles, desafíos y ejercicios prácticos.

---

## 🛠️ Tecnologías Utilizadas

* **Frontend**: HTML, CSS, JavaScript
* **Backend**: Laravel / PHP
* **Base de datos**: SQLite
* **Autenticación**: Google OAuth
* **Diseño y prototipado**: Figma
* **Gestión del proyecto**: Trello, Google Docs, GitHub

---

## 🚀 Organización del Proyecto

El desarrollo de LESSA sigue **metodologías ágiles**, con el trabajo organizado en **sprints**, épicas e historias de usuario. Esto nos permite un enfoque iterativo y colaborativo, garantizando una entrega de valor constante.

### 🔗 Enlaces Importantes del Proyecto

* 🎨 **[Enlace a la web](https://lessa.website)**
* 🎨 **[Prototipo en Figma](https://www.figma.com/proto/5V4YvHq5NbadccEFSM99o6/LESSA---Sprint-Demo?node-id=548-552&p=f&t=uM673BkONCdW3Iuj-1&scaling=scale-down&content-scaling=fixed&page-id=0%3A1)**

---

## 💻 Requisitos Previos

Para que LESSA funcione correctamente en tu máquina, necesitarás:

* **PHP:** Versión **8.1 o superior**. Puedes verificarlo con `php -v` en tu terminal.
* **Servidor Web:** Un servidor como **Apache** o **Nginx**. Si usas Windows, **XAMPP** o **WAMP** son excelentes opciones que incluyen todo lo necesario.
* **Base de Datos:** **SQLite** (ya que tu proyecto lo usa) o cualquier otra compatible con Laravel (MySQL/PostgreSQL si decides cambiar).
* **Composer:** El gestor de dependencias de PHP. ¡Si no lo tienes, te mostramos cómo instalarlo!
* **Git:** Para clonar este repositorio.

---

## ⬇️ Instalación de Composer (Si no lo tienes)

Composer es crucial para los proyectos Laravel. Sigue estos pasos para instalarlo en Windows:

### En Windows

1.  **Descarga el instalador:** Visita el sitio oficial y descarga `Composer-Setup.exe` desde [https://getcomposer.org/Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe).
2.  **Ejecuta el instalador:** Sigue las instrucciones. **Asegúrate de marcar la opción para añadir Composer a tu PATH** durante la instalación. Esto te permitirá usarlo desde cualquier directorio.
3.  **Verifica la instalación:** Abre una **nueva** ventana del Símbolo del sistema o PowerShell y ejecuta:
    ```bash
    composer -V
    ```
    Deberías ver la versión de Composer, lo que indica que se instaló correctamente.

---

## ⚙️ Pasos para la Configuración del Proyecto

Sigue estos pasos para tener LESSA funcionando en tu entorno local:

1.  **Clona el Repositorio:**
    ```bash
    git clone [https://github.com/WGuandique-2005/LESSAwebapp](https://github.com/WGuandique-2005/LESSAwebapp)
    cd LESSAwebapp
    ```

2.  **Instala las Dependencias de Composer:**
    Una vez dentro de la carpeta del proyecto (`LESSAwebapp`), ejecuta el siguiente comando. Esto descargará todas las bibliotecas y dependencias que Laravel necesita.
    ```bash
    composer install
    ```

3.  **Configura el Archivo de Entorno (`.env`):**
    Laravel utiliza un archivo `.env` para almacenar configuraciones específicas de tu entorno (como la base de datos, claves API, etc.).
    * Copia el archivo de ejemplo:
        ```bash
        cp .env.example .env
        ```

4.  **Genera la Clave de Aplicación:**
    Esta clave es fundamental para la seguridad de tu aplicación Laravel.
    ```bash
    php artisan key:generate
    ```

5.  **Ejecuta las Migraciones de la Base de Datos:**
    Esto creará las tablas necesarias en tu base de datos SQLite.
    ```bash
    php artisan migrate
    ```
    Si usas SQLite, esto creará automáticamente el archivo de base de datos si no existe.

6.  **Sirve la Aplicación:**
    Puedes usar el servidor de desarrollo de Laravel para probar LESSA rápidamente:
    ```bash
    php artisan serve
    ```
    Esto iniciará un servidor en `http://127.0.0.1:8000` (o un puerto similar). Abre esta URL en tu navegador y ¡explora LESSA!


##  🔑 Credenciales de Prueba (Administrador)
Para un acceso rápido a la plataforma después de completar la instalación y las migraciones, hemos incluido un usuario administrador por defecto que puedes utilizar para explorar las funcionalidades:
        ```
        user:admin@example.com	passwd: admin
        ```

**¡Esperamos que disfrutes aprendiendo LESSA!**
