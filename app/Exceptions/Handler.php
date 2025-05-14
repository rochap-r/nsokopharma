<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Stancl\Tenancy\Exceptions\DomainOccupiedByOtherTenantException;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        
        // Intercepter les exceptions de tenant non trouvé
        $this->renderable(function (TenantCouldNotBeIdentifiedOnDomainException $e, $request) {
            // Extraire le sous-domaine de la requête
            $domain = $request->getHost();
            
            // Journaliser la tentative d'accès au sous-domaine invalide
            \Log::warning("Tentative d'accès à un tenant inexistant", [
                'domain' => $domain,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            // Lancer notre exception personnalisée
            throw new TenantNotFoundException("Le domaine spécifié n'existe pas.");
        });
    }
}
