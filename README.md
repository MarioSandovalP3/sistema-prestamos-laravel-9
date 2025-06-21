# Sistema de Gestión de Préstamos

![Laravel](https://img.shields.io/badge/Laravel-9-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4.svg)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1.svg)
![License](https://img.shields.io/badge/License-MIT-blue.svg)

Aplicación web completa para la gestión de préstamos, pagos y socios, desarrollada con Laravel 9. Incluye sistema de roles, reportes y seguimiento de transacciones.

## 🚀 Características principales

- ✅ Gestión completa de socios/clientes.
- ✅ Sistema de préstamos con cálculos automáticos.
- ✅ Registro y seguimiento de pagos.
- ✅ Roles y permisos (Admin, Usuarios).
- ✅ Generación de comprobantes.
- ✅ Notificación por por correo electrónico.


## 📋 Requisitos del sistema

- PHP >= 8.0
- Composer >= 2.0
- Node.js >= 14
- MySQL >= 5.7 o MariaDB >= 10.3
- Extensión PHP para tu base de datos
- Extensión PHP Fileinfo habilitada

## 🛠️ Instalación

Sigue estos pasos para configurar el proyecto localmente:

1. **Clonar el repositorio**
```bash
git clone https://github.com/MarioSandovalP3/sistema-prestamos-laravel-9.git
cd sistema-prestamos-laravel-9
```

2. **Instalar dependencias PHP:**
```bash
composer install
```

3. **Instalar dependencias JavaScript:**
```bash
npm install
npm run dev
```

4. **Configurar entorno:**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar base de datos en `.env`:**
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prestamos
DB_USERNAME=root
DB_PASSWORD=
```

6. **Ejecutar migraciones y seeders:**
```bash
php artisan migrate --seed
```

## Configuración Storage Link

El sistema necesita un enlace simbólico para acceder a archivos almacenados (como imágenes de socios y comprobantes de pago). Esto se configura automáticamente con:

```bash
php artisan storage:link
```

Esto creará un enlace de `public/storage` → `storage/app/public`

## Credenciales de prueba

- Admin: admin@email.com
- Usuario: admin123

## Estructura principal

- Gestión de Socios (`Partners`)
- Gestión de Préstamos (`Loans`) 
- Gestión de Pagos (`Payments`)
- Sistema de Roles y Permisos
