# MVP Setup

## 1. Instalar extensiones faltantes de PHP

```bash
sudo apt-get update
sudo apt-get install -y php8.3-sqlite3 php8.3-intl
```

Si usas PHP-FPM o Valet, reinicia el servicio de PHP despues de instalarlas.

## 2. Levantar la base de datos demo

```bash
php artisan migrate --seed
```

Esto crea:

- Tres sitios demo listos para editar:
  - `Logistica Pro` en `/sitios/logistica-pro`
  - `Devbugging` en `/sitios/devbugging`
  - `Poemas, Historia y Palabras` en `/sitios/poemas-historia-y-palabras`
- Campos empresariales base: logo, imagen principal, hero, quienes somos y contacto
- Un usuario admin para Filament:
  `admin@demo.test`
  password: `password`

Si acabas de integrar Sanctum y aun no has corrido migraciones recientes, ejecuta tambien:

```bash
php artisan migrate
```

## 3. Correr la demo

```bash
php artisan serve
```

Abre:

- Portada de la demo: `http://127.0.0.1:8000`
- Sitios publicos:
  - `http://127.0.0.1:8000/sitios/logistica-pro`
  - `http://127.0.0.1:8000/sitios/devbugging`
  - `http://127.0.0.1:8000/sitios/poemas-historia-y-palabras`
- Panel admin: `http://127.0.0.1:8000/admin`
- Login del panel: `http://127.0.0.1:8000/login`

## 4. Guion rapido de venta

1. Muestra la portada y luego entra a cualquiera de los sitios del catalogo.
2. Entra al panel y edita empresa, slug, logo, imagen principal, tema, textos y contacto.
3. Guarda.
4. Usa el boton `Ver preview` o refresca la URL publica del sitio para mostrar el cambio instantaneo.
