<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $site->nombre_empresa }} | Demo CMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        secondary: 'var(--color-secundario)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --color-marca: {{ $site->color_principal }};
            --color-secundario: {{ $site->color_secundario ?? '#0f172a' }};
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .text-balance {
            text-wrap: balance;
        }
    </style>
</head>
<body class="text-slate-800 antialiased selection:bg-brand selection:text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="fixed inset-x-0 top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50 transition-all duration-300">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                @if ($site->logo)
                    <img src="{{ $site->logo }}" alt="{{ $site->nombre_empresa }}" class="h-10 w-10 md:h-12 md:w-12 rounded-xl object-cover shadow-sm">
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
                <a href="#nosotros" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_nosotros'] ?? 'Nosotros' }}</a>
                <a href="#servicios" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_servicios'] ?? 'Servicios' }}</a>
                <a href="#contacto" class="hover:text-brand transition-colors">{{ $site->textos_ui['nav_contacto'] ?? 'Contacto' }}</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ url('/admin') }}" class="hidden md:inline-flex items-center justify-center rounded-full bg-brand px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brand-dark transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                    Panel Admin
                </a>
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
                        </div>
                    </div>
                    <div class="relative lg:ml-auto w-full max-w-xl xl:max-w-none">
                        <div class="relative rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-slate-900/10">
                            <img src="{{ $site->imagen_principal }}" alt="Imagen principal" class="w-full rounded-xl bg-slate-100 object-cover aspect-[4/3] shadow-inner">

                            <div class="absolute -bottom-6 -left-6 rounded-2xl bg-white p-4 shadow-xl ring-1 ring-slate-900/10 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                                <div class="rounded-full bg-brand-light p-3">
                                    <svg class="w-6 h-6 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $site->textos_ui['badge_hero'] ?? 'Soluciones Rápidas' }}</p>
                                    <p class="text-xs text-slate-500">{{ $site->textos_ui['badge_hero_sub'] ?? 'Para tu negocio' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Nosotros Section -->
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
            </div>
        </section>

        <!-- Servicios Section -->
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

        <!-- Contact Section -->
        <section id="contacto" class="relative isolate bg-secondary py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0 text-white">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $site->textos_ui['titulo_contacto'] ?? '¿Listo para empezar?' }}</h2>
                    <p class="mt-6 text-lg leading-8 text-slate-300">{{ $site->textos_ui['texto_contacto'] ?? 'Contáctanos hoy mismo y descubre cómo podemos transformar tu negocio. Nuestro equipo está listo para atenderte.' }}</p>
                </div>

                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 sm:mt-20 lg:max-w-none lg:grid-cols-3">
                    <div class="flex gap-x-6 rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 backdrop-blur-sm">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.09-7.074-7.07L8.03 8.35a1.125 1.125 0 00.417-1.173L7.34 2.748A1.125 1.125 0 006.25 1.9h-1.37A2.25 2.25 0 002.25 4.15v2.6z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold leading-7 text-white">{{ $site->textos_ui['label_telefono'] ?? 'Teléfono' }}</h3>
                            <p class="mt-2 leading-7 text-slate-300">{{ $site->telefono }}</p>
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
                            <h3 class="text-base font-semibold leading-7 text-white">{{ $site->textos_ui['label_email'] ?? 'Email' }}</h3>
                            <p class="mt-2 leading-7 text-slate-300">{{ $site->email }}</p>
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
                            <h3 class="text-base font-semibold leading-7 text-white">{{ $site->textos_ui['label_direccion'] ?? 'Dirección' }}</h3>
                            <p class="mt-2 leading-7 text-slate-300">{{ $site->direccion }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <a href="#" class="text-slate-400 hover:text-brand">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="text-slate-400 hover:text-brand">
                    <span class="sr-only">Instagram</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5 text-slate-500">&copy; {{ date('Y') }} {{ $site->nombre_empresa }}. {{ $site->textos_ui['footer_derechos'] ?? 'Todos los derechos reservados.' }}</p>
            </div>
        </div>
    </footer>
</body>
</html>
