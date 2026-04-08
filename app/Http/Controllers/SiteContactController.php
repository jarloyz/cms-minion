<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SiteContactController extends Controller
{
    public function submitByDomain(Request $request, string $domain): RedirectResponse
    {
        $cleanDomain = str_replace('www.', '', $domain);

        $site = Site::query()
            ->where('dominio', $domain)
            ->orWhere('dominio', $cleanDomain)
            ->orWhere('slug', $domain)
            ->orWhere('slug', $cleanDomain)
            ->firstOrFail();

        return $this->handle($request, $site, url()->current());
    }

    public function submitBySlug(Request $request, string $slug): RedirectResponse
    {
        $site = Site::query()->where('slug', $slug)->firstOrFail();

        return $this->handle($request, $site, url("/sitios/{$slug}"));
    }

    protected function handle(Request $request, Site $site, string $redirectBaseUrl): RedirectResponse
    {
        $contactForm = $site->contact_form;

        abort_unless($contactForm['enabled'], 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
            'company' => ['nullable', 'max:0'],
        ]);

        $recipient = $contactForm['recipient_email'] ?: $site->email;

        abort_unless(filled($recipient), 422, 'El sitio no tiene un correo de destino configurado.');

        $subject = 'Nuevo contacto desde ' . $site->nombre_empresa;
        $body = implode("\n", [
            'Sitio: ' . $site->nombre_empresa,
            'Nombre: ' . $validated['name'],
            'Telefono: ' . $validated['phone'],
            'Correo: ' . $validated['email'],
            '',
            'Mensaje:',
            $validated['message'],
        ]);

        Mail::raw($body, function ($message) use ($recipient, $subject, $validated) {
            $message
                ->to($recipient)
                ->replyTo($validated['email'], $validated['name'])
                ->subject($subject);
        });

        Log::info('Formulario de contacto enviado', [
            'site_slug' => $site->slug,
            'recipient' => $recipient,
            'sender_email' => $validated['email'],
        ]);

        return redirect($redirectBaseUrl . '#contacto')
            ->with('contact_success', $contactForm['success_message']);
    }
}
