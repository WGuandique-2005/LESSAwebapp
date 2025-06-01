# LESSA – Lenguaje de Señas Salvadoreño

LESSA es una plataforma educativa interactiva que busca facilitar el aprendizaje del Lenguaje de Señas Salvadoreño (LESSA) a través de una experiencia gamificada, intuitiva y accesible. El proyecto está enfocado en promover la inclusión comunicacional mediante el uso de recursos como animaciones, minijuegos, desafíos interactivos, progresión por niveles y un sistema de retroalimentación visual que ayude a mejorar la precisión del usuario al realizar señas.

## Objetivos del Proyecto

- Fomentar el aprendizaje del lenguaje de señas salvadoreño de manera accesible e inclusiva.
- Ofrecer una experiencia atractiva basada en mecánicas de juego (gamificación).
- Brindar una plataforma web amigable e interactiva para usuarios de todas las edades.
- Permitir un seguimiento del progreso mediante niveles, desafíos y ejercicios prácticos.

## Tecnologías Utilizadas

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: Laravel / PHP
- **Base de datos**: SQLite
- **Autenticación**: Google OAuth
- **Diseño y prototipado**: Figma
- **Gestión del proyecto**: Trello, Google Docs, GitHub

## Organización del Proyecto

El desarrollo se realiza utilizando metodologías ágiles, distribuyendo el trabajo en sprints con tareas organizadas mediante épicas e historias de usuario. Esto permite un enfoque iterativo y colaborativo.

### Enlaces importantes del proyecto

- 📄 **[Product Backlog](https://ugbedu-my.sharepoint.com/:x:/g/personal/smss076423_ugb_edu_sv/Eapi1oKlRTZEspPF9jjTorsBCA43wBJgucl2i_ann2TYmQ)**
- 📄 **[Sprint Backlog](https://ugbedu-my.sharepoint.com/:x:/g/personal/smss076423_ugb_edu_sv/EaBSOhwlRclNqigcsJRra_wB3L288eneTHb3FPSXRcNcvQ?e=kRMlO7)**
- 📋 **[Tablero Kanban](https://trello.com/invite/b/682888b233ee0e129eac41a0/ATTI2c99d8bc2b6ce8f7c69897eb00639d6693DB55BD/sprint-review-i)**
- 📋 **[Prototipo en figma](https://www.figma.com/proto/5V4YvHq5NbadccEFSM99o6?node-id=0-1&t=NeQOI4qeubAnkxOT-6)**



## Requisitos Previos

Antes de empezar, asegúrate de tener instalado lo siguiente:

* **PHP:** Versión 8.1 o superior. Puedes verificar tu versión con `php -v` en la terminal.
* **Servidor Web:** Un servidor como Apache o Nginx. Si estás en Windows, XAMPP o WAMP.
* **Base de Datos:** MySQL o PostgreSQL (u otra base de datos compatible con Laravel).
* **Composer:** Un gestor de dependencias para PHP. ¡No te preocupes si no lo tienes, te explicamos cómo instalarlo!
* **Git:** Para clonar este repositorio.

---

## Instalación de Composer (Si no lo tienes)

Composer es esencial para los proyectos Laravel. Sigue las instrucciones para tu sistema operativo:

### En Windows

1.  Descarga el instalador de Composer para Windows desde el sitio oficial: [https://getcomposer.org/Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
2.  Ejecuta `Composer-Setup.exe` y sigue las instrucciones. Asegúrate de marcar la opción para añadir Composer a tu PATH durante la instalación.
3.  Una vez finalizada la instalación, abre una nueva ventana del Símbolo del sistema o PowerShell y verifica:
    ```bash
    composer -V
    ```

---

## Pasos para la Configuración del Proyecto

Sigue estos pasos para poner en marcha el proyecto:

1.  **Clona el Repositorio:**
    ```bash
    git clone [https://github.com/WGuandique-2005/LESSAwebapp](https://github.com/WGuandique-2005/LESSAwebapp)
    cd [LESSAwebapp]
    ```

2.  **Instala las Dependencias de Composer:**
    Una vez dentro de la carpeta del proyecto, ejecuta:
    ```bash
    composer install
    ```
    Esto descargará todas las bibliotecas y dependencias que Laravel necesita.

3.  **Configura el Archivo de Entorno (`.env`):**
    Laravel utiliza un archivo `.env` para la configuración específica de tu entorno (base de datos, claves API, etc.).
    * Copia el archivo de ejemplo:
        ```bash
        cp .env.example .env
        ```

4.  **Genera la Clave de Aplicación:**
    Esta clave es crucial para la seguridad de Laravel.
    ```bash
    php artisan key:generate
    ```

5.  **Ejecuta las Migraciones de la Base de Datos:**
    Esto creará las tablas necesarias en tu base de datos.
    ```bash
    php artisan migrate
    ```
6.  **Servir la Aplicación:**
    Puedes usar el servidor de desarrollo de Laravel para probar la aplicación rápidamente:
    ```bash
    php artisan serve
    ```
    Esto iniciará un servidor en `http://127.0.0.1:8000` (o un puerto similar). Abre esta URL en tu navegador.

    **Alternativa (Configuración con Apache/Nginx):**
    Para una configuración más permanente, deberás configurar tu servidor web (Apache o Nginx) para que apunte al directorio `public` de este proyecto. Consulta la documentación de Laravel para más detalles sobre [configuración de servidor](https://laravel.com/docs/11.x/deployment#server-requirements).

- [GPO01-LESSA-2025]
