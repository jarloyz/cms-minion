<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | CMS Minion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top,#fef3c7,transparent_35%),linear-gradient(135deg,#0f172a_0%,#111827_100%)] text-slate-100">
    <main class="mx-auto flex min-h-screen max-w-6xl items-center px-6 py-12 sm:px-8">
        <div class="grid w-full gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <section>
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-amber-300">Sanctum Login</p>
                <h1 class="mt-4 text-5xl font-black tracking-tight sm:text-6xl">
                    Accede al panel del MVP desde un login propio.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    Esta pantalla autentica la sesion web que despues usa Filament y tambien deja lista la base para endpoints protegidos con Sanctum.
                </p>
                <div class="mt-8 rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                    <p class="text-sm font-semibold text-white">Flujo actual</p>
                    <ul class="mt-4 space-y-3 text-sm text-slate-300">
                        <li>Inicias sesion aqui en <strong>/login</strong>.</li>
                        <li>Laravel crea la sesion autenticada.</li>
                        <li>Filament reutiliza esa sesion para entrar al panel en <strong>/admin</strong>.</li>
                        <li>Los endpoints protegidos con <strong>auth:sanctum</strong> reconocen al usuario autenticado.</li>
                    </ul>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-white p-8 text-slate-900 shadow-2xl shadow-black/20">
                <div class="mb-8">
                    <p class="text-sm font-bold uppercase tracking-[0.35em] text-amber-600">Panel Access</p>
                    <h2 class="mt-3 text-3xl font-black tracking-tight">Iniciar sesion</h2>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900 outline-none transition focus:border-amber-500 focus:ring-4 focus:ring-amber-100">
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input id="password" name="password" type="password" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900 outline-none transition focus:border-amber-500 focus:ring-4 focus:ring-amber-100">
                    </div>

                    <label class="flex items-center gap-3 text-sm text-slate-600">
                        <input name="remember" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-amber-600 focus:ring-amber-500">
                        <span>Mantener sesion iniciada</span>
                    </label>

                    <button type="submit" class="w-full rounded-2xl bg-slate-950 px-5 py-3 font-semibold text-white transition hover:opacity-90">
                        Entrar al panel
                    </button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
