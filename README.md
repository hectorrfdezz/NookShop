# NookShop

NookShop es una aplicación web desarrollada con **Laravel 10** que incluye sistema de autenticación con verificación de correo electrónico, gestión de perfil con geolocalización y un CRUD de elementos personalizados.

---

## Funcionalidades

- ✅ Registro y login de usuarios  
- ✅ Verificación obligatoria de email  
- ✅ Gestión de perfil  
- ✅ Geoposicionamiento con Google Maps  
- ✅ Consulta del clima mediante OpenWeather API  
- ✅ CRUD completo de elementos (Items)  
- ✅ Relación User → Items (1:N)  
- ✅ Protección de rutas con middleware (`auth` y `verified`)  

---

## Tecnologías utilizadas

- Laravel 10  
- PHP 8.1+  
- MySQL  
- Bootstrap 5  
- Google Maps API  
- OpenWeather API  

---

## Instalación

1. Clonar o descomprimir el proyecto.
2. Instalar dependencias:
   ```bash
   composer install
   npm install
3. Copiar archivo .env:
    cp .env.example .env
4. Configurar base de datos y claves API en .env:
    GOOGLE_MAPS_API_KEY=
    OPENWEATHER_API_KEY=
5. Generar clave y migrar:
    php artisan key:generate
    php artisan migrate
6. Ejecutar servidor:
    php artisan serve
