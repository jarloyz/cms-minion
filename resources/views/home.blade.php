<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo CMS | Catalogo de sitios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[linear-gradient(135deg,#fffdf8_0%,#f2eee8_100%)] text-slate-900">
    <main class="mx-auto max-w-7xl px-6 py-12 sm:px-8 lg:px-10">
        <section class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.4em] text-orange-600">Demo comercial</p>
                <h1 class="mt-4 text-5xl font-black tracking-tight text-slate-950 sm:text-6xl">
                    Un CMS para vender multiples sitios con la misma base editable.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                    La demo ahora incluye varias marcas y enfoques usando la misma plantilla: un sitio corporativo, un portfolio backend-first y un proyecto editorial. Todo se edita desde Filament y se publica en su propia URL.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    @if (! empty($siteCards))
                        <a href="{{ url('/sitios/' . $siteCards[0]['slug']) }}" class="rounded-full bg-orange-600 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-200 transition hover:opacity-90">
                            Ver primer demo
                        </a>
                    @endif
                </div>
            </div>

            <section class="rounded-[2rem] border border-white/80 bg-white/80 p-8 shadow-2xl shadow-slate-300/40 backdrop-blur">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-slate-400">Flujo de demo</p>
                <ol class="mt-6 space-y-4 text-slate-700">
                    <li class="flex gap-3">
                        <span class="mt-0.5 font-black text-orange-600">1.</span>
                        <span>Abres uno de los sitios publicos del catalogo de abajo.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 font-black text-orange-600">2.</span>
                        <span>Entras a Filament y editas branding, hero, secciones, tema y contacto.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 font-black text-orange-600">3.</span>
                        <span>Usas preview o refrescas la URL publica para mostrar el cambio al instante.</span>
                    </li>
                </ol>
            </section>
        </section>

        <section class="mt-14">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.35em] text-slate-400">Sitios disponibles</p>
                    <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950">Catalogo de demos</h2>
                </div>
                <p class="text-sm text-slate-500">{{ count($siteCards) }} sitios listos para mostrar</p>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                @foreach ($siteCards as $site)
                    <article class="rounded-[1.75rem] border border-white/70 bg-white/90 p-6 shadow-xl shadow-slate-200/60">
                        <p class="text-xs font-bold uppercase tracking-[0.35em] text-slate-400">{{ $site['theme'] }}</p>
                        <h3 class="mt-4 text-2xl font-black tracking-tight text-slate-950">{{ $site['name'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $site['tagline'] }}</p>
                        <div class="mt-6 space-y-2 text-sm text-slate-500">
                            <p><strong class="text-slate-700">Slug:</strong> /sitios/{{ $site['slug'] }}</p>
                            <p><strong class="text-slate-700">Dominio:</strong> {{ $site['domain'] ?: 'sin dominio' }}</p>
                        </div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ url('/sitios/' . $site['slug']) }}" class="rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90">
                                Ver demo
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
</body>
</html>
