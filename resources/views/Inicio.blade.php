<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Inicio </title>
        <style>
            body{
                margin: 0px;
                background-color: #6D6D6D;
            }
            h1, h2, h3, h4 {
                font-family: 'Poppins', sans-serif;
            }
            p, li {
                font-family: 'Roboto', sans-serif;
            }
            a{
                text-decoration: none;
                color: black;
            }
            .Layout{
                display: flex;
                padding:  10px 0px 0px 15px;

            }
            .ImagenInicio {
                flex: 1;
                background-image: url('/Imagenes/FondoInicio.png');
                background-size: contain;
                background-position: right;
                background-repeat: no-repeat;
                height: 600px;
                position: relative;
                margin-left: 320px;
            }
            .TextoInicio{
                position: absolute;
                top: 50%;
                left: 25%;
                transform: translate(-50%, -50%);
                color: white;
                text-shadow: 2px 2px 5px #000;
                max-width: 80%;
            }
            .TextoInicio h1 {
                font-size: 48px;
                font-weight: bold;
                margin: 0;
                text-shadow: 2px 2px 8px black;
                animation: efecto 2s ease-in-out;
            }
            @keyframes efecto {
                from { opacity: 0; transform: translateY(-6 px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .seccion-ley {
                opacity: 0;
                transform: translateY(50px);
                transition: opacity 0.8s ease, transform 0.8s ease;
                padding: 85px 40px;
                background-color: #5a5a5a;
            }

            .seccion-ley.mostrar {
                opacity: 1;
                transform: translateY(0);
            }

            .contenedor-ley {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 40px;
            }

            .imagen-ley {
                flex: 1;
                display: flex;
                justify-content: center;
            }

            .imagen-ley img {
                border-radius: 7px;
                width: 100%;
                max-width: 500px;
                height: auto;
            }

            .texto-ley {
                flex: 1;
            }
        </style>
    </head>
    <body>
        <header style="background-color:#2E2E2E; padding: 15px 0px 15px 0px;">
            <div style="display:flex; justify-content: space-between; align-items: center; paddin: 10px">
                <a href="{{ route('Inicio') }}">
                <img src="/Imagenes/fisica.png" width="33" height="auto" style="margin-left: 15px;">
                </a>
                <div style ="display:flex; gap: 20px">
                    <a href="{{ route('register') }}" style="color:white;" > Registrate </a>
                    <a href="{{ route('login') }}" style="color:white; margin-right:20px;"> Login </a>
                </div>
            </div>
        </header>
        <div class="Layout">
            <div class="ImagenInicio"> </div>
            <div class="TextoInicio">
                <h1> Las Tres Leyes De Newton </h1>
            </div>
        </div>
        <section class="seccion-ley animada" id="ley1">
            <div class="contenedor-ley">
                <div class="imagen-ley">
                    <img src="/Imagenes/PrimeraLey.jpg" alt="Imagen de la primera ley">
                </div>
                <div class="texto-ley">
                    <h2 style="color:#4FC3F7"> Primera ley </h2>
                    <p style="color:white"> "Todo cuerpo persevera en su estado de reposo o movimiento uniforme y rectilíneo a no ser que sea obligado a cambiar su estado por fuerzas impresas sobre él."</p>
                    <h3 style="color:#4FC3F7"> Explicación </h3>
                    <p style="color:white"> Esta ley establece que los objetos mantienen su estado de movimiento: si están en reposo, permanecerán quietos, y si se mueven, lo harán en línea recta a velocidad constante, a menos que una fuerza externa actúe sobre ellos. Esto significa que el cambio en el movimiento de un objeto siempre requiere la intervención de algo externo, como un empujón, una atracción gravitacional o la fricción.</p>
                    <h3 style="color:#4FC3F7"> Explicación sencilla</h3>
                    <p style="color:white"> Imagina un trineo detenido en la nieve. No se moverá hasta que alguien lo empuje (fuerza externa). Una vez en movimiento, seguiría deslizándose indefinidamente si no existiera la fricción de la nieve o el aire que lo frena. De igual forma, cuando un autobús frena de repente, los pasajeros sienten que son lanzados hacia adelante porque sus cuerpos tienden a mantener el movimiento que llevaban (inercia), hasta que el cinturón de seguridad o el asiento los detiene. En esencia, esta ley nos dice que las cosas no cambian su estado por sí solas; siempre hay algo detrás de ese cambio.</p>
            </div>
        </div>
        </section>
        <section class="seccion-ley animada" id="ley2" style="background-color:#6D6D6D">
        <div class="contenedor-ley">
            <div class="texto-ley">
                <h2 style="color:#4FC3F7"> Segunda Ley </h2>
                <p style="color:white"> "El cambio de movimiento es proporcional a la fuerza motriz impresa y ocurre según la línea recta a lo largo de la cual aquella fuerza se imprime."</p>
                <h3 style="color:#4FC3F7"> Explicación</h3>
                <p style="color:white"> Matemáticamente se expresa como 
                    F
                =
                m
                ⋅
                a
                F=m⋅a, donde:

                F
                F = Fuerza aplicada,

                m
                m = Masa del objeto,

                a
                a = Aceleración que adquiere.</p>
                <h3 style="color:#4FC3F7"> Explicación más sencilla </h3>
                <p style="color:white"> Piensa en empujar un carrito del supermercado vacío versus uno lleno. El vacío acelera fácilmente con un pequeño empujón (poca masa, mucha aceleración), mientras que el lleno requiere más fuerza para lograr la misma aceleración. Otro ejemplo: al patear un balón, si le das un golpe suave, volará lento; pero si le das un puntapié fuerte, saldrá disparado. La ley resume que el efecto de una fuerza depende tanto de su intensidad como de qué tan pesado sea lo que se mueve.</p>
            </div>
            <div class="imagen-ley">
                <img src="/Imagenes/SegundaLey.png" Alt="Imagen de la Segunda Ley">
            </div>
        </div>
        </section>
        <section class="seccion-ley animada" id="ley3">
            <div class="contenedor-ley">
                <div class="imagen-ley">
                    <img src="/Imagenes/TerceraLey.png">
                </div>
                <div class="texto-ley">
                    <h2 style="color:#4FC3F7"> Tercera Ley </h2>
                    <p style="color:white"> "Con toda acción ocurre siempre una reacción igual y contraria: las acciones mutuas de dos cuerpos siempre son iguales y dirigidas en sentidos opuestos."</p>
                    <h3 style="color:#4FC3F7"> Explicación</h3>
                    <p style="color:white"> Las fuerzas siempre actúan en pares: si un objeto A ejerce una fuerza sobre un objeto B, entonces B ejerce una fuerza igual pero opuesta sobre A. </p>
                    <h3 style="color:#4FC3F7"> Explicación más sencilla </h3>
                    <p style="color:white">Al saltar desde un trampolín, tus pies empujan la plataforma hacia abajo (acción), y esta te impulsa hacia arriba (reacción). Otro caso: cuando inflas un globo y lo sueltas sin amarrarlo, el aire escapa hacia atrás (acción), y el globo vuela hacia adelante (reacción). Esto demuestra que nunca hay una fuerza "sola"; siempre hay un par de fuerzas enfrentadas, aunque no siempre las veamos.</p>
                </div>
            </div>
        </section>
        <script>
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('mostrar');
                    } else {
                        entry.target.classList.remove('mostrar');
                    }
                });
            }, {
                threshold: 0.35
            });

            document.querySelectorAll('.animada').forEach(section => {
                observer.observe(section);
            });
    </script>
    </body>
</html> 