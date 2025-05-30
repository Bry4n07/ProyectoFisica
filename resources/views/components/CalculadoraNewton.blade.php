    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Calculadora</title>
        @vite('resources/js/app.js')
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <style>
            body{
                margin: 0;
                font-family: quicksand, sans-serif;
            }
            a{
                text-decoration: none;
                color: black;
            }
            .carousel-container {
                width: 55%;
                max-width: 700px;
                position: relative;
                margin: 0;
                overflow: hidden;
            }

            .carousel-slide {
                display: none;
                width: 100%;
            }

            .carousel-slide img {
                width: 100%;
                border-radius: 10px;
                position: relative;
                background-position: right;
                background-size: cover;
            }
            .Layout{
                display: flex;
                padding: 30px 60px 28px 0px;
                background-color: lightblue;
                align-items: center;
            }
            .TextoPosition{
                position: relative;
                width: 40%;
                top: -18px;
                left: 9%;
                color: whitesmoke;
                text-shadow: 2px 2px 5px #000;
                max-width: 80%;
            }
            .TextoPosition h1{
                font-size: 74px;
                font-weight: bold;
                margin: 0;
                animation: efecto 2s ease-in-out;
            }
            @keyframes efecto {
                from { opacity: 0; transform: translateY(-6 px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .perfil-dropdwon{
                position: relative;
                display: inline-block;
            }
            .perfil-dropdown-content {
                display: none;
                position: absolute;
                background-color: #fff;
                min-width: 150px;
                box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
                z-index: 1;
                border-radius: 8px;
                overflow: hidden;
            }

            .perfil-dropdown-content a {
                color: black;
                padding: 10px 15px;
                text-decoration: none;
                display: block;
            }

            .perfil-dropdown-content a:hover {
                background-color: #f1f1f1;
            }

            .perfil-dropdown:hover .perfil-dropdown-content {
                display: block;
            }

            .perfil-trigger {
                cursor: pointer;
                display: flex;
                align-items: center;
                margin-right: 30px;
            }

            .perfil-trigger img {
                margin-right: 5px;
                border-radius: 50%;
            }
            .boton-logout {
                border: none;
                background-color: white;
                padding: 10px 15px;
                width: 100%;
                text-align: left;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
        }

            .boton-logout:hover {
                background-color: #f1f1f1;
                color: #333;
        }
        </style>
    </head>
    <body>
        <header style="background-color:#FFFFF; padding: 15px 0px 15px 0px;">
            <div style="display:flex; justify-content: space-between; align-items: center; paddin: 10px">
                <a href="{{ route('Inicio') }}">
                    <img src="/Imagenes/fisica.png" width="33" height="auto" style="margin-left: 15px;">
                    </a>
                    <div class="perfil-dropdown">
                        <div class="perfil-trigger">
                            <img 
                                src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('Imagenes/IconoDefaul.png') }}" 
                                alt="Perfil" 
                                width="24" 
                                height="24">
                                Hola, {{ Auth::user()->name }}
                        </div>
                        <div class="perfil-dropdown-content">
                            <a href="{{ route('perfil.edit') }}">Perfil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="boton-logout">Cerrar Sesión</button>
                            </form>
                    </div>
                </div>
            </div>
        </header>
        <div class="Layout">
            <div class="TextoPosition">
            <h1 > Calculadora </h1>
            </div>
            <div class="carousel-container">
                <div class="carousel-slide">
                    <img src="/imagenes/PrimerLeyAnimacion.png" />
                </div>
                <div class="carousel-slide">
                    <img src="/imagenes/InerciaAnimacion.png" />
                </div>
                <div class="carousel-slide">
                    <img src="/imagenes/SegundaLeyMA.png" />
                </div>
                    <div class="carousel-slide">
                    <img src="/imagenes/SegundaLeyAnimacion.png" />
                </div>
                <div class="carousel-slide">
                    <img src="/imagenes/TerceraLeyAnimacion.png" />
                </div>
                <div class="carousel-slide">
                    <img src="/imagenes/AccionYReaccion.png" />
                </div>
            </div>
        </div>
        <div id="app"></div> 
        
        <script>
        let slideIndex = 0;
        carousel();

        function carousel() {
        const slides = document.getElementsByClassName("carousel-slide");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1; }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(carousel, 3000);
        }
    </script>
    </body>
    </html>
