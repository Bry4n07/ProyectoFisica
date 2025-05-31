<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
  <title>Inicio - Leyes de Newton</title>
  <style>
    :root {
      --header-bg: #B39DDB; /* Lila pastel suave */
      --ley1-color: #fadaed; /* Rosa pastel */
      --ley2-color: #daedfa; /* Verde menta suave */
      --ley3-color: #daddfa; /* Amarillo pastel */
      --fondo: #F3F4F6;
      --texto-principal: #37474F;
      --hover-bg: #D8BFD8; /* Hover suave */
      --hover-text: #8C7B9E; /* Texto oscuro pero armónico */
    }

    body {
      margin: 0;
      font-family: 'Quicksand', sans-serif;
      background-color: var(--fondo);
      color: var(--texto-principal);
    }

    h1, h2, h3, h4 {
      font-family: 'Quicksand', sans-serif;
    }

    a {
      text-decoration: none;
      transition: all 0.3s ease;
    }

    header {
      background-color: var(--header-bg);
      padding: 15px 30px;
    }

    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    header img {
      width: 29px;
      height: 28px;
    }

    .nav-links a {
      margin: 10px 0px 10px 40px;
      color: #FFFFFF;
      font-weight: bold;
      padding: 6px 12px;
      border-radius: 8px;
    }

    .nav-links a:hover {
      background-color: var(--hover-bg);
      color: var(--hover-text);
      transform: scale(1.05);
    }

    .Layout {
      display: flex;
      flex-direction: column-reverse;
      align-items: center;
      text-align: center;
      padding: 0;
      position: relative;
    }

    .ImagenInicio {
      background-image: url('/Imagenes/FondoInicio.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      width: 100%;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .TextoInicio {
      color: #FFFFFF;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
      animation: fadeZoom 2s ease-out;
    }

    .TextoInicio h1 {
      font-size: 3rem;
      font-weight: bold;
      margin: 0;
    }

    @keyframes fadeZoom {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .seccion-ley {
      opacity: 0;
      transform: translateY(50px);
      transition: opacity 0.8s ease, transform 0.8s ease;
      padding: 60px 20px;
    }

    .seccion-ley.mostrar {
      opacity: 1;
      transform: translateY(0);
    }

    .contenedor-ley {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 30px;
      max-width: 1000px;
      margin: auto;
    }

    .imagen-ley img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
    }

    .texto-ley {
      max-width: 700px;
    }

    #ley1 {
      background-color: var(--ley1-color);
    }

    #ley2 {
      background-color: var(--ley2-color);
    }

    #ley3 {
      background-color: var(--ley3-color);
    }

    .texto-ley h2, .texto-ley h3 {
      color: #37474F;
    }

    .texto-ley p {
      color: #263238;
      line-height: 1.6;
    }

    @media (min-width: 768px) {
      .Layout {
        flex-direction: row;
        text-align: left;
        height: 400px;
      }

      .contenedor-ley {
        flex-direction: row;
        align-items: flex-start;
      }

      .imagen-ley, .texto-ley {
        flex: 1;
      }
    }
    .CalculadoraPublic_texto {
        margin-left: -1337px;
        color: #FFFFFF;
        font-weight: bold;
        padding: 6px 7px;
    }
    .CalculadoraPublic_texto:hover {
        color: #8C7B9E;
        background-color: #D8BFD8;
        border-radius: 10px
    }
    .perfil-trigger {
        cursor: pointer;
        display: flex;
        align-items: center;
        margin-right: -160px;
        font-family: 'Quicksand', sans-serif;
        }

    .perfil-trigger img {
        margin-right: 5px;
        border-radius: 50%;
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
            font-family: 'Quicksand', sans-serif;
        }

        .perfil-dropdown-content a:hover {
            background-color: #f1f1f1;
         }

        .perfil-dropdown:hover .perfil-dropdown-content {
            display: block;
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
        .perfil-nombre {
            font-size: 16px;
            font-weight: 600;
            color: white;
            font-family: 'Quicksand', sans-serif;
}
  </style>
</head>
<body>
  <header>
    <div class="container">
      <a href="{{ route('Inicio') }}">
        <img style= "margin-left: -163px;" src="/Imagenes/fisica.png" alt="Física Logo">
        <a href="{{ route('Calculadora') }}" class="CalculadoraPublic_texto">Calculadora</a>
      </a>
            <div class="perfil-dropdown">
                    <div class="perfil-trigger">
                        <img 
                            src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('Imagenes/IconoDefaul.png') }}" 
                            alt="Perfil" 
                            width="24" 
                            height="24">
                            <span class="perfil-nombre">Hola, {{ Auth::user()->name }}</span>
                        </div>
                        <div class="perfil-dropdown-content">
                            <a href="{{ route('perfil.edit') }}" >Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="boton-logout">Cerrar Sesión</button>
                        </form>
                </div>
            </div>
    </div>
  </header>

  <div class="Layout">
    <div class="ImagenInicio">
      <div class="TextoInicio">
        <h1>Las Tres Leyes De Newton</h1>
      </div>
    </div>
  </div>

  <section class="seccion-ley animada" id="ley1">
    <div class="contenedor-ley">
      <div class="imagen-ley">
        <img src="/Imagenes/PrimeraLey.png" alt="Primera Ley">
      </div>
      <div class="texto-ley">
        <h2>Primera Ley</h2>
        <p>"Todo cuerpo persevera en su estado de reposo o movimiento uniforme y rectilíneo a no ser que sea obligado a cambiar su estado por fuerzas impresas sobre él."</p>
        <h3>Explicación</h3>
        <p>Los objetos mantienen su estado de movimiento a menos que una fuerza externa actúe sobre ellos.</p>
        <h3>Explicación sencilla</h3>
        <p>Un trineo en reposo necesita un empujón para moverse. Si no hay fricción, seguiría deslizándose por siempre.</p>
      </div>
    </div>
  </section>

  <section class="seccion-ley animada" id="ley2">
    <div class="contenedor-ley">
      <div class="texto-ley">
        <h2>Segunda Ley</h2>
        <p>"El cambio de movimiento es proporcional a la fuerza motriz impresa y ocurre según la línea recta a lo largo de la cual aquella fuerza se imprime."</p>
        <h3>Explicación</h3>
        <p>F = m × a, donde F es la fuerza, m la masa y a la aceleración.</p>
        <h3>Explicación sencilla</h3>
        <p>Un carrito lleno necesita más fuerza para moverse que uno vacío. La fuerza depende de la masa y aceleración.</p>
      </div>
      <div class="imagen-ley">
        <img src="/Imagenes/SegundaLey.png" alt="Segunda Ley">
      </div>
    </div>
  </section>

  <section class="seccion-ley animada" id="ley3">
    <div class="contenedor-ley">
      <div class="imagen-ley">
        <img src="/Imagenes/TerceraLey.png" alt="Tercera Ley">
      </div>
      <div class="texto-ley">
        <h2>Tercera Ley</h2>
        <p>"Con toda acción ocurre siempre una reacción igual y contraria."</p>
        <h3>Explicación</h3>
        <p>Si empujas algo, ese algo también te empuja con la misma fuerza en dirección contraria.</p>
        <h3>Explicación sencilla</h3>
        <p>Cuando saltas en un trampolín, tú lo empujas hacia abajo y él te impulsa hacia arriba.</p>
      </div>
    </div>
  </section>
     <footer>
        <p style="text-align: center;">© 2025 Calculadora - Leyes de Newton - Grupo #7</p>
    </footer>
  <script>
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('mostrar');
        } else {
          entry.target.classList.remove('mostrar');
        }
      });
    }, { threshold: 0.3 });

    document.querySelectorAll('.animada').forEach(section => {
      observer.observe(section);
    });
  </script>
</body>
</html>