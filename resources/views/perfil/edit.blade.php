<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Perfil</title>
    <style>
        /* Reset y básico */
        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f7f7;
            color: #444;
            scroll-behavior: smooth;
        }

        .container {
            display: flex;
            height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .sidebar {
            background: #ffd6e8;
            width: 250px;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .sidebar a {
            color: #5a2a6d;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 18px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #f6c1e1;
            color: #3a0e4b;
        }

        .content {
            flex: 1;
            padding: 40px 50px;
            position: relative;
            overflow-y: auto;
        }

        h1 {
            margin-top: 0;
            color: #6d3a5e;
            margin-bottom: 40px;
        }

        .back-arrow {
            position: fixed;
            top: 25px;
            right: 25px;
            font-size: 28px;
            color: #a86a9a;
            cursor: pointer;
            transition: color 0.3s ease;
            user-select: none;
            z-index: 100;
        }

        .back-arrow:hover {
            color: #6d3a5e;
        }

        form > div {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #824a7e;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1.8px solid #d1b3d4;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #a56ea3;
            background-color: #faf0fb;
        }

        button {
            background-color: #c992c7;
            border: none;
            padding: 14px 30px;
            color: white;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 700;
        }

        button:hover {
            background-color: #a56ea3;
        }

        .success-message {
            color: #3a814a;
            margin-bottom: 20px;
            font-weight: 600;
            background: #d6f0d6;
            border: 1.5px solid #8cc28c;
            padding: 12px 18px;
            border-radius: 8px;
        }

        .error-message {
            color: #a94442;
            margin-bottom: 20px;
            font-weight: 600;
            background: #f2dede;
            border: 1.5px solid #f2dede;
            padding: 12px 18px;
            border-radius: 8px;
        }

        img#preview {
            border-radius: 10px;
            margin-top: 12px;
            max-width: 180px;
            box-shadow: 0 3px 8px rgba(117, 64, 123, 0.3);
            display: block;
        }

        @media (max-width: 850px) {
            .container {
                flex-direction: column;
                height: auto;
                border-radius: 0;
                box-shadow: none;
                max-width: 100%;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                padding: 15px 0;
                border-radius: 0;
                gap: 10px;
            }

            .sidebar a {
                padding: 10px 15px;
                font-size: 14px;
            }

            .content {
                padding: 20px 25px;
                height: auto;
                overflow: visible;
            }

            .back-arrow {
                position: fixed;
                top: 15px;
                right: 15px;
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('Calculadora') }}" title="Volver"></ahref>
        <span class="back-arrow">&#8592;</span>
    </a>
    <div class="container">
        <nav class="sidebar" role="navigation" aria-label="Menú edición perfil">
            <a href="#editar-foto" class="active">Editar Foto</a>
            <a href="#editar-nombre">Editar Nombre</a>
            <a href="#editar-correo">Editar Correo</a>
            <a href="#editar-password">Cambiar Contraseña</a>
        </nav>

        <section class="content" role="main">
            <h1>Editar Perfil</h1>

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif


            <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                @csrf

                <div id="editar-foto">
                    <label for="image">Imagen de perfil:</label><br>
                    @if ($user->image)
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('Imagenes/IconoDefaul.png') }}" alt="Imagen actual" id="current-image"><br>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*">
                    @error('image') <div class="error-message">{{ $message }}</div> @enderror
                    <img id="preview" style="display:none;" alt="Vista previa de la nueva imagen">
                </div>

                <div id="editar-nombre">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div id="editar-correo">
                    <label for="email">Correo electrónico actual:</label>
                    <input type="email" id="email" value="{{ $user->email }}" readonly>

                    <label for="new_email">Actualizar correo:</label>
                    <input type="email" name="new_email" id="new_email" value="{{ old('new_email') }}">
                    @error('new_email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div id="editar-password">
                    <label for="password">Nueva contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Dejar vacío para no cambiar">
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <button type="submit">Guardar Cambios</button>
            </form>
        </section>
    </div>
    <script>
        const inputImage = document.getElementById('image');
        const previewImg = document.getElementById('preview');

        inputImage.addEventListener('change', function(){
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.setAttribute('src', e.target.result);
                    previewImg.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = 'none';
                previewImg.removeAttribute('src');
            }
        });

        const links = document.querySelectorAll('.sidebar a');
        links.forEach(link => {
            link.addEventListener('click', e => {
                links.forEach(l => l.classList.remove('active'));
                e.target.classList.add('active');
            });
        });
    </script>
</body>
</html>