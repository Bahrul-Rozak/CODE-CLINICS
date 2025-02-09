<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Tambahin Bootstrap CSS CDN -->

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

</head>

<body>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Kolom Form (Kiri) -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="mb-3">
                        @csrf

                        <h2 class="text-center mb-4">Login</h2>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="remember_me" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label">Remember me</label>
                            </div>

                            @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Log in</button>
                    </form>
                </div>
            </div>

            <!-- Kolom Gambar (Kanan) -->
            <div class="col-md-6 d-none d-md-block p-0">
                <img src="https://w0.peakpx.com/wallpaper/362/953/HD-wallpaper-medical-technology-surgical-technologist.jpg" alt="Login Image" class="img-fluid w-100 vh-100 object-fit-cover">
            </div>
        </div>
    </div>

    <!-- Tambahin Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>