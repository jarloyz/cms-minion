<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Site extends Model
{
    protected $fillable = [
        'nombre_empresa',
        'slug',
        'dominio',
        'tema',
        'logo',
        'imagen_principal',
        'telefono',
        'email',
        'direccion',
        'slogan',
        'titulo_hero',
        'texto_hero',
        'quienes_somos',
        'caracteristicas',
        'servicios',
        'orden_secciones',
        'cta_config',
        'social_links',
        'seo_config',
        'tracking_config',
        'textos_ui',
    ];

    public const DEFAULT_SECTION_ORDER = [
        'nosotros',
        'servicios',
        'contacto',
    ];

    public static function getThemes(): array
    {
        return [
            'modern-blue' => [
                'label' => 'Azul Moderno',
                'description' => 'Azul vibrante sobre slate oscuro',
                'primary' => '#2563eb',
                'secondary' => '#0f172a',
                'accent' => '#60a5fa',
                'secondary_foreground' => '#f8fafc',
                'font_label' => 'Inter',
                'font' => "'Inter', sans-serif",
                'google_font' => 'Inter:wght@300;400;500;600;700;800;900',
            ],
            'dark-emerald' => [
                'label' => 'Esmeralda Oscuro',
                'description' => 'Verde esmeralda sobre bosque profundo',
                'primary' => '#10b981',
                'secondary' => '#064e3b',
                'accent' => '#6ee7b7',
                'secondary_foreground' => '#ecfdf5',
                'font_label' => 'Outfit',
                'font' => "'Outfit', sans-serif",
                'google_font' => 'Outfit:wght@300;400;500;600;700;800;900',
            ],
            'warm-brown' => [
                'label' => 'Tierra Cálido',
                'description' => 'Tonos tierra y crema organicos',
                'primary' => '#92400e',
                'secondary' => '#451a03',
                'accent' => '#fbbf24',
                'secondary_foreground' => '#fffbeb',
                'font_label' => 'Fraunces',
                'font' => "'Fraunces', serif",
                'google_font' => 'Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600;9..144,700',
            ],
            'deep-purple' => [
                'label' => 'Púrpura Eléctrico',
                'description' => 'Violeta electrico sobre purpura oscuro',
                'primary' => '#7c3aed',
                'secondary' => '#2e1065',
                'accent' => '#c4b5fd',
                'secondary_foreground' => '#f5f3ff',
                'font_label' => 'Lexend',
                'font' => "'Lexend', sans-serif",
                'google_font' => 'Lexend:wght@300;400;500;600;700;800;900',
            ],
            'minimal-light' => [
                'label' => 'Mínimo Claro',
                'description' => 'Contraste limpio en blanco y negro',
                'primary' => '#18181b',
                'secondary' => '#f8fafc',
                'accent' => '#64748b',
                'secondary_foreground' => '#18181b',
                'font_label' => 'Plus Jakarta Sans',
                'font' => "'Plus Jakarta Sans', sans-serif",
                'google_font' => 'Plus+Jakarta+Sans:wght@300;400;500;600;700;800',
            ],
            'sunset-orange' => [
                'label' => 'Naranja Atardecer',
                'description' => 'Naranja quemado y grises calidos',
                'primary' => '#ea580c',
                'secondary' => '#431407',
                'accent' => '#fdba74',
                'secondary_foreground' => '#fff7ed',
                'font_label' => 'Inter',
                'font' => "'Inter', sans-serif",
                'google_font' => 'Inter:wght@300;400;500;600;700;800;900',
            ],
        ];
    }

    public static function getThemeSelectOptions(): array
    {
        return self::themeCollection()
            ->mapWithKeys(fn (array $theme, string $key) => [$key => $theme['label']])
            ->all();
    }

    public static function getThemeDescriptions(): array
    {
        return self::themeCollection()
            ->mapWithKeys(fn (array $theme, string $key) => [
                $key => "{$theme['description']} ({$theme['font_label']})",
            ])
            ->all();
    }

    public static function getThemePreview(string $themeKey): ?array
    {
        return self::getThemes()[$themeKey] ?? null;
    }

    protected static function themeCollection(): Collection
    {
        return collect(self::getThemes());
    }

    public function getThemeConfigAttribute(): array
    {
        return self::getThemes()[$this->tema] ?? self::getThemes()['modern-blue'];
    }

    public static function getDefaultCtaConfig(): array
    {
        return [
            'enabled' => false,
            'label' => null,
            'url' => null,
            'style' => 'primary',
            'open_in_new_tab' => false,
            'placement' => 'navbar',
        ];
    }

    public static function getDefaultSocialLinks(): array
    {
        return [
            'whatsapp' => null,
            'facebook' => null,
            'instagram' => null,
            'linkedin' => null,
            'x' => null,
            'youtube' => null,
            'tiktok' => null,
            'telegram' => null,
            'contact_url' => null,
        ];
    }

    public static function getDefaultSeoConfig(): array
    {
        return [
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
            'canonical_url' => null,
            'og_title' => null,
            'og_description' => null,
            'og_image' => null,
            'twitter_card' => 'summary_large_image',
            'indexable' => true,
        ];
    }

    public static function getDefaultTrackingConfig(): array
    {
        return [
            'google_site_verification' => null,
            'bing_site_verification' => null,
            'google_tag_manager_id' => null,
            'google_analytics_id' => null,
            'google_ads_id' => null,
            'meta_pixel_id' => null,
            'bing_uet_id' => null,
        ];
    }

    public function getSeoAttribute(): array
    {
        return array_merge(self::getDefaultSeoConfig(), $this->seo_config ?? []);
    }

    public function getTrackingAttribute(): array
    {
        return array_merge(self::getDefaultTrackingConfig(), $this->tracking_config ?? []);
    }

    public function getCtaAttribute(): array
    {
        return array_merge(self::getDefaultCtaConfig(), $this->cta_config ?? []);
    }

    public function getResolvedSocialLinksAttribute(): array
    {
        return collect(array_merge(self::getDefaultSocialLinks(), $this->social_links ?? []))
            ->filter(fn ($value) => filled($value))
            ->all();
    }

    public function getResolvedMetaTitleAttribute(): string
    {
        return $this->seo['meta_title']
            ?: "{$this->nombre_empresa} | Demo CMS";
    }

    public function getResolvedMetaDescriptionAttribute(): string
    {
        return $this->seo['meta_description']
            ?: ($this->slogan ?: $this->texto_hero);
    }

    public function getResolvedCanonicalUrlAttribute(): ?string
    {
        if ($this->seo['canonical_url']) {
            return $this->seo['canonical_url'];
        }

        if ($this->dominio) {
            return "https://{$this->dominio}";
        }

        if ($this->slug) {
            return url("/sitios/{$this->slug}");
        }

        return null;
    }

    public function getResolvedOgImageAttribute(): ?string
    {
        return $this->seo['og_image'] ?: $this->imagen_principal;
    }

    public static function getSectionOptions(): array
    {
        return [
            'nosotros' => 'Quienes Somos',
            'servicios' => 'Servicios',
            'contacto' => 'Contacto',
        ];
    }

    public static function getDefaultSectionOrderForForm(): array
    {
        return collect(self::DEFAULT_SECTION_ORDER)
            ->map(fn (string $section) => ['seccion' => $section])
            ->all();
    }

    public function getOrderedSectionsAttribute(): array
    {
        $sections = collect($this->orden_secciones ?? [])
            ->map(function ($item) {
                if (is_array($item)) {
                    return $item['seccion'] ?? null;
                }

                return is_string($item) ? $item : null;
            })
            ->filter()
            ->unique()
            ->values();

        return $sections
            ->concat(self::DEFAULT_SECTION_ORDER)
            ->filter(fn (string $section) => array_key_exists($section, self::getSectionOptions()))
            ->unique()
            ->values()
            ->all();
    }

    protected function casts(): array
    {
        return [
            'caracteristicas' => 'array',
            'servicios' => 'array',
            'orden_secciones' => 'array',
            'cta_config' => 'array',
            'social_links' => 'array',
            'seo_config' => 'array',
            'tracking_config' => 'array',
            'textos_ui' => 'array',
        ];
    }
}
