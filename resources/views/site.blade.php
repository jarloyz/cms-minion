<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
@php
    $orderedSections = $site->ordered_sections;
    $seo = $site->seo;
    $tracking = $site->tracking;
    $cta = $site->cta;
    $hero = $site->hero;
    $contacto = $site->contacto;
    $companyProfile = $site->company_profile;
    $contactForm = $site->contact_form;
    $branding = $site->branding;
    $socialLinks = $site->resolved_social_links;
    $currentUrl = $site->resolved_canonical_url ?: url()->current();
    $metaTitle = $site->resolved_meta_title;
    $metaDescription = $site->resolved_meta_description;
    $ogTitle = $seo['og_title'] ?: $metaTitle;
    $ogDescription = $seo['og_description'] ?: $metaDescription;
    $ogImage = $site->resolved_og_image;
    $robotsContent = $seo['indexable'] ? 'index,follow,max-image-preview:large' : 'noindex,nofollow';
    $ctaTarget = $cta['open_in_new_tab'] ? '_blank' : '_self';
    $heroSlides = collect($hero['slides'] ?? [])
        ->filter(fn ($slide) => is_array($slide) && filled($slide['image'] ?? null))
        ->values();
    $facebookEmbedUrl = $contacto['facebook_embed_url']
        ? preg_replace('/([?&])width=\d+/', '$1width=500', $contacto['facebook_embed_url'])
        : null;
    $facebookEmbedUrl = $facebookEmbedUrl
        ? preg_replace('/([?&])height=\d+/', '$1height=620', $facebookEmbedUrl)
        : null;
    $requestHost = request()->getHost();
    $cleanRequestHost = str_replace('www.', '', $requestHost);
    $cleanSiteDomain = str_replace('www.', '', (string) $site->dominio);
    $usesCustomDomain = filled($site->dominio) && $cleanRequestHost === $cleanSiteDomain;
    $contactAction = $usesCustomDomain
        ? route('sites.contact.domain', ['domain' => $requestHost])
        : route('sites.contact.slug', ['slug' => $site->slug]);
    $logoObjectFitClass = ($branding['logo_fit'] ?? 'contain') === 'cover' ? 'object-cover' : 'object-contain';
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    @if ($seo['meta_keywords'])
        <meta name="keywords" content="{{ $seo['meta_keywords'] }}">
    @endif
    <meta name="robots" content="{{ $robotsContent }}">
    <meta name="googlebot" content="{{ $robotsContent }}">
    <meta name="bingbot" content="{{ $robotsContent }}">
    @if ($currentUrl)
        <link rel="canonical" href="{{ $currentUrl }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    @if ($currentUrl)
        <meta property="og:url" content="{{ $currentUrl }}">
    @endif
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta name="twitter:card" content="{{ $seo['twitter_card'] }}">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    @if ($ogImage)
        <meta name="twitter:image" content="{{ $ogImage }}">
    @endif
    @if ($tracking['google_site_verification'])
        <meta name="google-site-verification" content="{{ $tracking['google_site_verification'] }}">
    @endif
    @if ($tracking['bing_site_verification'])
        <meta name="msvalidate.01" content="{{ $tracking['bing_site_verification'] }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    @if ($tracking['google_tag_manager_id'])
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $tracking['google_tag_manager_id'] }}');
        </script>
    @elseif ($tracking['google_analytics_id'])
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tracking['google_analytics_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $tracking['google_analytics_id'] }}');
        </script>
    @endif
    @if ($tracking['google_ads_id'])
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tracking['google_ads_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $tracking['google_ads_id'] }}');
        </script>
    @endif
    @if ($tracking['meta_pixel_id'])
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $tracking['meta_pixel_id'] }}');
            fbq('track', 'PageView');
        </script>
    @endif
    @if ($tracking['bing_uet_id'])
        <script>
            (function(w,d,t,r,u){
                var f,n,i;w[u]=w[u]||[],f=function(){
                    var o={ti:"{{ $tracking['bing_uet_id'] }}"};
                    o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")
                },n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){
                    var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)
                },i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)
            })(window,document,"script","https://bat.bing.com/bat.js","uetq");
        </script>
    @endif
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: 'var(--color-marca)',
                            light: 'color-mix(in srgb, var(--color-marca) 15%, white)',
                            dark: 'color-mix(in srgb, var(--color-marca) 85%, black)',
                        },
                        accent: 'var(--color-acento)',
                        secondary: 'var(--color-secundario)',
                    },
                    fontFamily: {
                        sans: ['var(--font-family)', 'Inter', 'system-ui', 'sans-serif'],
                        serif: ['var(--font-family)', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family={{ $site->theme_config['google_font'] }}&display=swap');

        :root {
            --color-marca: {{ $site->theme_config['primary'] }};
            --color-secundario: {{ $site->theme_config['secondary'] }};
            --color-acento: {{ $site->theme_config['accent'] }};
            --color-secundario-foreground: {{ $site->theme_config['secondary_foreground'] }};
            --font-family: {{ $site->theme_config['font'] }};
        }

        body {
            font-family: var(--font-family);
            background-color: #f8fafc;
        }

        .text-balance {
            text-wrap: balance;
        }

        .secondary-copy {
            color: var(--color-secundario-foreground);
        }

        .secondary-copy-muted {
            color: color-mix(in srgb, var(--color-secundario-foreground) 72%, transparent);
        }

        .hero-slide {
            display: none;
        }

        .hero-slide.is-active {
            display: block;
        }

        @media (min-width: 768px) {
            .site-logo-adaptive {
                height: {{ max((int) ($branding['logo_height_desktop'] ?? 56), 24) }}px !important;
                max-width: {{ max((int) ($branding['logo_max_width_desktop'] ?? 180), 32) }}px !important;
            }
        }
    </style>
</head>
<body
    class="text-slate-800 antialiased selection:bg-brand selection:text-white flex flex-col min-h-screen"
    @if ($heroSlides->count() > 1)
        data-hero-slider
        data-hero-interval="{{ max((int) ($hero['autoplay_ms'] ?? 5000), 1500) }}"
    @endif
>
    @if ($tracking['google_tag_manager_id'])
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $tracking['google_tag_manager_id'] }}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    @endif
    @if ($tracking['meta_pixel_id'])
        <noscript>
            <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $tracking['meta_pixel_id'] }}&ev=PageView&noscript=1"/>
        </noscript>
    @endif

    <!-- Navbar -->
    <header class="fixed inset-x-0 top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50 transition-all duration-300">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                @if ($site->logo)
                    <img
                        src="{{ $site->logo }}"
                        alt="{{ $site->nombre_empresa }}"
                        class="site-logo-adaptive {{ $logoObjectFitClass }} shrink-0 shadow-sm"
                        style="height: {{ max((int) ($branding['logo_height_mobile'] ?? 40), 24) }}px; max-width: {{ max((int) ($branding['logo_max_width_mobile'] ?? 96), 32) }}px;"
                    >
                @else
                    <div class="flex h-10 w-10 md:h-12 md:w-12 items-center justify-center rounded-xl bg-secondary shadow-sm text-white font-bold text-xl">
                        {{ substr($site->nombre_empresa, 0, 1) }}
                    </div>
                @endif
                <div class="flex flex-col">
                    <span class="text-lg font-bold tracking-tight text-slate-900 leading-none">{{ $site->nombre_empresa }}</span>
                    @if ($site->slogan)
                        <span class="text-xs text-slate-500 font-medium hidden sm:block mt-1">{{ $site->slogan }}</span>
                    @endif
                </div>
            </div>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="#inicio" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_inicio'] ?? 'Inicio' }}</a>
                @foreach ($orderedSections as $section)
                    @if ($section === 'nosotros')
                        <a href="#nosotros" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_nosotros'] ?? 'Nosotros' }}</a>
                    @elseif ($section === 'servicios')
                        <a href="#servicios" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_servicios'] ?? 'Servicios' }}</a>
                    @elseif ($section === 'contacto')
                        <a href="#contacto" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_contacto'] ?? 'Contacto' }}</a>
                    @endif
                @endforeach
            </nav>

            <div class="flex items-center gap-4">
                @if ($companyProfile['repse_enabled'] && $companyProfile['repse_url'])
                    <a href="{{ $companyProfile['repse_url'] }}" target="_blank" rel="noreferrer noopener" class="hidden lg:inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-900">
                        @if ($companyProfile['repse_logo'])
                            <img src="{{ $companyProfile['repse_logo'] }}" alt="{{ $companyProfile['repse_label'] }}" class="h-5 w-auto">
                        @endif
                        <span>{{ $companyProfile['repse_label'] }}</span>
                    </a>
                @endif
                @if ($cta['enabled'] && $cta['placement'] === 'navbar' && $cta['label'] && $cta['url'])
                    <a href="{{ $cta['url'] }}" target="{{ $ctaTarget }}" @if($cta['open_in_new_tab']) rel="noreferrer noopener" @endif class="hidden md:inline-flex items-center justify-center rounded-full {{ $cta['style'] === 'secondary' ? 'border border-slate-200 bg-white text-slate-700 hover:border-slate-300' : 'bg-brand text-white hover:bg-brand-dark' }} px-5 py-2.5 text-sm font-semibold shadow-sm transition-all">
                        {{ $cta['label'] }}
                    </a>
                @endif
                <!-- Mobile menu button -->
                <button type="button" class="md:hidden rounded-md p-2 text-slate-600 hover:bg-slate-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <main class="flex-grow pt-20">
        @unless ($dbReady)
            <div class="bg-amber-50 border-b border-amber-200 px-6 py-3 text-center text-sm font-medium text-amber-800">
                ⚠️ Modo Demo: Mostrando datos de ejemplo. Configura la base de datos para persistir cambios.
            </div>
        @endunless

        <!-- Hero Section -->
        <section id="inicio" class="relative overflow-hidden bg-white isolate">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-brand to-secondary opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>

            <div class="mx-auto max-w-7xl px-6 lg:px-8 py-24 sm:py-32 lg:py-40">
                <div class="grid lg:grid-cols-2 gap-16 lg:gap-8 items-center">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-6xl text-balance">
                            {{ $site->titulo_hero }}
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-balance">
                            {{ $site->texto_hero }}
                        </p>
                        <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-4">
                            <a href="#contacto" class="rounded-full bg-brand px-6 py-3.5 text-sm font-semibold text-white shadow-md hover:bg-brand-dark transition-all hover:-translate-y-0.5">
                                {{ $site->textos_ui['cta_hero'] ?? 'Contáctanos ahora' }}
                            </a>
                            <a href="#servicios" class="text-sm font-semibold leading-6 text-slate-900 flex items-center gap-2 group">
                                {{ $site->textos_ui['cta_hero_secundario'] ?? 'Ver servicios' }} <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                            @if ($cta['enabled'] && $cta['placement'] === 'hero' && $cta['label'] && $cta['url'])
                                <a href="{{ $cta['url'] }}" target="{{ $ctaTarget }}" @if($cta['open_in_new_tab']) rel="noreferrer noopener" @endif class="rounded-full {{ $cta['style'] === 'secondary' ? 'border border-slate-300 bg-white text-slate-900' : 'bg-secondary text-white' }} px-6 py-3.5 text-sm font-semibold shadow-sm transition-all hover:-translate-y-0.5">
                                    {{ $cta['label'] }}
                                </a>
                            @endif
                            @if ($companyProfile['repse_enabled'] && $companyProfile['repse_url'])
                                <a href="{{ $companyProfile['repse_url'] }}" target="_blank" rel="noreferrer noopener" class="inline-flex items-center gap-3 rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-900">
                                    @if ($companyProfile['repse_logo'])
                                        <img src="{{ $companyProfile['repse_logo'] }}" alt="{{ $companyProfile['repse_label'] }}" class="h-6 w-auto">
                                    @endif
                                    <span>{{ $companyProfile['repse_label'] }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="relative lg:ml-auto w-full max-w-xl xl:max-w-none">
                        <div class="relative rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-slate-900/10">
                            @if ($heroSlides->isNotEmpty())
                                <div class="relative overflow-hidden rounded-xl bg-slate-100 shadow-inner aspect-[4/3]">
                                    @foreach ($heroSlides as $index => $slide)
                                        <img
                                            src="{{ $slide['image'] }}"
                                            alt="{{ $slide['alt'] ?? ('Slide ' . ($index + 1)) }}"
                                            class="hero-slide {{ $index === 0 ? 'is-active' : '' }} w-full h-full object-cover"
                                            data-hero-slide
                                        >
                                    @endforeach

                                    @if ($heroSlides->count() > 1)
                                        <div class="absolute inset-x-0 bottom-4 flex justify-center gap-2">
                                            @foreach ($heroSlides as $index => $slide)
                                                <button
                                                    type="button"
                                                    class="h-2.5 w-2.5 rounded-full bg-white/70 transition data-[active=true]:w-8 data-[active=true]:bg-white"
                                                    data-hero-dot
                                                    data-slide-index="{{ $index }}"
                                                    data-active="{{ $index === 0 ? 'true' : 'false' }}"
                                                    aria-label="Ir al slide {{ $index + 1 }}"
                                                ></button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @else
                                <img src="{{ $site->imagen_principal }}" alt="Imagen principal" class="w-full rounded-xl bg-slate-100 object-cover aspect-[4/3] shadow-inner">
                            @endif

                            <div class="absolute -bottom-6 -left-6 rounded-2xl bg-white p-4 shadow-xl ring-1 ring-slate-900/10 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                                <div class="rounded-full bg-brand-light p-3">
                                    <svg class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $site->textos_ui['badge_hero'] ?? 'Soluciones Rápidas' }}</p>
                                    <p class="text-xs text-accent">{{ $site->textos_ui['badge_hero_sub'] ?? 'Para tu negocio' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($orderedSections as $section)
            @if ($section === 'nosotros')
                <section id="nosotros" class="py-24 sm:py-32 bg-slate-50">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:mx-0">
                            <h2 class="text-base font-semibold leading-7 text-brand uppercase tracking-wide">{{ $site->textos_ui['titulo_nosotros'] ?? 'Quiénes Somos' }}</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">{{ $site->textos_ui['subtitulo_nosotros'] ?? 'Conoce nuestra historia y propósito' }}</p>
                            <p class="mt-6 text-lg leading-8 text-slate-600">
                                {{ $site->quienes_somos }}
                            </p>
                        </div>
                        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                                @if(!empty($site->caracteristicas) && is_array($site->caracteristicas))
                                    @foreach($site->caracteristicas as $caracteristica)
                                        <div class="flex flex-col">
                                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-slate-900">
                                                <svg class="h-5 w-5 flex-none text-brand" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="{{ $caracteristica['icono'] ?? 'M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z' }}" clip-rule="evenodd" />
                                                </svg>
                                                {{ $caracteristica['titulo'] ?? '' }}
                                            </dt>
                                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                                                <p class="flex-auto">{{ $caracteristica['descripcion'] ?? '' }}</p>
                                            </dd>
                                        </div>
                                    @endforeach
                                @endif
                            </dl>
                        </div>
                        @if ($companyProfile['mission'] || $companyProfile['vision'] || !empty($companyProfile['values']))
                            <div class="mt-16 grid grid-cols-1 gap-6 lg:grid-cols-3">
                                @if ($companyProfile['mission'])
                                    <article class="rounded-3xl border border-amber-200 bg-white p-8 shadow-sm">
                                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-700">Mision</p>
                                        <p class="mt-4 text-base leading-7 text-slate-700">{{ $companyProfile['mission'] }}</p>
                                    </article>
                                @endif
                                @if ($companyProfile['vision'])
                                    <article class="rounded-3xl border border-emerald-200 bg-white p-8 shadow-sm">
                                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Vision</p>
                                        <p class="mt-4 text-base leading-7 text-slate-700">{{ $companyProfile['vision'] }}</p>
                                    </article>
                                @endif
                                @if (!empty($companyProfile['values']))
                                    <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-700">Valores</p>
                                        <ul class="mt-4 space-y-3 text-base leading-7 text-slate-700">
                                            @foreach ($companyProfile['values'] as $value)
                                                <li class="flex items-center gap-3">
                                                    <span class="inline-flex h-2.5 w-2.5 rounded-full bg-brand"></span>
                                                    <span>{{ $value }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </article>
                                @endif
                            </div>
                        @endif
                    </div>
                </section>
            @elseif ($section === 'servicios')
                <section id="servicios" class="py-24 sm:py-32 bg-white">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl text-center">
                            <h2 class="text-base font-semibold leading-7 text-brand uppercase tracking-wide">{{ $site->textos_ui['titulo_servicios'] ?? 'Nuestros Servicios' }}</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">{{ $site->textos_ui['subtitulo_servicios'] ?? 'Soluciones a tu medida' }}</p>
                            <p class="mt-6 text-lg leading-8 text-slate-600">{{ $site->textos_ui['texto_servicios'] ?? 'Descubre cómo podemos ayudarte a alcanzar tus objetivos empresariales con nuestros servicios especializados.' }}</p>
                        </div>
                        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                            <div class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-3">
                                @if(!empty($site->servicios) && is_array($site->servicios))
                                    @foreach($site->servicios as $servicio)
                                    <div class="relative group rounded-3xl bg-slate-50 p-8 ring-1 ring-slate-200 transition-all hover:shadow-xl hover:-translate-y-1">
                                        <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-light">
                                            <svg class="h-7 w-7 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $servicio['icono'] ?? 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z' }}" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold leading-8 text-slate-900 group-hover:text-brand transition-colors">{{ $servicio['titulo'] ?? '' }}</h3>
                                        <p class="mt-4 text-base leading-7 text-slate-600">{{ $servicio['descripcion'] ?? '' }}</p>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @elseif ($section === 'contacto')
                <section id="contacto" class="relative isolate bg-secondary py-24 sm:py-32">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:mx-0 secondary-copy">
                            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $site->textos_ui['titulo_contacto'] ?? '¿Listo para empezar?' }}</h2>
                            <p class="mt-6 text-lg leading-8 secondary-copy-muted">{{ $site->textos_ui['texto_contacto'] ?? 'Contáctanos hoy mismo y descubre cómo podemos transformar tu negocio. Nuestro equipo está listo para atenderte.' }}</p>
                        </div>

                        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 sm:mt-20 lg:max-w-none lg:grid-cols-3">
                            <div class="flex gap-x-6 rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.09-7.074-7.07L8.03 8.35a1.125 1.125 0 00.417-1.173L7.34 2.748A1.125 1.125 0 006.25 1.9h-1.37A2.25 2.25 0 002.25 4.15v2.6z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold leading-7 secondary-copy">{{ $site->textos_ui['label_telefono'] ?? 'Teléfono' }}</h3>
                                    <p class="mt-2 leading-7 secondary-copy-muted">{{ $site->telefono }}</p>
                                </div>
                            </div>

                            @if($site->email)
                            <div class="flex gap-x-6 rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold leading-7 secondary-copy">{{ $site->textos_ui['label_email'] ?? 'Email' }}</h3>
                                    <p class="mt-2 leading-7 secondary-copy-muted">{{ $site->email }}</p>
                                </div>
                            </div>
                            @endif

                            @if($site->direccion)
                            <div class="flex gap-x-6 rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold leading-7 secondary-copy">{{ $site->textos_ui['label_direccion'] ?? 'Dirección' }}</h3>
                                    <p class="mt-2 leading-7 secondary-copy-muted">{{ $site->direccion }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if (session('contact_success'))
                            <div class="mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-900">
                                {{ session('contact_success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mt-8 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-900">
                                <p class="font-semibold">No pudimos enviar tu mensaje.</p>
                                <ul class="mt-2 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($contactForm['enabled'])
                            <div class="mt-12 rounded-[2rem] bg-white p-8 text-slate-900 shadow-2xl ring-1 ring-slate-900/5">
                                <div class="grid gap-8 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)]">
                                    <div>
                                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand">Formulario</p>
                                        <h3 class="mt-3 text-2xl font-bold tracking-tight">Cuentanos lo que necesitas</h3>
                                        <p class="mt-4 text-base leading-7 text-slate-600">
                                            {{ $contactForm['intro'] }}
                                        </p>
                                    </div>

                                    <form method="POST" action="{{ $contactAction }}" class="grid gap-4">
                                        @csrf
                                        <input type="text" name="company" value="" class="hidden" tabindex="-1" autocomplete="off">
                                        <div>
                                            <label for="contact-name" class="mb-2 block text-sm font-medium text-slate-700">Nombre</label>
                                            <input id="contact-name" name="name" type="text" value="{{ old('name') }}" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10">
                                        </div>
                                        <div>
                                            <label for="contact-phone" class="mb-2 block text-sm font-medium text-slate-700">Telefono</label>
                                            <input id="contact-phone" name="phone" type="text" value="{{ old('phone') }}" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10">
                                        </div>
                                        <div>
                                            <label for="contact-email" class="mb-2 block text-sm font-medium text-slate-700">Correo</label>
                                            <input id="contact-email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10">
                                        </div>
                                        <div>
                                            <label for="contact-message" class="mb-2 block text-sm font-medium text-slate-700">Mensaje</label>
                                            <textarea id="contact-message" name="message" rows="5" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-brand focus:ring-4 focus:ring-brand/10">{{ old('message') }}</textarea>
                                        </div>
                                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-brand px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-brand-dark">
                                            {{ $contactForm['submit_label'] }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if (! empty($socialLinks) || ($cta['enabled'] && $cta['placement'] === 'contacto' && $cta['label'] && $cta['url']))
                            <div class="mt-10 flex flex-wrap items-center gap-3">
                                @if ($cta['enabled'] && $cta['placement'] === 'contacto' && $cta['label'] && $cta['url'])
                                    <a href="{{ $cta['url'] }}" target="{{ $ctaTarget }}" @if($cta['open_in_new_tab']) rel="noreferrer noopener" @endif class="rounded-full bg-brand px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-dark transition-all">
                                        {{ $cta['label'] }}
                                    </a>
                                @endif
                                @foreach ($socialLinks as $network => $url)
                                    <a href="{{ $url }}" target="_blank" rel="noreferrer noopener" class="rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-medium secondary-copy hover:bg-white/10 transition-all">
                                        {{ match($network) {
                                            'contact_url' => 'Contacto',
                                            'x' => 'X',
                                            default => ucfirst($network),
                                        } }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        @if ($contacto['map_embed_url'] || $facebookEmbedUrl)
                            <div class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-{{ $contacto['map_embed_url'] && $facebookEmbedUrl ? '2' : '1' }}">
                                @if ($contacto['map_embed_url'])
                                    <div class="overflow-hidden rounded-3xl bg-white/5 ring-1 ring-white/10 backdrop-blur-sm">
                                        <iframe
                                            src="{{ $contacto['map_embed_url'] }}"
                                            class="h-[420px] w-full"
                                            style="border:0;"
                                            allowfullscreen=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"
                                        ></iframe>
                                    </div>
                                @endif

                                @if ($facebookEmbedUrl)
                                    <div class="overflow-hidden rounded-3xl bg-white/5 ring-1 ring-white/10 backdrop-blur-sm">
                                        <iframe
                                            src="{{ $facebookEmbedUrl }}"
                                            class="h-[620px] w-full"
                                            style="border:none;overflow:hidden"
                                            scrolling="no"
                                            frameborder="0"
                                            allowfullscreen="true"
                                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                                        ></iframe>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        @endforeach
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                @if ($companyProfile['repse_enabled'] && $companyProfile['repse_url'])
                    <a href="{{ $companyProfile['repse_url'] }}" target="_blank" rel="noreferrer noopener" class="text-slate-400 hover:text-brand">
                        <span class="sr-only">{{ $companyProfile['repse_label'] }}</span>
                        <span class="text-sm font-medium">{{ $companyProfile['repse_label'] }}</span>
                    </a>
                @endif
                @foreach ($socialLinks as $network => $url)
                    <a href="{{ $url }}" target="_blank" rel="noreferrer noopener" class="text-slate-400 hover:text-brand">
                        <span class="sr-only">{{ $network }}</span>
                        <span class="text-sm font-medium">{{ match($network) {
                            'contact_url' => 'Contacto',
                            'x' => 'X',
                            default => ucfirst($network),
                        } }}</span>
                    </a>
                @endforeach
            </div>
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5 text-slate-500">&copy; {{ date('Y') }} {{ $site->nombre_empresa }}. {{ $site->textos_ui['footer_derechos'] ?? 'Todos los derechos reservados.' }}</p>
            </div>
        </div>
    </footer>

    @if ($heroSlides->count() > 1)
        <script>
            (() => {
                const root = document.querySelector('[data-hero-slider]');

                if (!root) {
                    return;
                }

                const slides = Array.from(document.querySelectorAll('[data-hero-slide]'));
                const dots = Array.from(document.querySelectorAll('[data-hero-dot]'));
                const intervalMs = Number(root.dataset.heroInterval || 5000);
                let current = 0;

                const activate = (index) => {
                    current = index;

                    slides.forEach((slide, slideIndex) => {
                        slide.classList.toggle('is-active', slideIndex === index);
                    });

                    dots.forEach((dot, dotIndex) => {
                        dot.dataset.active = dotIndex === index ? 'true' : 'false';
                    });
                };

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => activate(index));
                });

                window.setInterval(() => {
                    activate((current + 1) % slides.length);
                }, intervalMs);
            })();
        </script>
    @endif
</body>
</html>
