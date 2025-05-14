<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Établissement non trouvé | {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}

        body {
            font-family: 'Figtree', sans-serif;
            color: #1a202c;
            background-color: #f7fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .container {
            max-width: 32rem;
            width: 100%;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            text-align: center;
        }

        .error-code {
            display: inline-block;
            background-color: #EBF4FF;
            color: #2563EB;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            margin-bottom: 1rem;
        }

        .error-icon {
            color: #2563EB;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        h1 {
            color: #1a202c;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        p {
            color: #4a5568;
            margin-bottom: 1.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #2563EB;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #1D4ED8;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a202c;
                color: #e2e8f0;
            }

            .container {
                background-color: #2d3748;
                border: 1px solid #4a5568;
            }

            .error-code {
                background-color: rgba(37, 99, 235, 0.2);
            }

            h1 {
                color: #e2e8f0;
            }

            p {
                color: #a0aec0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <span class="error-code">404</span>
        <div class="error-icon">
            <i class="fas fa-building-circle-exclamation"></i>
        </div>
        <h1>Établissement introuvable</h1>
        <p>Nous n'avons pas pu trouver l'établissement auquel vous essayez d'accéder. Veuillez vérifier l'URL ou contacter l'administrateur de l'établissement pour plus d'informations.</p>
        <a href="{{ route('home') }}" class="btn">
            <i class="fas fa-home"></i> Retour à l'accueil
        </a>
    </div>
</body>
</html>
