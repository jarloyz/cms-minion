<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo CMS | Sitios empresariales</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[linear-gradient(135deg,#fffdf8_0%,#f2eee8_100%)] text-slate-900">
    <main class="mx-auto flex min-h-screen max-w-6xl items-center px-6 py-12 sm:px-8 lg:px-10">
        <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <section>
                <p class="text-sm font-bold uppercase tracking-[0.4em] text-orange-600">Demo comercial</p>
                <h1 class="mt-4 text-5xl font-black tracking-tight text-slate-950 sm:text-6xl">
                    Un CMS para vender sitios empresariales editables.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                    Esta demo muestra una plantilla corporativa que puede cambiar su nombre, colores, hero, servicios y contacto desde Filament, y renderizarse como un sitio real en su propia URL.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ $siteUrl }}" class="rounded-full bg-orange-600 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-200 transition hover:opacity-90">
                        Ver sitio demo
                    </a>
                    <a href="{{ url('/admin') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:border-slate-300">
                        Entrar al panel
                    </a>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/80 bg-white/80 p-8 shadow-2xl shadow-slate-300/40 backdrop-blur">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-slate-400">Flujo de demo</p>
                <ol class="mt-6 space-y-4 text-slate-700">
                    <li class="flex gap-3">
                        <span class="mt-0.5 font-black text-orange-600">1.</span>
                        <span>Abres el sitio público en <strong>{{ $siteUrl }}</strong>.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 font-black text-orange-600">2.</span>
                        <span>Entras a Filament y editas logo, colores, textos, servicios y contacto.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-0.5 font-black text-orange-600">3.</span>
                        <span>Usas el botón de preview o refrescas la URL del sitio para mostrar el cambio al instante.</span>
                    </li>
                </ol>
            </section>
        </div>
    </main>
</body>
</html>
