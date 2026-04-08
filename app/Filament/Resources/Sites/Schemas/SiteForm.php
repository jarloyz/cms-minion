<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\Site;
use Illuminate\Support\Str;

class SiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Tabs::make('Configuración del Sitio')
                    ->tabs([
                        Tab::make('General')
                            ->icon('heroicon-m-building-office')
                            ->components([
                                Section::make('Identidad')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('nombre_empresa')
                                            ->label('Nombre de la empresa')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->label('Slug / URL')
                                            ->required()
                                            ->helperText(fn ($state) => $state ? "Accesible en: " . url("/sitios/{$state}") : null)
                                            ->maxLength(255),
                                        TextInput::make('dominio')
                                            ->label('Dominio Personalizado')
                                            ->placeholder('ej: misitio.com')
                                            ->helperText('Si se configura, el sitio será accesible directamente desde este dominio.')
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        Select::make('tema')
                                            ->label('Tema Visual')
                                            ->options(Site::getThemeSelectOptions())
                                            ->helperText('Elige una paleta y tipografia predefinidas para este sitio.')
                                            ->required()
                                            ->live()
                                            ->native(false),
                                        TextInput::make('logo')
                                            ->label('URL del logo')
                                            ->url()
                                            ->maxLength(255),
                                        Select::make('branding_config.logo_fit')
                                            ->label('Ajuste del logo')
                                            ->options([
                                                'contain' => 'Contain',
                                                'cover' => 'Cover',
                                            ])
                                            ->native(false)
                                            ->default('contain'),
                                        TextInput::make('slogan')
                                            ->label('Slogan')
                                            ->maxLength(255),
                                        TextInput::make('imagen_principal')
                                            ->label('URL de la imagen principal')
                                            ->url()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        TextInput::make('branding_config.logo_height_mobile')
                                            ->label('Altura logo mobile (px)')
                                            ->numeric()
                                            ->default(40),
                                        TextInput::make('branding_config.logo_height_desktop')
                                            ->label('Altura logo desktop (px)')
                                            ->numeric()
                                            ->default(56),
                                        TextInput::make('branding_config.logo_max_width_mobile')
                                            ->label('Ancho maximo logo mobile (px)')
                                            ->numeric()
                                            ->default(96),
                                        TextInput::make('branding_config.logo_max_width_desktop')
                                            ->label('Ancho maximo logo desktop (px)')
                                            ->numeric()
                                            ->default(180)
                                            ->columnSpanFull(),
                                    ]),
                                Section::make('Hero visual')
                                    ->schema([
                                        Repeater::make('hero_config.slides')
                                            ->label('Slides del hero')
                                            ->helperText('Si agregas slides, reemplazan la imagen principal por un slider simple.')
                                            ->schema([
                                                TextInput::make('image')
                                                    ->label('URL de imagen')
                                                    ->url()
                                                    ->required(),
                                                TextInput::make('alt')
                                                    ->label('Texto alternativo')
                                                    ->maxLength(255),
                                            ])
                                            ->columnSpanFull()
                                            ->itemLabel(fn (array $state): ?string => $state['alt'] ?? $state['image'] ?? null),
                                        TextInput::make('hero_config.autoplay_ms')
                                            ->label('Autoplay del slider (ms)')
                                            ->numeric()
                                            ->default(5000),
                                    ]),
                                Section::make('Contacto')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('telefono')
                                            ->label('Telefono')
                                            ->tel()
                                            ->required()
                                            ->maxLength(40),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->maxLength(120),
                                        TextInput::make('direccion')
                                            ->label('Direccion')
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        TextInput::make('social_links.contact_url')
                                            ->label('URL de contacto general')
                                            ->helperText('Puede ser un formulario, Calendly, WhatsApp o pagina de contacto.')
                                            ->url()
                                            ->columnSpanFull(),
                                        TextInput::make('contacto_config.map_embed_url')
                                            ->label('Google Maps embed URL')
                                            ->url()
                                            ->columnSpanFull(),
                                        TextInput::make('contacto_config.facebook_embed_url')
                                            ->label('Facebook embed URL')
                                            ->helperText('Opcional. Solo si quieres mostrar el frame de Facebook en contacto.')
                                            ->url()
                                            ->columnSpanFull(),
                                        Toggle::make('contact_form_config.enabled')
                                            ->label('Activar formulario de contacto')
                                            ->default(true),
                                        TextInput::make('contact_form_config.submit_label')
                                            ->label('Texto del boton')
                                            ->maxLength(60),
                                        TextInput::make('contact_form_config.recipient_email')
                                            ->label('Correo destino del formulario')
                                            ->email()
                                            ->helperText('Si se deja vacio, se usa el email principal del sitio.'),
                                        Textarea::make('contact_form_config.success_message')
                                            ->label('Mensaje de exito')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        Textarea::make('contact_form_config.intro')
                                            ->label('Texto introductorio del formulario')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),
                                Section::make('Call To Action')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('cta_config.enabled')
                                            ->label('Activar CTA extra')
                                            ->default(false),
                                        Select::make('cta_config.placement')
                                            ->label('Ubicacion')
                                            ->options([
                                                'navbar' => 'Navbar',
                                                'hero' => 'Hero',
                                                'contacto' => 'Contacto',
                                            ])
                                            ->native(false)
                                            ->default('navbar'),
                                        TextInput::make('cta_config.label')
                                            ->label('Texto del CTA')
                                            ->maxLength(80),
                                        TextInput::make('cta_config.url')
                                            ->label('URL del CTA')
                                            ->url(),
                                        Select::make('cta_config.style')
                                            ->label('Estilo')
                                            ->options([
                                                'primary' => 'Principal',
                                                'secondary' => 'Secundario',
                                            ])
                                            ->native(false)
                                            ->default('primary'),
                                        Toggle::make('cta_config.open_in_new_tab')
                                            ->label('Abrir en nueva pestana')
                                            ->default(false),
                                    ]),
                                Section::make('Redes Sociales')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('social_links.whatsapp')
                                            ->label('WhatsApp URL')
                                            ->url(),
                                        TextInput::make('social_links.facebook')
                                            ->label('Facebook URL')
                                            ->url(),
                                        TextInput::make('social_links.instagram')
                                            ->label('Instagram URL')
                                            ->url(),
                                        TextInput::make('social_links.linkedin')
                                            ->label('LinkedIn URL')
                                            ->url(),
                                        TextInput::make('social_links.x')
                                            ->label('X / Twitter URL')
                                            ->url(),
                                        TextInput::make('social_links.youtube')
                                            ->label('YouTube URL')
                                            ->url(),
                                        TextInput::make('social_links.tiktok')
                                            ->label('TikTok URL')
                                            ->url(),
                                        TextInput::make('social_links.telegram')
                                            ->label('Telegram URL')
                                            ->url(),
                                    ]),
                            ]),

                        Tab::make('Contenido')
                            ->icon('heroicon-m-photo')
                            ->components([
                                Section::make('Hero')
                                    ->schema([
                                        TextInput::make('titulo_hero')
                                            ->label('Titulo principal')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        Textarea::make('texto_hero')
                                            ->label('Texto principal')
                                            ->required()
                                            ->rows(4)
                                            ->columnSpanFull(),
                                    ]),
                                Section::make('Quienes Somos')
                                    ->schema([
                                        Textarea::make('quienes_somos')
                                            ->label('Texto intro Quiénes somos')
                                            ->required()
                                            ->rows(5)
                                            ->columnSpanFull(),
                                        Repeater::make('caracteristicas')
                                            ->label('Características')
                                            ->schema([
                                                TextInput::make('titulo')->required(),
                                                Textarea::make('descripcion')->required(),
                                                TextInput::make('icono')->label('SVG Path (opcional)'),
                                            ])
                                            ->columnSpanFull()
                                            ->itemLabel(fn (array $state): ?string => $state['titulo'] ?? null),
                                        Textarea::make('company_profile.mission')
                                            ->label('Mision')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Textarea::make('company_profile.vision')
                                            ->label('Vision')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Repeater::make('company_profile.values')
                                            ->label('Valores')
                                            ->schema([
                                                TextInput::make('label')
                                                    ->label('Valor')
                                                    ->required(),
                                            ])
                                            ->columnSpanFull()
                                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                                    ]),
                                Section::make('Servicios')
                                    ->schema([
                                        Repeater::make('servicios')
                                            ->label('Lista de Servicios')
                                            ->schema([
                                                TextInput::make('titulo')->required(),
                                                Textarea::make('descripcion')->required(),
                                                TextInput::make('icono')->label('SVG Path (opcional)'),
                                            ])
                                            ->columnSpanFull()
                                            ->itemLabel(fn (array $state): ?string => $state['titulo'] ?? null),
                                    ]),
                                Section::make('Variantes')
                                    ->schema([
                                        Placeholder::make('variant_help')
                                            ->label('')
                                            ->content('La plantilla sigue siendo la misma, pero puedes cambiar el orden de las secciones principales sin romper la estructura base. Hero siempre se mantiene al inicio.'),
                                        Repeater::make('orden_secciones')
                                            ->label('Orden de secciones')
                                            ->default(Site::getDefaultSectionOrderForForm())
                                            ->schema([
                                                Select::make('seccion')
                                                    ->label('Seccion')
                                                    ->options(Site::getSectionOptions())
                                                    ->required()
                                                    ->native(false),
                                            ])
                                            ->reorderableWithButtons()
                                            ->addable(false)
                                            ->deletable(false)
                                            ->columnSpanFull()
                                            ->itemLabel(fn (array $state): ?string => Site::getSectionOptions()[$state['seccion'] ?? ''] ?? null),
                                    ]),
                                Section::make('Distintivos')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('company_profile.repse_enabled')
                                            ->label('Mostrar distintivo REPSE')
                                            ->default(false),
                                        TextInput::make('company_profile.repse_label')
                                            ->label('Etiqueta del distintivo')
                                            ->maxLength(60),
                                        TextInput::make('company_profile.repse_url')
                                            ->label('URL REPSE')
                                            ->url(),
                                        TextInput::make('company_profile.repse_logo')
                                            ->label('URL del logo REPSE')
                                            ->url(),
                                    ]),
                            ]),

                        Tab::make('Textos de Interfaz')
                            ->icon('heroicon-m-language')
                            ->components([
                                KeyValue::make('textos_ui')
                                    ->label('Textos configurables')
                                    ->keyLabel('Identificador')
                                    ->valueLabel('Texto a mostrar')
                                    ->columnSpanFull()
                                    ->default([
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
                                    ]),
                            ]),

                        Tab::make('Marketing')
                            ->icon('heroicon-m-globe-alt')
                            ->components([
                                Section::make('SEO')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('seo_config.meta_title')
                                            ->label('Meta title')
                                            ->maxLength(255),
                                        Textarea::make('seo_config.meta_description')
                                            ->label('Meta description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        TextInput::make('seo_config.meta_keywords')
                                            ->label('Meta keywords')
                                            ->helperText('Separadas por comas.')
                                            ->columnSpanFull(),
                                        TextInput::make('seo_config.canonical_url')
                                            ->label('Canonical URL')
                                            ->url()
                                            ->columnSpanFull(),
                                        TextInput::make('seo_config.og_title')
                                            ->label('Open Graph title')
                                            ->maxLength(255),
                                        TextInput::make('seo_config.og_image')
                                            ->label('Open Graph image URL')
                                            ->url(),
                                        Textarea::make('seo_config.og_description')
                                            ->label('Open Graph description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Select::make('seo_config.twitter_card')
                                            ->label('Twitter card')
                                            ->options([
                                                'summary' => 'summary',
                                                'summary_large_image' => 'summary_large_image',
                                            ])
                                            ->native(false)
                                            ->default('summary_large_image'),
                                        Toggle::make('seo_config.indexable')
                                            ->label('Permitir indexacion')
                                            ->default(true)
                                            ->helperText('Si lo desactivas, se enviara noindex en metatags y en robots.'),
                                    ]),
                                Section::make('SEM y Tracking')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('tracking_config.google_site_verification')
                                            ->label('Google Site Verification'),
                                        TextInput::make('tracking_config.bing_site_verification')
                                            ->label('Bing Site Verification'),
                                        TextInput::make('tracking_config.google_tag_manager_id')
                                            ->label('Google Tag Manager ID')
                                            ->placeholder('GTM-XXXXXXX'),
                                        TextInput::make('tracking_config.google_analytics_id')
                                            ->label('Google Analytics ID')
                                            ->placeholder('G-XXXXXXXXXX'),
                                        TextInput::make('tracking_config.google_ads_id')
                                            ->label('Google Ads ID')
                                            ->placeholder('AW-XXXXXXXXX'),
                                        TextInput::make('tracking_config.meta_pixel_id')
                                            ->label('Meta Pixel ID'),
                                        TextInput::make('tracking_config.bing_uet_id')
                                            ->label('Bing UET ID'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
