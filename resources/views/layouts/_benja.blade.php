<div class="benja-container" id="benja-main-container">
    <div id="benjaBubble" class="benja-speech-bubble">
        <p id="benja-text" class="benja-text">¡Guau! Soy Benja. ¿En qué te puedo ayudar hoy?</p>
        
        <div id="benja-actions" class="benja-actions">
            <button class="benja-btn" onclick="mostrarAyudaSistema()">¿Ayuda con el sistema?</button>
            <button class="benja-btn" onclick="preguntarYuyo()">¿Saber sobre un yuyo?</button>
            <button class="benja-btn" onclick="contarChiste()">¿Me contás un chiste?</button>
            <button class="benja-btn" onclick="charlaAmistosa()">¿Cómo estás hoy?</button>
        </div> 
        
        <button id="btn-volver" style="display:none; margin-top:10px; font-size:10px;" onclick="resetearMenu()">⬅ Volver</button>
        
        <div class="speech-tail"></div>
    </div>

    <img src="{{ asset('images/benja.png') }}" id="guiaVirtual" class="benja-avatar" alt="Benja">
</div>

<style>

    /* --- Estilos base del contenedor --- */
    .benja-container {
        position: fixed; /* O absolute, según tu layout */
        bottom: 20px;
        right: 20px;
        display: flex;
        flex-direction: column; /* Para poner la burbuja SOBRE el perro */
        align-items: flex-end; /* Alinea todo a la derecha */
        z-index: 1000; /* Asegura que esté por encima de todo */
        pointer-events: all !important;
    }

    .benja-avatar {
        display: block !important;
        min-width: 60px;
        min-height: 60px;
    }

    /* --- Estilos base del perrito --- */
    .benja-avatar {
        width: 60px; /* O el tamaño que prefieras */
        height: auto;
        cursor: pointer;
    }

   .benja-wrapper {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .benja-speech-bubble {
        background-color: white !important; /* Forzamos el fondo blanco */
        color: black !important;           /* Forzamos texto negro */
        border: 2px solid #333;
        border-radius: 15px;
        padding: 15px;
        width: 220px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        margin-bottom: 10px;
        position: relative;
        z-index: 1001; /* Un punto más alto que el contenedor */
        display: none;
    }

    /* El rabo de la burbuja (aseguramos que se vea) */
    .speech-tail {
        position: absolute;
        bottom: -10px;
        right: 20px;
        width: 0;
        height: 0;
    }

    /* Clase que activa el JS */
    .benja-speech-bubble.visible {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0);
    }

    .benja-text {
        margin: 0;
        font-family: sans-serif;
        font-size: 14px;
        color: #333;
        font-weight: bold;
    }

    .benja-avatar {
        width: 60px;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .benja-avatar:hover {
        transform: scale(1.1); /* Efecto feedback visual en el perro */
    }

    .benja-actions {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-top: 10px;
    }

    .benja-btn {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 15px;
        padding: 5px 10px;
        font-size: 12px;
        cursor: pointer;
        transition: background 0.2s;
        text-align: left;
    }

    .benja-btn:hover {
        background: #f0f0f0;
    }

    /* El rabo de la burbuja */
    .speech-tail {
        position: absolute;
        bottom: -10px;
        right: 20px;
        width: 0;
        height: 0;
    }
</style>

<script>
const interval = setInterval(() => {
    const avatar = document.getElementById('guiaVirtual');
    const bubble = document.getElementById('benjaBubble');
    const container = document.getElementById('benja-main-container');

    if (avatar && bubble) {
        console.log("¡Benja listo para la acción!");
        clearInterval(interval);
 
        // Al pasar el mouse por el perro
        avatar.onmouseenter = () => {
            console.log("Mostrando burbuja...");
            bubble.style.display = "block";
        };

        // Al salir del contenedor (perro + burbuja)
        container.onmouseleave = () => {
            console.log("Ocultando burbuja...");
            bubble.style.display = "none";
            if(typeof resetearMenu === 'function') resetearMenu();
        };
    }
}, 500);

// Funciones para los botones
function contarChiste() {
    const chistes = ["¿Qué hace un perro con un taladro? taladrando!", 
                     "¿Cómo llamas a un perro con un sistema de sonido envolvente?Un sub-guaufer.'.",
                     "¿Cómo reaccionó el pequeño perro Scottie cuando conoció al monstruo del lago Ness? ¡Quedó “terrier-ficado”!",
                     "¿Como le dice un gato a un evento muy desafortunado?. Una gatastrofe.",
                     "Que pasa cuando juntas a un perro con una calculadora?. Se convierte en el mejor amiga con el que puedas contar.",
                     "¿Qué le dice un perro a otro perro cuando se despiden?. '¡Después mandame un guau-sap!.",
                     "¿Adonde va un perro a cortarse el pelo?. '¡a la perruqueria!.",
                     "¿Como se le dice a un perro que estudia medicina?. -un dogtor-"
                     
                    
                    ];
    const r = Math.floor(Math.random() * chistes.length);
    mostrarRespuesta(chistes[r]);
}

function mostrarRespuesta(texto) {
    document.getElementById('benja-text').innerText = texto;
    document.getElementById('benja-actions').style.display = 'none';
    document.getElementById('btn-volver').style.display = 'block';
}

function resetearMenu() {
    document.getElementById('benja-text').innerText = "¡Guau! Soy Benja. ¿En qué te puedo ayudar hoy?";
    document.getElementById('benja-actions').style.display = 'flex';
    document.getElementById('btn-volver').style.display = 'none';
}

// Agregamos las otras funciones vacías para que no den error al hacer clic
function preguntarYuyo() { mostrarRespuesta("Pronto buscaré yuyos por vos."); }
function mostrarAyudaSistema() { mostrarRespuesta("Te ayudaré con el sistema."); }
function charlaAmistosa() { mostrarRespuesta("¡Estoy muy feliz de verte!"); }
</script>