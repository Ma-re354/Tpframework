<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #8d5524 0%, #c68642 50%, #e0ac69 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Motifs géométriques culturels */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.08) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(255,255,255,0.08) 0%, transparent 50%),
                repeating-linear-gradient(
                    45deg,
                    rgba(255,255,255,0.05) 0px,
                    rgba(255,255,255,0.05) 10px,
                    transparent 10px,
                    transparent 20px
                );
            z-index: -1;
        }

        /* Objets décoratifs inspirés motifs Wax */
        .shape {
            position: absolute;
            width: 130px;
            height: 130px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 20% 40% 60% 30%;
            transform: rotate(45deg);
            z-index: -1;
        }

        .shape-1 { top: 8%; left: 10%; }
        .shape-2 { bottom: 12%; right: 8%; border-radius: 50% 25% 45% 20%; }
        .shape-3 { top: 50%; left: 5%; width: 70px; height: 70px; }

        /* Conteneur du formulaire */
        .container {
            width: 100%;
            max-width: 450px;
            padding: 35px;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo h1 {
            color: #fffdfa;
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .logo p {
            color: rgba(255,255,255,0.85);
            font-size: 1rem;
            margin-top: 5px;
        }

        label {
            color: white;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .input-field {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            font-size: 1rem;
            color: #5a3e28;
            transition: 0.3s;
        }

        .input-field:focus {
            border-color: #8d5524;
            outline: none;
            box-shadow: 0 0 8px rgba(141, 85, 36, 0.3);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: #8d5524;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #8d5524, #603d1c);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #9b6030, #6f4a24);
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .links a {
            color: rgba(255,255,255,0.95);
            text-decoration: none;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ffebe8;
            font-size: .85rem;
            margin-top: 6px;
        }
    </style>
</head>

<body>

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="container">

        <div class="logo">
            <h1>Dashboard|Admin</h1>
            <p>Accédez à votre espace</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <label for="email">Email</label>
            <input id="email" type="email" name="email"
                class="input-field"
                value="{{ old('email') }}"
                required autocomplete="username"
                placeholder="Votre email">

            <x-input-error :messages="$errors->get('email')" class="error-message" />

            <!-- Password -->
            <label for="password" style="margin-top:18px;">Mot de passe</label>
            <input id="password" type="password" name="password"
                class="input-field"
                required autocomplete="current-password"
                placeholder="Votre mot de passe">

            <x-input-error :messages="$errors->get('password')" class="error-message" />

            <!-- Remember -->
            <div class="checkbox-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Se souvenir de moi</label>
            </div>

            <!-- Button -->
            <button type="submit" class="btn-submit">
                Se connecter
            </button>

            <!-- Links -->
            <div class="links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif

                <a href="{{ route('register') }}">Créer un compte</a>
            </div>

        </form>

    </div>

</body>
</html>