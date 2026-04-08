<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class NutronikSiteSeeder extends Seeder
{
    public function run(): void
    {
        Site::query()->updateOrCreate(
            ['slug' => 'nutronik'],
            [
                'nombre_empresa' => 'Nutronik S.A. de C.V.',
                'slug' => 'nutronik',
                'dominio' => 'nutronikmx.com',
                'tema' => 'sunset-orange',
                'logo' => '/seed-assets/nutronik/logo.png',
                'imagen_principal' => '/seed-assets/nutronik/hero.jpg',
                'telefono' => 'Hoteles, restaurantes y eventos',
                'email' => 'contacto@nutronikmx.com',
                'direccion' => 'Av. Ejercito Nacional 505, Piso 10, Oficina 5, Col. Granada, Miguel Hidalgo, 11520, CDMX',
                'slogan' => 'Servicios especializados de alimentos y bebidas con atencion profesional.',
                'titulo_hero' => 'Operacion, servicio y alimentos listos para hoteles, restaurantes, cafeterias y eventos.',
                'texto_hero' => 'Nutronik presta servicios especializados con personal altamente capacitado para la atencion de hoteles, restaurantes, cafeterias, bares, eventos sociales y operacion de alimentos y bebidas en general.',
                'quienes_somos' => 'En Nutronik entendemos las necesidades de cada cliente para ofrecer un servicio profesional, agil y comprometido. Buscamos relaciones de largo plazo, nos adaptamos a requerimientos complejos o sencillos y trabajamos con atencion personalizada para garantizar experiencias consistentes y de calidad.',
                'caracteristicas' => [
                    [
                        'titulo' => 'Mision clara',
                        'descripcion' => 'Satisfacer las necesidades de alimentacion y bebidas con higiene, presentacion, sabor, calidad, cantidad y una atencion personalizada.',
                        'icono' => 'M12 8.25c-2.485 0-4.5 1.68-4.5 3.75 0 1.484 1.035 2.767 2.536 3.374L10.5 21h3l.464-5.626C15.465 14.767 16.5 13.484 16.5 12c0-2.07-2.015-3.75-4.5-3.75z',
                    ],
                    [
                        'titulo' => 'Vision de crecimiento',
                        'descripcion' => 'Consolidarnos como una empresa fuerte en la elaboracion de alimentos y bebidas para operaciones empresariales y eventos.',
                        'icono' => 'M2.25 12c2.485-4.5 5.735-6.75 9.75-6.75s7.265 2.25 9.75 6.75c-2.485 4.5-5.735 6.75-9.75 6.75S4.735 16.5 2.25 12zm9.75 3a3 3 0 100-6 3 3 0 000 6z',
                    ],
                    [
                        'titulo' => 'Valores de servicio',
                        'descripcion' => 'Compromiso, servicio, honestidad, etica y lealtad como base de cada operacion con nuestros clientes.',
                        'icono' => 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z',
                    ],
                ],
                'servicios' => [
                    [
                        'titulo' => 'Catering y eventos',
                        'descripcion' => 'Servicio de catering dentro o fuera de instalaciones, eventos especiales y barra de cocteleria para eventos privados.',
                        'icono' => 'M11.25 3v2.25m1.5 0V3m-6 5.25h10.5M6 18.75h12A2.25 2.25 0 0020.25 16.5v-7.5A2.25 2.25 0 0018 6.75H6A2.25 2.25 0 003.75 9v7.5A2.25 2.25 0 006 18.75z',
                    ],
                    [
                        'titulo' => 'Comedores y cafeteria',
                        'descripcion' => 'Operacion de comedor ejecutivo, comedor industrial, cafeteria de autoservicio y areas de snacks.',
                        'icono' => 'M8.25 6.75h7.5m-9 4.5h10.5m-9 4.5h7.5M5.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V5.25A2.25 2.25 0 015.25 3z',
                    ],
                    [
                        'titulo' => 'Soluciones para empresas',
                        'descripcion' => 'Coffee break, box lunch, barras para eventos corporativos y servicios de atencion a restaurantes.',
                        'icono' => 'M3.75 6.75h16.5M6.75 3v3.75m10.5-3.75v3.75M6 21h12a2.25 2.25 0 002.25-2.25V8.25A2.25 2.25 0 0018 6H6A2.25 2.25 0 003.75 8.25v10.5A2.25 2.25 0 006 21z',
                    ],
                ],
                'orden_secciones' => Site::getDefaultSectionOrderForForm(),
                'cta_config' => array_merge(Site::getDefaultCtaConfig(), [
                    'enabled' => true,
                    'label' => 'Solicitar propuesta',
                    'url' => 'mailto:contacto@nutronikmx.com',
                    'placement' => 'navbar',
                    'style' => 'primary',
                ]),
                'social_links' => array_merge(Site::getDefaultSocialLinks(), [
                    'facebook' => 'https://www.facebook.com/NutronikCdMx',
                    'contact_url' => 'mailto:contacto@nutronikmx.com',
                ]),
                'seo_config' => array_merge(Site::getDefaultSeoConfig(), [
                    'meta_title' => 'Nutronik S.A. de C.V.',
                    'meta_description' => 'Servicios especializados de alimentos y bebidas para hoteles, restaurantes, cafeterias, bares y eventos en Ciudad de Mexico.',
                    'meta_keywords' => 'catering, comedor industrial, comedor ejecutivo, coffee break, box lunch, eventos, Nutronik',
                    'canonical_url' => 'https://nutronikmx.com',
                    'og_image' => '/seed-assets/nutronik/hero.jpg',
                ]),
                'tracking_config' => Site::getDefaultTrackingConfig(),
                'hero_config' => array_merge(Site::getDefaultHeroConfig(), [
                    'slides' => [
                        [
                            'image' => '/seed-assets/nutronik/hero.jpg',
                            'alt' => 'Servicio de alimentos y bebidas Nutronik',
                        ],
                        [
                            'image' => '/seed-assets/nutronik/hero-2.jpg',
                            'alt' => 'Operacion especializada para eventos y comedor',
                        ],
                    ],
                    'autoplay_ms' => 5000,
                ]),
                'contacto_config' => array_merge(Site::getDefaultContactoConfig(), [
                    'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.402554868253!2d-99.1928293849425!3d19.43820328688122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2020768aeb6b9%3A0xa4e16dfe2cb38711!2sAv.%20Ej%C3%A9rcito%20Nacional%20Mexicano%20505%2C%20Chapultepec%20Morales%2C%20Granada%2C%20Miguel%20Hidalgo%2C%2011520%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1664923338543!5m2!1ses-419!2smx',
                    'facebook_embed_url' => null,
                ]),
                'company_profile' => array_merge(Site::getDefaultCompanyProfile(), [
                    'mission' => 'Satisfacer las necesidades de alimentacion y bebidas de nuestros clientes, ofreciendo variedad mediante un optimo servicio y atencion personalizada, integrando higiene, presentacion, sabor, calidad, cantidad y atencion.',
                    'vision' => 'Ser una empresa fuertemente consolidada en la elaboracion de alimentos y bebidas.',
                    'values' => ['Compromiso', 'Servicio', 'Honestidad', 'Etica', 'Lealtad'],
                    'repse_enabled' => true,
                    'repse_label' => 'Registro REPSE',
                    'repse_url' => 'https://repse.stps.gob.mx/',
                    'repse_logo' => '/seed-assets/nutronik/logo-repse.png',
                ]),
                'contact_form_config' => array_merge(Site::getDefaultContactFormConfig(), [
                    'enabled' => true,
                    'recipient_email' => 'contacto@nutronikmx.com',
                    'submit_label' => 'Enviar',
                    'success_message' => 'Gracias por escribir a Nutronik. Tu mensaje fue enviado correctamente.',
                    'intro' => 'Completa el formulario para una mejor experiencia y uno de nuestros asesores te dara seguimiento.',
                ]),
                'textos_ui' => [
                    'nav_inicio' => 'Inicio',
                    'nav_nosotros' => 'Quienes Somos',
                    'nav_servicios' => 'Servicios',
                    'nav_contacto' => 'Contacto',
                    'cta_hero' => 'Contactar ahora',
                    'cta_hero_secundario' => 'Ver servicios',
                    'badge_hero' => 'Servicios especializados',
                    'badge_hero_sub' => 'Alimentos y bebidas',
                    'titulo_nosotros' => 'Quienes Somos',
                    'subtitulo_nosotros' => 'Atencion profesional para operaciones de alimentos y eventos',
                    'titulo_servicios' => 'Servicios',
                    'subtitulo_servicios' => 'Cobertura flexible para empresas, restaurantes y eventos',
                    'texto_servicios' => 'La plantilla actual resume la oferta principal de Nutronik y deja una base lista para seguir ajustando mensajes, secciones y activos visuales.',
                    'titulo_contacto' => 'Hablemos de tu operacion o tu siguiente evento',
                    'texto_contacto' => 'Escribenos para cotizar servicios de alimentos, bebidas, comedores, coffee break, box lunch o eventos especiales en Ciudad de Mexico.',
                    'label_telefono' => 'Cobertura',
                    'label_email' => 'Correo',
                    'label_direccion' => 'Ubicacion',
                    'footer_derechos' => 'Todos los derechos reservados.',
                ],
            ],
        );
    }
}
