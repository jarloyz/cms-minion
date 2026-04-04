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

- Un sitio demo con nombre `Logistica Pro`
- URL publica demo: `/sitios/logistica-pro`
- Campos empresariales base: logo, imagen principal, hero, quienes somos y contacto
- Un usuario admin para Filament:
  `admin@demo.test`
  password: `password`

## 3. Correr la demo

```bash
php artisan serve
```

Abre:

- Portada de la demo: `http://127.0.0.1:8000`
- Sitio publico: `http://127.0.0.1:8000/sitios/logistica-pro`
- Panel admin: `http://127.0.0.1:8000/admin`

## 4. Guion rapido de venta

1. Muestra la portada y luego entra al sitio en `/sitios/logistica-pro`.
2. Entra al panel y edita empresa, slug, logo, imagen principal, color, textos y contacto.
3. Guarda.
4. Usa el boton `Ver preview` o refresca `/sitios/logistica-pro` para mostrar el cambio instantaneo.
