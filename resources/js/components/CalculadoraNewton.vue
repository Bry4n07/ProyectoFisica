  <template>
    <div class="divCalculadoraP">
      <h1 style="margin: 0px 0px 0px 25px; padding: 0;color:#FFFFFF">Calcula Las Leyes</h1>
      <p style="margin: 0px 0px 20px 20px; padding: 0; color:#FFFFFF"> ¿Qué Ley Quieres Calcular? </p>

      <div class="buttonPosition">
        <button
          class="buttonLeyes"
          :class="{ selected: leySeleccionada === 1 }"
          @click="leySeleccionada === 1 ? leySeleccionada = null : leySeleccionada = 1"
        >Primera Ley</button>

        <button
          class="buttonLeyes"
          :class="{ selected: leySeleccionada === 2 }"
          @click="leySeleccionada === 2 ? leySeleccionada = null : leySeleccionada = 2"
          >Segunda Ley</button>

        <button
          class="buttonLeyes"
          :class="{ selected: leySeleccionada === 3 }"
          @click="leySeleccionada === 3 ? leySeleccionada = null : leySeleccionada = 3"
          >Tercera Ley</button>
      </div>

      <!-- Primera Ley -->
      <div v-if="leySeleccionada === 1" class="ContenedorPrimeraLey">
        <!-- Columna Izquierda: Inputs -->
        <div class="DivCalculadoraLeyesPrimeraLey">
          <label class="etiqueta-compacta">Fuerza Aplicada (N):</label>
          <input type="number" v-model="FuerzaPrimeraLey" placeholder="0" class="input-estilo" />

          <label class="etiqueta-compacta">Masa del Objeto (kg):</label>
          <input type="number" v-model="MasaPrimeraLey" placeholder="0" min="0.1" class="input-estilo" />

          <div class="BotonCalcularPrimeraLey">
            <button @click="simular">Simular</button>
          </div>
        </div>

        <!-- Columna Derecha: Sprite -->
        <div class="sprite-container">
          <div class="sprite" ref="ghast"></div>
        </div>
       </div>

      <!-- Segunda Ley-->
      <div v-if="leySeleccionada === 2" class="ContenedorCalculo">
        <!-- Columna izquierda con botones e inputs -->
        <div class="DivCalculadoraLeyes">
          <div class="EspacioBotones">
            <button class="BotonSegundaLey" :class="{ selected: VariableSeleccionada === 1 }" @click="VariableSeleccionada = 1">F</button>
            <button class="BotonSegundaLey" :class="{ selected: VariableSeleccionada === 2 }" @click="VariableSeleccionada = 2">M</button>
            <button class="BotonSegundaLey" :class="{ selected: VariableSeleccionada === 3 }" @click="VariableSeleccionada = 3">A</button>
          </div>
            <div class="EspacioCalculadora">
              <div class="bloque-input">
                <!-- Nombre de ingreso primer Label-->
                  <label class="etiqueta-compacta" v-if="VariableSeleccionada === 1">Masa (m)</label>
                  <label class="etiqueta-compacta" v-if="VariableSeleccionada === 2|| VariableSeleccionada === 3">Fuerza (F)</label>
                  <div class="input-con-unidad">
                    <input type="number" v-model="inputMasa" placeholder="0" />
                  <!-- Tipo de conversioón primer Labael -->
                  <span class="unidad-label" v-if="VariableSeleccionada === 1">kg</span>
                  <span class="unidad-label" v-if="VariableSeleccionada === 2 || VariableSeleccionada === 3">N</span>
                </div>
              </div>
              <div class="bloque-input">
                <!-- Nombre de ingreso segundo lable -->
                <label class="etiqueta-compacta" v-if="VariableSeleccionada === 1 || VariableSeleccionada === 2">Aceleración</label>
                <label class="etiqueta-compacta" v-if="VariableSeleccionada === 3">Masa</label>
                <div class="input-con-unidad">
                  <!-- Tipo de Conversión segundo label -->
                  <input type="number" v-model="inputAceleracion" placeholder="0" />
                  <span class="unidad-label" v-if="VariableSeleccionada === 1 || VariableSeleccionada === 2">m/s²</span>
                  <span class="unidad-label" v-if="VariableSeleccionada === 3 ">Kg</span>
                </div>
              </div>
              <!--Boton para exportar a Word los resultados-->
              <div class="BotonesCalcularUltimo">
                <form action="/export-word" method="GET">
                  <input type="hidden" name="tipo" :value="valorTipo" />
                  <input type="hidden" name="masa" :value="inputMasa" />
                  <input type="hidden" name="aceleracion" :value="inputAceleracion" />
                  <input type="hidden" name="fuerza" :value="inputMasa" />
                  <button type="submit">Generar Word</button>
                </form>
                <button @click="Calcular">Calcular</button>
              </div>
            </div>
        </div>
          <!-- Columna derecha: resultado -->
        <div class="ResultadoCalculadora" v-if="VariableSeleccionada">
            <p class="ResultadoCalculadora1" v-if="VariableSeleccionada === 1"> Fuerza: </p>
            <p class="ResultadoCalculadora1" v-if="VariableSeleccionada === 2"> Masa: </p>
            <p class="ResultadoCalculadora1" v-else-if="VariableSeleccionada === 3"> Aceleración: </p>
            <p class="ResultadoCalculadora2" v-if="VariableSeleccionada === 1"> <strong>F = {{ fuerza }} N</strong> 
            <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span> 
            </p>
            <p class="ResultadoCalculadora2" v-if="VariableSeleccionada === 2"> <strong>m = {{ masa }} Kg</strong> 
            <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span>
            </p>
            <p class="ResultadoCalculadora2" v-else-if="VariableSeleccionada === 3"> <strong>A = {{ aceleracion }} m/s²</strong> 
            <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span>
            </p>
          </div>
        </div>

          <!--Tercera Ley de Newton-->
        <div v-if="leySeleccionada === 3" class="ContenedorCalculo">
          <!-- Columna izquierda -->
          <div class="DivCalculadoraLeyes">
            <div class="EspacioBotones">
              <button class="BotonTerceraLey" :class="{ selected: VariableSeleccionadaTerceraLey === 1 }" @click="VariableSeleccionadaTerceraLey = 1">M1</button>
              <button class="BotonTerceraLey" :class="{ selected: VariableSeleccionadaTerceraLey === 2 }" @click="VariableSeleccionadaTerceraLey = 2">A1</button>
              <button class="BotonTerceraLey" :class="{ selected: VariableSeleccionadaTerceraLey === 3 }" @click="VariableSeleccionadaTerceraLey = 3">M2</button>
              <button class="BotonTerceraLey" :class="{ selected: VariableSeleccionadaTerceraLey === 4 }" @click="VariableSeleccionadaTerceraLey = 4">A2</button>
            </div>
            <div class="EspacioCalculadora">
              <!-- Valor de ingreso del primer Label-->
              <div class="bloque-input">
                <label class="etiqueta-compacta" v-if="VariableSeleccionadaTerceraLey === 1">Aceleración (a1)</label>
                <label class="etiqueta-compacta" v-if="VariableSeleccionadaTerceraLey === 2 || VariableSeleccionadaTerceraLey === 3 || VariableSeleccionadaTerceraLey === 4">Masa (m1)</label>
                <div class="input-con-unidad">
                  <input type="number" v-model="AceleracionTerceraLey" placeholder="0" />
                  <span class="unidad-label" v-if="VariableSeleccionadaTerceraLey === 1">m/s²</span>
                  <span class="unidad-label" v-if="VariableSeleccionadaTerceraLey === 2 || VariableSeleccionadaTerceraLey === 3 || VariableSeleccionadaTerceraLey === 4">Kg</span>
                </div>
              </div>
                <!-- Valor de ingreso del segundo Label-->
              <div class="bloque-input">
                <label class="etiqueta-compacta" v-if="VariableSeleccionadaTerceraLey === 1 || VariableSeleccionadaTerceraLey === 2">Masa (m2)</label>
                <label class="etiqueta-compacta" v-if="VariableSeleccionadaTerceraLey === 3 || VariableSeleccionadaTerceraLey === 4">Aceleración (a1)</label>
                <div class="input-con-unidad">
                  <input type="number" v-model="MasaTerceraLey" placeholder="0" />
                  <span class="unidad-label" v-if="VariableSeleccionadaTerceraLey === 1 || VariableSeleccionadaTerceraLey === 2">Kg</span>
                  <span class="unidad-label" v-if="VariableSeleccionadaTerceraLey === 3 || VariableSeleccionadaTerceraLey === 4">m/s²</span>
                </div>
              </div>
              <!-- Valor de ingreso del Tercer Label-->
              <div class="bloque-input">
                <label class="etiqueta-compacta" v-if="VariableSeleccionadaTerceraLey === 1 || VariableSeleccionadaTerceraLey === 2 || VariableSeleccionadaTerceraLey === 3">Aceleración (a2)</label>
                <label class="etiqueta-compacta" v-if="VariableSeleccionadaTerceraLey === 4">Masa (m2)</label>
                <div class="input-con-unidad">
                  <input type="number" v-model="Aceleracion2TerceraLey" placeholder="0" />
                  <span class="unidad-label" v-if="VariableSeleccionadaTerceraLey === 1 || VariableSeleccionadaTerceraLey === 2 || VariableSeleccionadaTerceraLey === 3">m/s²</span>
                  <span class="unidad-label" v-if="VariableSeleccionadaTerceraLey === 4">Kg</span>
                </div>
              </div>
              <div class="BotonesCalcularUltimo">
                <!--Botones para exportar a Word y calcular-->
                <!--Boton para exportar a Word los resultados-->
                <form action="/export-word" method="GET">
                  <input type="hidden" name="tipo" :value="valorTipoTercera" />
                  <input type="hidden" name="aceleracion1" :value="AceleracionTerceraLey" />
                  <input type="hidden" name="aceleracion2" :value="Aceleracion2TerceraLey" />
                  <input type="hidden" name="masa1" :value="AceleracionTerceraLey" />
                  <input type="hidden" name="masa2" :value="MasaTerceraLey" />
                  <button type="submit">Generar Word</button>
                </form>
                <!--Boton de Calcular -->
                <button @click="Calcular">Calcular</button>
              </div>
            </div>
          </div>

          <!-- Columna derecha: Nombre Parte Superior de lo que se busca -->
          <div class="ResultadoCalculadora" v-if="VariableSeleccionadaTerceraLey">
            <p class="ResultadoCalculadora1" v-if="VariableSeleccionadaTerceraLey === 1"> Masa (m1): </p>
            <p class="ResultadoCalculadora1" v-if="VariableSeleccionadaTerceraLey === 2"> Aceleración (a1): </p>
            <p class="ResultadoCalculadora1" v-else-if="VariableSeleccionadaTerceraLey === 3"> Masa (m2): </p>
            <p class="ResultadoCalculadora1" v-else-if="VariableSeleccionadaTerceraLey === 4"> Aceleración (a2): </p>
            <!-- Columna Derecha: Repuesta parte Inferior del resultado o mensaje de error si ingresa numeros con 0 que sean escencial para el calculo.-->
            <p class="ResultadoCalculadora2" v-if="VariableSeleccionadaTerceraLey === 1">
              <strong>M = {{ masa1 }} Kg</strong>
              <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span>
            </p>
            <p class="ResultadoCalculadora2" v-if="VariableSeleccionadaTerceraLey === 2">
              <strong>A = {{ aceleracion1 }} m/s²</strong>
              <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span>
            </p>
            <p class="ResultadoCalculadora2" v-else-if="VariableSeleccionadaTerceraLey === 3">
              <strong>M = {{ masa2 }} Kg</strong>
              <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span>
            </p>
            <p class="ResultadoCalculadora2" v-else-if="VariableSeleccionadaTerceraLey === 4">
              <strong>A = {{ aceleracion2 }} m/s²</strong>
              <span v-if="mensajeError" style="padding-left: 30px; color: black;"> ⚠️ {{ mensajeError }} </span>
            </p>
          </div>
        </div>
        <!--Si no se seleccionada nada -->
        <div v-if="leySeleccionada === null" class="pantalla-bienvenida">
          <!-- Contenedor de Kirby (rosado) -->
        <div class="kirby-container">
          <div class="kirby-bienvenida">¡Bienvenido al mundo de la física!</div>
          <div class="speech-bubble">Selecciona una ley</div>
          <img :src="KirbyImg" alt="Kirby" class="kirby" />
        </div>

        <!-- Estrella arriba -->
        <div class="estrella-superior">
          <img :src="EstrellaImg" alt="Estrella" />
        </div>

        <!-- Monito (enemigo de Kirby) CON globo -->
        <div class="kirby-monito">
          <div class="speech-bubble-monito">¡No olvides escoger una ley para comenzar!</div>
          <img :src="KirbyMonito" alt="Enemigo de Kirby" />
        </div>
        </div>
    </div>
  </template>

  <script>
  import KirbyImg from '@/assets/Kirby.png'; 
  import EstrellaImg from '@/assets/Estrella.png';
  import KirbyMonito from '@/assets/KirbyMonito.png';
  export default {
    computed: {
  valorTipo() {
    if (this.VariableSeleccionada === 1) return "F";
    if (this.VariableSeleccionada === 2) return "M";
    if (this.VariableSeleccionada === 3) return "A";
    return "";
  },
    valorTipoTercera() {
    if (this.VariableSeleccionada === 1) return "M1";
    if (this.VariableSeleccionada === 2) return "A1";
    if (this.VariableSeleccionada === 3) return "M2";
    if (this.VariableSeleccionada === 4) return "A2";
    return "";
  }
},
    data() {
      return {
        inputMasa: '',
        inputAceleracion: '',
        masa: '',
        aceleracion: '',
        fuerza: null,
        AceleracionTerceraLey: '',
        MasaTerceraLey: '',
        Aceleracion2TerceraLey: '',
        masa1: '',
        aceleracion1: '',
        fuerza1: '',
        masa2: '',
        aceleracion2: '',
        fuerza2: '',
        FuerzaPrimeraLey: '',
        TiempoPrimeraLey: '',
        leySeleccionada: null,
        VariableSeleccionada: 1,
        VariableSeleccionadaTerceraLey: 1,
        mensajeError: '',
        KirbyImg: KirbyImg,
        EstrellaImg: EstrellaImg,
        KirbyMonito: KirbyMonito,
      };
    },
    watch: {
        VariableSeleccionada() {
        this.mensajeError = ''; 
        },
        VariableSeleccionadaTerceraLey(){
          this.mensajeError = '';
        },
        leySeleccionada(nueva) {
          if (nueva !== 1 && this.spriteInterval) {
            clearInterval(this.spriteInterval);
          }
        },
        VariableSeleccionada() {
          this.mensajeError = '';
        },
        VariableSeleccionadaTerceraLey() {
          this.mensajeError = '';
        }
    },

methods: {
     async downloadWord() {
      try {
        const response = await fetch('/export-word', {
          method: 'GET',
          credentials: 'same-origin', // si la ruta está protegida por auth
          headers: {
            'Accept': 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
          },
        });

        if (!response.ok) throw new Error('Error en la descarga');

        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'calculos.docx';
        a.click();
        window.URL.revokeObjectURL(url);
      } catch (error) {
        console.error('Error al descargar el Word:', error);
      }
    },
  Calcular() {
    this.mensajeError = '';
    this.mostrarResultado = false;

    const calculos = {
      1: this.calcularPrimeraLey,
      2: this.calcularSegundaLey,
      3: this.calcularTerceraLey,
    };

    // Llamamos al cálculo correspondiente según la ley seleccionada
    if (calculos[this.leySeleccionada]) {
      calculos[this.leySeleccionada]();
    }
    
    this.mostrarResultado = true;
  },

  // Método para la primera ley de Newton
  calcularPrimeraLey() {
    
  },

simular() {
  const fuerza = parseFloat(this.FuerzaPrimeraLey);
  const masa = parseFloat(this.MasaPrimeraLey);

  if (isNaN(fuerza) || isNaN(masa) || masa <= 0) {
    this.mensajeError = 'Ingresa valores válidos para fuerza y masa (masa > 0)';
    return;
  }

  this.mensajeError = '';

  // Cálculo físico
  const aceleracion = fuerza / masa;

  const sprite = this.$refs.ghast;
  const container = sprite.parentElement;
  const spriteWidth = sprite.offsetWidth;
  const containerWidth = container.offsetWidth;

  // Distancia FÍSICA: recorrerá 80% del contenedor
  const distancia = containerWidth - spriteWidth - 2; // Le restamos 10px para margen de seguridad 

  // Calcular el tiempo necesario para recorrer esa distancia
  const tiempo = Math.sqrt((2 * distancia) / aceleracion);

  // Guardar resultados si quieres mostrar
  this.aceleracionCalculada = aceleracion;
  this.tiempoCalculado = tiempo.toFixed(2);
  this.distanciaCalculada = distancia.toFixed(2);

  // 🔴 Reset: detener animaciones anteriores
  anime.remove(sprite);
  if (this.spriteInterval) clearInterval(this.spriteInterval);
  sprite.style.transition = 'none';
  sprite.style.transform = `translateX(-${spriteWidth}px)`;
  sprite.style.visibility = 'hidden';
  sprite.style.backgroundPosition = '0px 0px';

  // Animar el sprite (frames)
  const spriteFrameWidth = 98;
  const frameRow = 0;
  const frameHeight = 77;
  const totalFrames = 4;
  const frameDuration = (tiempo * 1000) / totalFrames;

  let currentFrame = 0;
  this.spriteInterval = setInterval(() => {
    currentFrame = (currentFrame + 1) % totalFrames;
    const posX = -(currentFrame * spriteFrameWidth);
    const posY = -(frameRow * frameHeight);
    sprite.style.backgroundPosition = `${posX}px ${posY}px`;
  }, frameDuration);

  // Iniciar animación de movimiento
  const iniciarSimulacion = () => {
    anime.set(sprite, {
      translateX: -spriteWidth
    });

    sprite.style.visibility = 'visible';

    anime({
      targets: sprite,
      translateX: distancia,
      duration: tiempo * 1000,
      easing: 'easeInQuad',
      complete: () => {
        sprite.style.visibility = 'hidden';
        clearInterval(this.spriteInterval);
      }
    });
  };

  iniciarSimulacion();
},
  // Método para la segunda ley de Newton (ya la tienes parcialmente)
  calcularSegundaLey() {
    let fuerza, masa, aceleracion;

    // Calcular dependiendo de la variable seleccionada (Fuerza, Masa, Aceleración)
    if (this.VariableSeleccionada === 1) {
      // Calcular Fuerza
      masa = parseFloat(this.inputMasa);
      aceleracion = parseFloat(this.inputAceleracion);
      if (isNaN(masa) || isNaN(aceleracion)) {
        this.mensajeError = 'Por favor ingresa masa y aceleración.';
        return;
      }
      this.fuerza = (masa * aceleracion).toFixed(2);
    }

    if (this.VariableSeleccionada === 2) {
      // Calcular Masa
      fuerza = parseFloat(this.inputMasa);
      aceleracion = parseFloat(this.inputAceleracion);
      if (isNaN(fuerza) || isNaN(aceleracion) || aceleracion === 0) {
        this.mensajeError = 'Por favor ingresa fuerza y aceleración válida.';
        return;
      }
      this.masa = (fuerza / aceleracion).toFixed(2);
    }

    if (this.VariableSeleccionada === 3) {
      // Calcular Aceleración
      fuerza = parseFloat(this.inputMasa);
      masa = parseFloat(this.inputAceleracion);
      if (isNaN(fuerza) || isNaN(masa) || masa === 0) {
        this.mensajeError = 'Por favor ingresa fuerza y masa válida.';
        return;
      }
      this.aceleracion = (fuerza / masa).toFixed(2);
    }
  },

  // Método para la tercera ley de Newton
    calcularTerceraLey() {
      let masa1, aceleracion1, masa2, aceleracion2;

      // Calcular dependiendo de la variable seleccionada
      if (this.VariableSeleccionadaTerceraLey === 1){
        // Calcular Masa 1
          aceleracion1 = parseFloat(this.AceleracionTerceraLey);
          masa2 = parseFloat(this.MasaTerceraLey);
          aceleracion2 = parseFloat(this.Aceleracion2TerceraLey);

        //Verificación de datos. Si el usuario no ingresa datos salgra el mensaje.
        if (isNaN(masa2) || isNaN(aceleracion1) || isNaN(aceleracion2)){
          this.mensajeError = 'Por favor ingrese datos en todos los campos para poder calcular';
          return;
        }
        // Segunda Verificación de datos. Si el Usuario ingresa 0 en acelereacion1 saldrá el mensaje.
        if (aceleracion1 === 0){
          this.mensajeError = 'Por favor ingrese una "Aceleración (a1)" diferente de 0'
          return;
        }
        this.masa1 = (masa2 * aceleracion2 / aceleracion1).toFixed(2);
      }
      if (this.VariableSeleccionadaTerceraLey === 2){
        // Calcular Aceleración 1
        masa1 = parseFloat(this.AceleracionTerceraLey);
        masa2 = parseFloat(this.MasaTerceraLey);
        aceleracion2 = parseFloat(this.Aceleracion2TerceraLey);

        //Verificación de datos. Si el usuario no ingresa datos salgra el mensaje.
        if (isNaN(masa1) || isNaN(aceleracion2) || isNaN(masa2)){
          this.mensajeError = 'Por favor ingrese datos en todos los campos para poder calcular';
          return;
        }
        // Segunda Verificación de datos. Si el Usuario ingresa 0 en acelereacion1 saldrá el mensaje.
        if (masa1 === 0){
          this.mensajeError = 'Por favor ingrese una "Masa (m1)" diferente de 0'
          return;
        }
        this.aceleracion1 = (masa2 * aceleracion2 / masa1).toFixed(2);
      }
      if (this.VariableSeleccionadaTerceraLey === 3){
        // Calcular Masa 2
        masa1 = parseFloat(this.AceleracionTerceraLey);
        aceleracion1 = parseFloat(this.MasaTerceraLey);
        aceleracion2 = parseFloat(this.Aceleracion2TerceraLey);

        //Verificación de datos. Si el usuario no ingresa datos salgra el mensaje.
        if (isNaN(masa1) || isNaN(aceleracion1) || isNaN(aceleracion2)){
          this.mensajeError = 'Por favor ingrese datos en todos los campos para poder calcular';
          return;
        }
        // Segunda Verificación de datos. Si el Usuario ingresa 0 en acelereacion1 saldrá el mensaje.
        if (aceleracion2 === 0){
          this.mensajeError = 'Por favor ingrese una Aceleración (a2) diferente de 0';
          return;
        }
        this.masa2 = (masa1 * aceleracion1 / aceleracion2).toFixed(2);
      }
      if (this.VariableSeleccionadaTerceraLey === 4){
        // Calcular Aceleración 2
        masa1 = parseFloat(this.AceleracionTerceraLey);
        aceleracion1 = parseFloat(this.MasaTerceraLey);
        masa2 = parseFloat(this.Aceleracion2TerceraLey);

        //Verificación de datos. Si el usuario no ingresa datos salgra el mensaje.
        if (isNaN(masa1) || isNaN(aceleracion1) || isNaN(masa2)){
          this.mensajeError = 'Por favor ingrese datos en todos los campos para poder calcular';
          return;
        }
        // Segunda Verificación de datos. Si el Usuario ingresa 0 en acelereacion1 saldrá el mensaje.
        if(masa2 === 0){
          this.mensajeError = 'Por favor ingrese una Masa (m2) diferente de 0';
          return;
        }
        this.aceleracion2 = (masa1 * aceleracion1 / masa2).toFixed(2);
      } 
    }
  }
    }
  </script>
  <style scoped>
  .DivCalculadoraLeyes{
      margin: 27px 0px 0px 35px;
      display: flex;
      flex-direction: column;
  }
  .BotonSegundaLey{
      padding: 8px 50px;
      text-align: center;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-weight: bold;
      background-color: white;
      color: #4682B4;
      transition: background-color 0.3s, color 0.4s, transform 0.2s;
  }
  .BotonSegundaLey:hover{
    background-color: #E3DFFF;
    color: white;
  }
  .BotonSegundaLey:active{
    background-color: #E3DFFF;
    color: white;
    transform: scale(0.95);
  }
  .BotonSegundaLey.selected{
    background-color: #C4B0E2;
    color: white;
  }
  .EspacioBotones {
    display: flex;
    flex-direction: row;
    gap: 6px;
    margin-left: 11px;
    margin-bottom: 10px;
  }
  .divCalculadoraP {
    background-color: #FFC5D3;
    padding-bottom: 40px;
  }
  .buttonPosition {
    display: flex;
    flex-direction: row;
    gap: 5px;
    margin-left: 35px;
  }
  .buttonLeyes {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    background-color: #4682B4;
    color: white;
    transition: background-color 0.3s, color 0.3s, transform 0.2s;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
  }
  .buttonLeyes:hover {
    background-color: white;
    color: #4682B4;
    transform: translateY(-2px);
  }
  .buttonLeyes:active {
    background-color: #4682B4;
    color: white;
    transform: scale(0.95);
  }
  .buttonLeyes.selected {
    background-color: white;
    color: #4682B4;
  transform: scale(0.95); 
  }
  .ContenedorCalculo {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    gap: 40px;
  }

  .EspacioCalculadora {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .EspacioCalculadora .bloque-input {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .EspacioCalculadora label {
    width: 110px;
    color: white;
    margin-left: 20px;
  }

  .input-con-unidad {
    position: relative;
    width: 310px;
    margin-left: 20px;
  }

  .input-con-unidad input {
    width: 100%;
    height: 40px;
    padding: 0 50px 0 10px; /* Espacio derecho para la unidad */
    font-size: 16px;
    background-color: white;
    color: black;
    border: none;
    border-radius: 8px;
    box-sizing: border-box;
  }

  .input-con-unidad .unidad-label {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #2e3b4e;
    color: white;
    padding: 0 10px;
    font-size: 14px;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-left: 1px solid #4c5c6c;
    pointer-events: none;
  }
  .bloque-input {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .etiqueta-compacta {
    color: white;
    font-size: 14px;
    margin-top: 10px;
  }

  .ResultadoCalculadora {
    margin-top: 80px;
    border-radius: 8px;
    font-weight: bold;
    min-width: 100px;
    width: 67%;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    padding: 0;
    overflow: hidden;
  }
  .ResultadoCalculadora1 {
    padding: 12px 0px 12px 15px;
    background-color: #9C91D3 ; 
    font-family: poppins, sans-serif;
    color: #FFFFFF; 
    margin: 0;
  }
  .ResultadoCalculadora2 {
    background-color: #B9AEDC;
    color: #F4E6FF;
    font-family: Poppins, sans-serif;
    margin: 0;
    padding: 27px 0px 27px 15px;
  } 

  .BotonesCalcularUltimo {
    display: flex;
    flex-direction: row;
    gap: 70px;
    margin: 5px 0px 5px 32px;
  }
  .BotonesCalcularUltimo button {
    background-color: #7D5BA6;
    color: white;
    border: none;
    width: 106px;
    height: 31px; 
    cursor: pointer;
    border-radius: 7px;
    font-weight: bold;
    transition: background-color 0.3, transform 0.3;
  }
  .BotonesCalcularUltimo button:hover {
    background-color: #7D5BA6;
    transform: scale(1.1);
    box-shadow: 1px 3px 2px 1px rgba(0, 0, 0, 0.15);
  }

  /*Estilos para la 3ra ley*/
  .DivCalculadoraLeyesTerceraLey{
      margin: 27px 0px 0px 23px;
      display: flex;
      flex-direction: column;
      flex: 1;
  }
    .BotonTerceraLey{
      padding: 8px 34px;
      text-align: center;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-weight: bold;
      background-color: white;
      color: #4682B4;
      transition: background-color 0.3s, color 0.4s, transform 0.2s;
  }
  .BotonTerceraLey:hover{
    background-color: #E3DFFF;
    color: white;
  }
  .BotonTerceraLey:active{
    background-color: #E3DFFF;
    color: white;
    transform: scale(0.95);
  }
    .BotonTerceraLey.selected{
    background-color: #C4B0E2;
    color: white;
  }

  /* Primer Ley */
.sprite-container {
  width: 100%;
  height: 200px;
  position: relative;
  overflow: hidden;
  background-color: transparent;
  margin-top: 20px;
}

.sprite {
  width: 97px; /* ancho de un solo frame */
  height: 105px; /* alto de un solo frame */
  background-image: url('/sprites/happy-ghast.png'); /* ← sin /build */
  background-repeat: no-repeat;
  background-position: 0 0;
  position: absolute;
  top: 0;
  left: 0;
}

@keyframes animarSprite {
  from { background-position: 0 0; }
  to { background-position: -160px 0; }
}
/* Estilos para la priemra ley */
.ContenedorPrimeraLey {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  gap: 60px;
  margin: 20px 0 0 40px; /* Pegado a la izquierda */
}

.DivCalculadoraLeyesPrimeraLey {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 280px;
}

.input-estilo {
  width: 100%;
  height: 40px;
  padding: 8px 12px;
  font-size: 16px;
  border: none;
  border-radius: 8px;
  background-color: white;
  color: #333;
  box-sizing: border-box;
}

.etiqueta-compacta {
  color: #333;
  font-size: 14px;
  font-weight: bold;
}

.BotonCalcularPrimeraLey {
  display: flex;
  justify-content: flex-start;
  margin-top: 10px;
}

.BotonCalcularPrimeraLey button {
  background-color: #7D5BA6;
  color: white;
  font-size: 17px;
  border: none;
  padding: 10px 50px;
  margin-left:50px;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

.BotonCalcularPrimeraLey button:hover {
  background-color: #6e4f92;
  transform: scale(1.05);
  box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.1);
}

.sprite-container {
  width: 70%;
  height: 157px;
  margin-left: 45px;
  background-color: #e9ecef;
  border-radius: 12px;
  position: relative;
  overflow: hidden;
  flex-shrink: 0;
  margin-top: 12px;
}

.sprite {
  width: 97px;
  height: 104px;
  border-radius: 27%;
  position: absolute;
  top: 30px;
  left: 0;
  transition: transform 0.5s ease;
}

/*Cuando no hay nada seleccionado*/
.kirby-bienvenida {
  position: absolute;
  top: -60px;
  right: 0;
  background: rgba(255, 255, 255, 0.8);
  padding: 8px 14px;
  border-radius: 20px;
  font-weight: bold;
  font-size: 16px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  animation: float 3s ease-in-out infinite;
  z-index: 5;
}

.kirby-container {
  position: absolute;
  bottom: 3px;
  right: 544px; /* Valor original */
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  animation: float 3s ease-in-out infinite;
}

/* Estilo del globo de Kirby */
.speech-bubble {
  background: white;
  border-radius: 16px;
  padding: 10px 16px;
  margin-right: 269px;
  font-weight: bold;
  position: relative;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  margin-bottom: -21px;
}

.speech-bubble::after {
  content: '';
  position: absolute;
  bottom: -10px;
  right: 10px;
  width: 0;
  height: 0;
  border: 10px solid transparent;
  border-top-color: white;
}

.kirby {
  width: 300px;
  height: auto;
}

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

/* Estrella arriba */
.estrella-superior {
  position: absolute;
  top: 19px;
  left: 38vw; /* Más seguro que 86vw para no desaparecer */
  z-index: 10;
}

.estrella-superior img {
  height: 167px;
  width: auto;
  animation: float 4s ease-in-out infinite;
  transform: rotate(-20deg);
}

/* Monito enemigo */
.kirby-monito {
  position: absolute;
  bottom: -50px;
  right: -17px;
  padding: 10px;
  z-index: 2;
  animation: float 3s ease-in-out infinite;
}

.kirby-monito img {
  width: 150px;
  height: auto;
}

.speech-bubble-monito {
  background: white;
  border-radius: 16px;
  padding: 10px 16px;
  font-weight: bold;
  margin-bottom: -7px;
  position: relative;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  max-width: 200px;
  text-align: center;
  left: -10px;
}

.speech-bubble-monito::after {
  content: '';
  position: absolute;
  bottom: -10px;
  right: 20px;
  width: 0;
  height: 0;
  border: 10px solid transparent;
  border-top-color: white;
}

/* MEDIA QUERIES */
@media (max-width: 600px) {
  .kirby-container {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10px;
    align-items: center;
    display: flex;
    flex-direction: column;
    width: max-content;
  }

  .kirby {
    width: 120px;
  }

  .speech-bubble {
    margin: 0 auto 8px;
    text-align: center;
  }

  .estrella-superior {
    top: -100px;
    left: 60vw;
  }

  .estrella-superior img {
    height: 100px;
  }

  .divCalculadoraP {
    padding: 1rem;
    min-height: 100vh;
  }

  .buttonPosition {
    flex-direction: column;
    align-items: flex-start;
  }

  .buttonLeyes {
    width: auto;
    margin: 0.5rem 0;
  }

  .ContenedorPrimeraLey,
  .ContenedorSegundaLey,
  .ContenedorTerceraLey {
    flex-direction: row;
    flex-wrap: wrap;
  }

  .DivCalculadoraLeyesPrimeraLey,
  .DivCalculadoraLeyesSegundaLey,
  .DivCalculadoraLeyesTerceraLey {
    width: 100%;
    max-width: 100%;
  }

  .DivImagenKirby {
    display: flex !important;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-width: 100%;
  }

  .DivImagenKirby img {
    max-width: 150px;
    height: auto;
  }
}

.divCalculadoraP {
  width: 100%;
  min-height: 42vh;
  background-color: #f8c8dc;
  box-sizing: border-box;
}

.buttonPosition {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  justify-content: flex-start;
}

.buttonLeyes {
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  border-radius: 0.5rem;
  cursor: pointer;
}

.ContenedorPrimeraLey,
.ContenedorSegundaLey,
.ContenedorTerceraLey {
  display: flex;
  gap: 2rem;
  flex-wrap: nowrap;
  margin-top: 1rem;
}

.input-estilo {
  width: 100%;
  padding: 0.5rem;
  font-size: 1rem;
  box-sizing: border-box;
}

.DivImagenKirby {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

/* PATCH RESPONSIVO MINIMO */
@media (max-width: 600px) {
  .sprite-container {
    max-width: 100%;
    justify-content: center;
    position: relative;
  }

  .kirby {
    width: 80px;
  }

  .star {
    width: 40px;
    position: absolute;
    top: 0;
    left: 60%;
    transform: translateX(-50%);
  }

  .main-content {
    padding-bottom: 1rem !important;
  }
}

.pantalla-bienvenida {
  position: relative;
  min-height: 356px;
  padding: 51px;
}

/* En pantallas pequeñas (teléfonos), reducir el min-height */
@media (max-width: 300px) {
  .pantalla-bienvenida {
    min-height: 300px; /* o el valor que prefieras */
    padding: 30px 20px; /* también puedes ajustar el padding si es necesario */
  }
}
</style>