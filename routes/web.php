<?php

use App\Livewire\Tenants\Identificator;
use App\Livewire\Tenants\Register;
use Illuminate\Support\Facades\Route;



//fix the central domain
Route::group(['domain' => config('tenancy.central_domains')[0]], function () {

    Route::get('/', function () {
      \Illuminate\Support\Facades\Auth::logout();
        return view('welcome');
    })->name('home');



    Route::get('/identification', Identificator::class)->name('identification');
    Route::get('/registration', Register::class)->name('registration');

});

// Inclure les routes pour les rôles et permissions


require __DIR__.'/auth.php';
