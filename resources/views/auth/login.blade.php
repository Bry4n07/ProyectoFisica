<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0px;
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .layout {
            display: flex;
            height: 100vh;
        }

        .Izquierda {
            width: 30%;
            padding: 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .ImagenFondo {
            width: 70%;
            background-image: url(/Imagenes/FondoLogin.jpg);
            background-size: cover;
            background-position: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input {
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        a {
            margin-top: 15px;
            color: black;
            text-decoration: none;
        }

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-container input {
            width: 100%;
        }

        .password-container i {
            position: absolute;
            right: 10px;
            font-size: 20px;
            color: gray;
            cursor: pointer;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="layout">
        <div class="Izquierda">
            <img src="/Imagenes/fisica.png" alt="Logo de Fisica" style="width: 100px; height: auto; margin:-48px 0px 10px 170px;">
            <h1 style="margin:0px 50px 10px 96px;">Inicio de Sesión</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">Gmail:</label>
                <input type="email" name="email" id="email" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="password">Contraseña:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" required>
                    <i class='bx bx-low-vision' id="togglePassword"></i>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit">Entrar</button>
            </form>
            <a href="{{ route('register') }}">Registrarse</a>
            <a href="{{ route('InicioSinSesion') }}">Entrar sin registrarse</a>
        </div>

        <div class="ImagenFondo"></div>
    </div>

    <!-- Script para alternar mostrar/ocultar contraseña -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('bx-low-vision');
            togglePassword.classList.toggle('bx-show');
        });
    </script>
</body>
</html>