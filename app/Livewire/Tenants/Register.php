<?php

namespace App\Livewire\Tenants;

use App\Models\Tenant;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
#[Layout('components.layouts.auth')]
class Register extends Component
{

    public string $name = '';
    public string $address = '';
    public string $phone = '';

    // Variables pour la vérification anti-bot
    public string $recaptchaToken = '';
    public int $firstNumber = 0;
    public int $secondNumber = 0;
    public string $userAnswer = '';
    public string $operation = '';
    public string $expectedAnswer = '';

    public function mount()
    {
        // Générer une question mathématique aléatoire
        $this->generateMathQuestion();
    }

    private function generateMathQuestion()
    {
        $this->firstNumber = rand(1, 10);
        $this->secondNumber = rand(1, 10);

        // Choisir une opération aléatoire (addition ou multiplication)
        $operations = ['+', '×'];
        $this->operation = $operations[array_rand($operations)];

        if ($this->operation === '+') {
            $this->expectedAnswer = (string)($this->firstNumber + $this->secondNumber);
        } else {
            $this->expectedAnswer = (string)($this->firstNumber * $this->secondNumber);
        }
    }

    private function validateRecaptcha()
    {
        if (empty($this->recaptchaToken)) {
            return false;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $this->recaptchaToken,
                'remoteip' => request()->ip(),
            ]);

            $result = $response->json();

            // Le score est entre 0.0 et 1.0, où 1.0 est très probablement un humain
            return $result['success'] && $result['score'] >= 0.5;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function create()
    {
        $messages = [
            'name.required' => 'Le champ Nom de l\'établissement est obligatoire.',
            'name.string' => 'Le champ Nom de l\'établissement doit être une chaîne de caractères.',
            'name.max' => 'Le champ Nom de l\'établissement ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce Nom de l\'établissement est déjà utilisé.',

            'address.required' => 'Le champ Adresse est obligatoire.',
            'address.string' => 'Le champ Adresse doit être une chaîne de caractères.',
            'address.max' => 'Le champ Adresse ne doit pas dépasser 255 caractères.',

            'phone.required' => 'Le champ Téléphone est obligatoire.',
            'phone.string' => 'Le champ Téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le champ Téléphone ne doit pas dépasser 255 caractères.',
            'phone.unique' => 'Ce numéro de Téléphone est déjà utilisé.',

            'userAnswer.required' => 'Veuillez répondre à la question mathématique.',
            'recaptchaToken.required' => 'Erreur de vérification reCAPTCHA. Veuillez réessayer.',
        ];


        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255','unique:'.Tenant::class],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255','unique:'.Tenant::class],
            'userAnswer' => ['required'],
            'recaptchaToken' => ['required'],
        ],$messages);

        // Vérification de la réponse à la question mathématique
        if ($this->userAnswer !== $this->expectedAnswer) {
            $this->addError('userAnswer', 'La réponse mathématique est incorrecte. Veuillez réessayer.');
            // Générer une nouvelle question
            $this->generateMathQuestion();
            return;
        }

        // Vérification du reCAPTCHA
        if (!$this->validateRecaptcha()) {
            $this->addError('recaptchaToken', 'La vérification anti-robot a échoué. Veuillez réessayer.');
            return;
        }

        // Vérifier le délai entre les tentatives d'inscription (protection contre les soumissions rapides)
        $lastCreationAttempt = session('last_tenant_creation_attempt', 0);
        $currentTime = time();

        if ($currentTime - $lastCreationAttempt < 3) { // Minimum 3 secondes entre les tentatives
            $this->addError('bot_protection', 'Veuillez patienter un instant avant de réessayer.');
            return;
        }

        // Enregistrer le timestamp de cette tentative
        session(['last_tenant_creation_attempt' => $currentTime]);

        $validated['id'] = Str::lower(Str::random(6));
        //dd($validated);
        $tenant = Tenant::create($validated);
        $tenant_id = $tenant->id;

        $tenant->domains()->create(['domain' => $tenant_id.'.'. parse_url(config('app.url'), PHP_URL_HOST)]);

        $tenantDomain = $tenant->domains()->first()->domain;
        $dashboardUrl = tenant_route($tenantDomain, 'register');

        $this->redirect($dashboardUrl, navigate: false);
    }

    public function render()
    {
        return view('livewire.tenants.register');
    }
}
