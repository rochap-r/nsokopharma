<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TenantNotFoundException extends Exception
{
    /**
     * Rapport d'erreur ou journalisation.
     *
     * @return void
     */
    public function report()
    {
        // Journalisation de l'erreur - on pourrait ajouter un systu00e8me plus u00e9laboru00e9
    }

    /**
     * Rendu de l'exception en ru00e9ponse HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        return response()->view('errors.tenant-not-found', [], 404);
    }
}
