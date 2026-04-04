<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        Site::query()->updateOrCreate(
            ['id' => 1],
            [
                'nombre_empresa' => 'Logistica Pro',
                'slug' => 'logistica-pro',
                'logo' => null,
                'imagen_principal' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1200&q=80',
                'color_principal' => '#ea580c',
                'color_secundario' => '#0f172a',
                'telefono' => '+52 55 1234 5678',
                'email' => 'ventas@logisticapro.mx',
                'direccion' => 'Ciudad de Mexico, Mexico',
                'slogan' => 'Operaciones que se ven bien y funcionan mejor.',
                'titulo_hero' => 'Soluciones logisticas claras, rapidas y confiables.',
                'texto_hero' => 'Una plantilla empresarial que puede cambiar de identidad, mensaje e imagen desde un panel central para adaptarse a cada cliente.',
                'quienes_somos' => 'Somos una empresa enfocada en operaciones, distribucion y atencion comercial. Esta demo muestra como un sitio corporativo puede personalizarse en minutos con logo, imagen principal, datos de contacto y secciones informativas.',
                'caracteristicas' => [
                    ['titulo' => 'Confianza', 'descripcion' => 'Operamos con los más altos estándares de seguridad y transparencia para tu tranquilidad.', 'icono' => 'M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z'],
                    ['titulo' => 'Innovación', 'descripcion' => 'Mejoramos continuamente nuestros procesos utilizando tecnología de vanguardia.', 'icono' => 'M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z'],
                    ['titulo' => 'Calidad', 'descripcion' => 'Entregamos resultados excepcionales garantizando la satisfacción de nuestros clientes.', 'icono' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z'],
                ],
                'servicios' => [
                    ['titulo' => 'Especialidad Uno', 'descripcion' => 'Distribucion y ultima milla para marcas y retailers.', 'icono' => 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z'],
                    ['titulo' => 'Especialidad Dos', 'descripcion' => 'Administracion de inventario y trazabilidad operativa.', 'icono' => 'M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.45m.31-.31c.019-.104.039-.208.06-.311'],
                    ['titulo' => 'Especialidad Tres', 'descripcion' => 'Atencion comercial y coordinacion de entregas empresariales.', 'icono' => 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z'],
                ],
                'textos_ui' => [
                    'nav_inicio' => 'Inicio',
                    'nav_nosotros' => 'Nosotros',
                    'nav_servicios' => 'Servicios',
                    'nav_contacto' => 'Contacto',
                    'cta_hero' => 'Contáctanos ahora',
                    'cta_hero_secundario' => 'Ver servicios',
                    'badge_hero' => 'Soluciones Rápidas',
                    'badge_hero_sub' => 'Para tu negocio',
                    'titulo_nosotros' => 'Quiénes Somos',
                    'subtitulo_nosotros' => 'Conoce nuestra historia y propósito',
                    'titulo_servicios' => 'Nuestros Servicios',
                    'subtitulo_servicios' => 'Soluciones a tu medida',
                    'texto_servicios' => 'Descubre cómo podemos ayudarte a alcanzar tus objetivos empresariales con nuestros servicios especializados.',
                    'titulo_contacto' => '¿Listo para empezar?',
                    'texto_contacto' => 'Contáctanos hoy mismo y descubre cómo podemos transformar tu negocio. Nuestro equipo está listo para atenderte.',
                    'label_telefono' => 'Teléfono',
                    'label_email' => 'Email',
                    'label_direccion' => 'Dirección',
                    'footer_derechos' => 'Todos los derechos reservados.',
                ],
            ],
        );
    }
}
