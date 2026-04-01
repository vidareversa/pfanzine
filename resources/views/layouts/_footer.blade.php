<footer style="margin-top: 50px; padding: 20px; text-align: center; border-top: 1px solid #eee; color: #90a4ae; position: absolute; bottom: 0; overflow: hidden;">
    
    <div id="lock-screen" class="lock-overlay">
        <div class="lock-content">
            <div class="benja-sprite-static"></div> <h2 style="font-family: 'Crimson Text', serif; font-style: italic;">Punisoft Secure</h2>
            <input type="password" id="pin-input" maxlength="4" placeholder="PIN" inputmode="numeric" />
            <p id="lock-msg">Presiona Enter para desbloquear</p>
        </div>
    </div>
    
    <div id="puni-leyenda">
        <p style="font-size: 0.85rem; font-style: italic;">
            PFanzine - Versión Beta 1.0 <br>
            <span style="font-size: 0.7rem;">Hecho en Punilla</span>
        </p>
    </div>

    <div class="marquee-footer">
        <div class="palta-container">
            <!--img id="guia-virtual" src="{{ asset('images/palta.png') }}" alt=" " /-->
        </div>
    </div>

    <!--div class="guia-virtual">
        <img id="guia-virtual" src="{{ asset('images/benja.png') }}" alt="Benja" title="Hola!, soy Benja, tu guia virtual. Preguntame cualquer cosa" />
    </div-->
    
</footer>

<style>

    footer {
        position: absolute;
        bottom: 0;
    }

    #puni-leyenda {
        z-index: 1;
    }

    #guia-virtual {
        width: 60px;
        height: 60px;
        cursor:pointer;
        z-index: -1;
    }

    .guia-virtual {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }

    @keyframes agitarLengua {
        0%, 16.66% { background-image: url('benja-frame1.png'); }
        16.67%, 33.32% { background-image: url('benja-frame2.png'); }
        33.33%, 49.98% { background-image: url('benja-frame3.png'); }
        49.99%, 66.64% { background-image: url('benja-frame4.png'); }
        66.65%, 83.30% { background-image: url('benja-frame5.png'); }
        83.31%, 100% { background-image: url('benja-frame6.png'); }
    }

    .benja-sprite {
        width: 64px; /* O el ancho de tu sprite */
        height: 64px; /* O el alto de tu sprite */
        animation: agitarLengua 1s steps(6) infinite; /* Ajusta la duración y el número de pasos */
    }

    .marquee-footer {
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 40px;
        pointer-events: none;
    }

    .emoji-tractor {
        z-index: 2;
    }

    .emoji-product {
        font-size: 18px;
        z-index: 1;
        margin-left: -5px; /* Para que parezca que lo lleva cargado */
    }

    @keyframes cosecha-infinita {
        0% {
            left: -10%;
            transform: scaleX(1);
        }
        49% {
            transform: scaleX(1);
        }
        50% {
            left: 110%;
            transform: scaleX(-1); /* Gira para volver */
        }
        99% {
            transform: scaleX(-1);
        }
        100% {
            left: -10%;
            transform: scaleX(1);
        }
    }

    .palta-container {
        position: absolute;
        font-size: 28px; /* Un poquito más grande */
        white-space: nowrap;
        animation: cosecha-infinita 60s linear infinite;
        display: flex;
        align-items: center;
        justify-content: center; /* Centrado */
        bottom: 5px;
        z-index: -1;
    }

    .emoji-anteojos {
        font-size: 18px; /* Anteojos más pequeños que la palta */
        margin-left: -18px; /* SUPERPUESTO sobre la palta */
        margin-top: -5px; /* Ajuste vertical para que queden en los 'ojos' */
        z-index: 2; /* Por encima */
    }

    .emoji-palta {
        z-index: 1; /* Por debajo */
    }
    
    /* Pantalla de bloqueo */
    .lock-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fcf9f2; /* El mismo crema de la web */
        display: none; /* Oculto por defecto */
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 9999; /* Por encima de TODO */
    }

    .lock-content {
        text-align: center;
        animation: fadeIn 0.3s;
    }
    
    #pin-input {
        background: transparent;
        border: none;
        border-bottom: 2px solid var(--accent-dark);
        font-size: 2rem;
        width: 100px;
        text-align: center;
        outline: none;
        color: var(--text-color);
        letter-spacing: 5px;
    }

    #lock-msg {
        margin-top: 20px;
        font-size: 0.8rem;
        opacity: 0.5;
    }

    .lock-overlay.active {
        display: flex;
    }

    @keyframes vibrar {
        0% { transform: translateX(0); }
        25% { transform: translateX(5px); }
        50% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
        100% { transform: translateX(0); }
    }

    .vibrar {
        animation: vibrar 0.2s limit 2;
    }

    /* Asegúrate de que el input no tenga estilos de sistema que molesten */
    #pin-input {
        -webkit-text-security: disc; /* Opcional: convierte el PIN en puntitos para más privacidad */
        border-radius: 0;
        appearance: none;
    }

</style>

<script>
    const PIN_CORRECTO = "2244"; // ¡Cambiá tu PIN acá!
    const lockScreen = document.getElementById('lock-screen');
    const pinInput = document.getElementById('pin-input');

    // 1. Detectar la tecla F6
    window.addEventListener('keydown', (e) => {
        if (e.ctrlKey && e.key.toLowerCase() === 'l') {
            e.preventDefault(); // Evita funciones raras del navegador
            activarBloqueo();
        }
    });

    function activarBloqueo() {
        lockScreen.classList.add('active');
        pinInput.focus();
        pinInput.value = ''; // Limpiar si había algo
    }

    // 2. Lógica de desbloqueo con Enter
    pinInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            if (pinInput.value === PIN_CORRECTO) {
                lockScreen.classList.remove('active');
            } else {
                // Animación de error (opcional)
                pinInput.style.borderBottomColor = 'red';
                setTimeout(() => pinInput.style.borderBottomColor = '#b5838d', 500);
                pinInput.value = '';
            }
        }
    });

</script>