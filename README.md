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

* 📄 **[Product Backlog](https://ugbedu-my.sharepoint.com/:x:/g/personal/smss076423_ugb_edu_sv/Eapi1oKlRTZEspPF9jjTorsBCA43wBJgucl2i_ann2TYmQ)**
* 📄 **[Sprint Backlog](https://ugbedu-my.sharepoint.com/:x:/g/personal/smss076423_ugb_edu_sv/EaBSOhwlRclNqigcsJRra_wB3L288eneTHb3FPSXRcNcvQ?e=kRMlO7)**
* 📋 **[Tablero Kanban](https://trello.com/invite/b/682888b233ee0e129eac41a1/ATTI2c99d8bc2b6ce8f7c69897eb00639d6693DB55BD/sprint-review-i)**
* 🎨 **[Prototipo en Figma](https://www.figma.com/proto/5V4YvHq5NbadccEFSM99o6?node-id=0-1&t=NeQOI4qeubAnkxOT-6)**

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
    * **Importante:** Dado que usas **SQLite**, Laravel lo configurará por defecto. Si necesitas cambiar algo, abre el archivo `.env` y ajusta la sección `DB_CONNECTION` si no es `sqlite`.

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

    ---
    **Alternativa: Configuración con Apache/Nginx (Recomendado para producción):**
    Para una configuración más robusta o permanente, deberás configurar tu servidor web (Apache o Nginx, que vienen con XAMPP) para que apunte al directorio `public` de este proyecto. Consulta la [documentación de Laravel sobre configuración de servidor](https://laravel.com/docs/11.x/deployment#server-requirements) para obtener guías detalladas.


---

**¡Esperamos que disfrutes aprendiendo LESSA!**
