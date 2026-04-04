<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Schema;
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
                        Tab::make('Información Principal')
                            ->icon('heroicon-m-building-office')
                            ->components([
                                TextInput::make('nombre_empresa')
                                    ->label('Nombre de la empresa')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->label('Slug / URL')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('logo')
                                    ->label('URL del logo')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('imagen_principal')
                                    ->label('URL de la imagen principal')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                ColorPicker::make('color_principal')
                                    ->label('Color principal')
                                    ->required(),
                                ColorPicker::make('color_secundario')
                                    ->label('Color secundario')
                                    ->required(),
                                TextInput::make('slogan')
                                    ->label('Slogan')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Tab::make('Contacto')
                            ->icon('heroicon-m-phone')
                            ->components([
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
                            ])->columns(2),

                        Tab::make('Hero (Portada)')
                            ->icon('heroicon-m-photo')
                            ->components([
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

                        Tab::make('Quiénes Somos')
                            ->icon('heroicon-m-users')
                            ->components([
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
                            ]),

                        Tab::make('Servicios')
                            ->icon('heroicon-m-briefcase')
                            ->components([
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
                    ]),
            ]);
    }
}
