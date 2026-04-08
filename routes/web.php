<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SiteContactController;
use App\Models\Site;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

$appUrlHost = parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST) ?: 'localhost';

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::domain('{domain}')->where(['domain' => '^(?!' . preg_quote($appUrlHost, '/') . '$).*$'])->group(function () {
    Route::post('/', [SiteContactController::class, 'submitByDomain'])->name('sites.contact.domain');

    Route::get('/robots.txt', function (string $domain) {
        $cleanDomain = str_replace('www.', '', $domain);

        $site = Site::query()
            ->where('dominio', $domain)
            ->orWhere('dominio', $cleanDomain)
            ->first();

        abort_unless($site, 404);

        $lines = [
            'User-agent: *',
            $site->seo['indexable'] ? 'Allow: /' : 'Disallow: /',
        ];

        if ($site->resolved_canonical_url) {
            $lines[] = 'Sitemap: ' . rtrim($site->resolved_canonical_url, '/') . '/sitemap.xml';
        }

        return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain']);
    });

    Route::get('/sitemap.xml', function (string $domain) {
        $cleanDomain = str_replace('www.', '', $domain);

        $site = Site::query()
            ->where('dominio', $domain)
            ->orWhere('dominio', $cleanDomain)
            ->first();

        abort_unless($site, 404);

        $url = $site->resolved_canonical_url ?: url()->current();

        $xml = view('sitemap', [
            'urls' => [[
                'loc' => $url,
                'lastmod' => optional($site->updated_at)->toAtomString(),
            ]],
        ])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    });

    Route::get('/', function (string $domain) {
        try {
            $cleanDomain = str_replace('www.', '', $domain);

            $site = Site::query()
                ->where('dominio', $domain)
                ->orWhere('dominio', $cleanDomain)
                ->first();

            if (! $site) {
                $site = Site::query()
                    ->where('slug', $domain)
                    ->orWhere('slug', $cleanDomain)
                    ->first();
            }

            abort_unless($site, 404, 'Sitio no encontrado para este dominio: ' . $domain);

            $dbReady = true;

            return view('site', compact('site', 'dbReady'));
        } catch (\Throwable $exception) {
            Log::error('Error cargando sitio por dominio', [
                'domain' => $domain,
                'error' => $exception->getMessage(),
            ]);

            abort(404, 'Error al cargar el sitio.');
        }
    });
});

Route::post('/sitios/{slug}/contacto', [SiteContactController::class, 'submitBySlug'])->name('sites.contact.slug');

Route::middleware('auth:sanctum')->get('/sys-setup-secreto-' . env('APP_SETUP_TOKEN', '12345'), function () {
    if (! env('APP_SETUP_TOKEN')) {
        abort(403, 'Setup token no configurado en .env');
    }

    Artisan::call('migrate', ['--force' => true, '--seed' => true]);
    Artisan::call('optimize:clear');

    return "Comandos ejecutados: \n\n" . Artisan::output();
});

Route::get('/', function () {
    try {
        $siteCards = Site::query()
            ->orderBy('nombre_empresa')
            ->get(['nombre_empresa', 'slug', 'dominio', 'slogan', 'tema'])
            ->map(fn (Site $site) => [
                'name' => $site->nombre_empresa,
                'slug' => $site->slug,
                'domain' => $site->dominio,
                'tagline' => $site->slogan,
                'theme' => $site->tema,
            ])
            ->all();
    } catch (\Throwable $exception) {
        Log::warning('No fue posible cargar el catalogo de sitios desde la base de datos.', [
            'message' => $exception->getMessage(),
        ]);

        $siteCards = [];
    }

    return view('home', compact('siteCards'));
});

Route::get('/sitios/{slug}', function (string $slug) {
    try {
        $site = Site::query()->where('slug', $slug)->first();

        abort_unless($site, 404);

        $dbReady = true;

        return view('site', compact('site', 'dbReady'));
    } catch (\Throwable $exception) {
        Log::warning('No fue posible cargar el sitio desde la base de datos.', [
            'slug' => $slug,
            'message' => $exception->getMessage(),
        ]);

        abort(404);
    }
});

Route::get('/sitios/{slug}/robots.txt', function (string $slug) {
    $site = Site::query()->where('slug', $slug)->firstOrFail();

    $lines = [
        'User-agent: *',
        $site->seo['indexable'] ? 'Allow: /' : 'Disallow: /',
        'Sitemap: ' . url("/sitios/{$site->slug}/sitemap.xml"),
    ];

    return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain']);
});

Route::get('/sitios/{slug}/sitemap.xml', function (string $slug) {
    $site = Site::query()->where('slug', $slug)->firstOrFail();

    $xml = view('sitemap', [
        'urls' => [[
            'loc' => url("/sitios/{$site->slug}"),
            'lastmod' => optional($site->updated_at)->toAtomString(),
        ]],
    ])->render();

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});
