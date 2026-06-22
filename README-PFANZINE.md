# Pfanzine

Proyecto local basado en CarbonPHP/Laravel (estructurado como una app PHP).

![Portada](portada.jpg)

## Descripción

Repositorio con una aplicación PHP; contiene controladores, modelos, rutas y vistas.

## Requisitos

- PHP 8+
- Composer
- Servidor web (XAMPP, Valet, o `php artisan serve`)

## Instalación rápida

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Ejecutar en desarrollo

```bash
php artisan serve
# o colocar la carpeta en el htdocs de XAMPP
```

## Portada

La imagen de portada está en la raíz: `portada.jpg` (ruta: `portada.jpg`). Se mostrará en la vista si la aplicación la referencia.

## Notas

- Ajusta los comandos según tu entorno.
- Si quieres que reemplace el `README.md` existente, dime y lo actualizo.
