<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'IDT') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- boostrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Optional custom styles -->
    <style>
        body {
            background: #f8f9fa;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card card p-4">

            <!-- App Brand / Logo / link to index page-->
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <h2 class="fw-bold text-primary">{{ config('app.name', 'IDT') }}</h2>
                </a>
                <p class="text-decoration-underline text-uppercase">{{ request()->segment(count(request()->segments())) }}</p>
            </div>
           

            <!-- Page Content -->
            @yield('content')

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>