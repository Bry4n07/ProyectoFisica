<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

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
            flex-direction: column; /* <-- CORREGIDO */
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
    </style>
</head>
<body>
    <div class="layout">
        <div class="Izquierda">
            <img src="/Imagenes/fisica.png" alt="Logo de Fisica" style="width: 85px; height: auto; margin:-85px 0px 10px 185px;">
            <h1 style="margin:0px 50px 16px 164px;">Registro</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name">Nombre</label>
                <input type="text" name="name" required>
                <label for="email">Correo</label>
                <input type="email" name="email" required>
                <label for="password">Contraseña</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" required>
                    <i class='bx bx-low-vision' id="togglePassword"></i>
                </div>
                <label for="password_confirmation">Confirmación de contraseña</label>
                <div class="password-container">
                    <input type="password" name="password_confirmation" id="passwordConfirmation" required>
                    <i class='bx bx-low-vision' id="togglePassword2"></i>
                </div>

                <button type="submit">Registrarse</button>
            </form>

            <a href="{{ route('login.form') }}">¿Ya tienes cuenta? Inicia sesión</a>
        </div>

        <div class="ImagenFondo"></div>
    </div>

        <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('bx-low-vision');
            togglePassword.classList.toggle('bx-show');
            });

        const togglePassword2 = document.getElementById('togglePassword2');
        const passwordConfirmation = document.getElementById('passwordConfirmation');

        togglePassword2.addEventListener('click', () =>{
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            togglePassword2.classList.toggle('bx-low-vision');
            togglePassword2.classList.toggle('bx-show');
        })
    </script>
</body>
</html>
