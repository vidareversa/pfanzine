<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punilla Fanzine - Generador</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center; }
        h1 { color: #333; }
        input { margin: 20px 0; }
        button { background: #000; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>📚 Punilla Fanzine</h1>
        <p>Subí tu PDF en A4 (Vertical) para convertirlo en Fanzine.</p>
        
        @if(session('error_fanzine'))
            <div style="background: #fee2e2; color: #b91c1c; border: 1px solid #f87171; padding: 1rem; border-radius: 4px; margin-bottom: 20px; text-align: left;">
                <strong>¡Ups! Algo salió mal:</strong>
                <p style="margin: 5px 0 0 0; font-size: 0.9rem;">{{ session('error_fanzine') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div style="background: #fffbeb; color: #92400e; border: 1px solid #fbbf24; padding: 1rem; border-radius: 4px; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ asset('img/explicativo_fanzine.png') }}" alt="Explicación del Proceso de Fanzine" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 8px;">
        </div>
        <form action="{{ route('fanzine.convertir') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="pdf_file" accept="application/pdf" required>
            <br>
            <button type="submit" onclick="this.innerHTML='Procesando...'; this.style.opacity='0.5';">
                Generar PDF para Imprimir
            </button>
        </form>
    </div>
</body>
</html>