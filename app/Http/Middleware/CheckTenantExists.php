<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\TenantNotFoundException;
use Stancl\Tenancy\Resolvers\DomainTenantResolver;

class CheckTenantExists
{
    protected $resolver;

    public function __construct(DomainTenantResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si nous sommes sur un sous-domaine (pas le domaine principal)
        if ($this->isSubdomain($request)) {
            try {
                // Essaie de résoudre le tenant depuis le domaine
                // Si aucune exception n'est levée, le tenant existe
                $tenant = $this->resolver->resolve($request->getHost());
                if (!$tenant) {
                    throw new TenantNotFoundException("Le domaine spécifié n'existe pas.");
                }
            } catch (\Exception $e) {
                // Journaliser la tentative d'accès au sous-domaine invalide
                \Log::warning("Tentative d'accès à un tenant inexistant", [
                    'domain' => $request->getHost(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
                
                // Gérer l'exception en renvoyant la vue d'erreur
                return response()->view('errors.tenant-not-found', [], 404);
            }
        }

        return $next($request);
    }

    /**
     * Détermine si la requête est sur un sous-domaine.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isSubdomain(Request $request): bool
    {
        $host = $request->getHost();
        $appUrl = parse_url(config('app.url'), PHP_URL_HOST);
        
        // Si le host ne correspond pas au domaine principal de l'application, c'est un sous-domaine
        // Nous devons exclure le cas où host est égal à appUrl (domaine principal)
        return $host !== $appUrl && 
               // Vérifie si l'hôte se termine par le domaine principal de l'application
               str_ends_with($host, '.' . $appUrl);
    }
}
