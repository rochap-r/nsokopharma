<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('universal', []);
    })
    ->withMiddleware(function (Middleware $middleware) {
        // Retrait du middleware problématique
        // $middleware->prependToGlobalMiddleware(\App\Http\Middleware\CheckTenantExists::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Enregistrer notre gestionnaire d'exceptions pour les tenants
        $exceptions->renderable(function (TenantCouldNotBeIdentifiedOnDomainException $e, $request) {
            // Extraire le sous-domaine de la requête
            $domain = $request->getHost();
            
            // Journaliser la tentative d'accès au sous-domaine invalide
            \Log::warning("Tentative d'accès à un tenant inexistant", [
                'domain' => $domain,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            // Renvoyer notre vue d'erreur personnalisée
            return response()->view('errors.tenant-not-found', [], 404);
        });
    })->create();
