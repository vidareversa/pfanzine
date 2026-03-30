<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FanzineController extends Controller
{
    public function index() {
        return view('index');
    }

    public function convertir(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:20480', // Máximo 20MB
        ]);

        try {
            ini_set("memory_limit", "512M");
            set_time_limit(300);

            $path = $request->file('pdf_file')->getRealPath();

            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4-L',
                'margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 0,
                'import_unsupported_pdf_version' => true,
            ]);

            // Intentamos leer el archivo
            $realPageCount = $mpdf->setSourceFile($path);
            
            if ($realPageCount == 0) {
                throw new \Exception("El archivo parece estar vacío.");
            }

            $totalPaginas = ceil($realPageCount / 4) * 4;
            $izq = $totalPaginas;
            $der = 1;

            while ($der < $izq) {
                $mpdf->AddPage();
                $this->renderPagina($mpdf, $izq, 0, $realPageCount);
                $this->renderPagina($mpdf, $der, 148.5, $realPageCount);
                $izq--; $der++;

                $mpdf->AddPage();
                $this->renderPagina($mpdf, $der, 0, $realPageCount);
                $this->renderPagina($mpdf, $izq, 148.5, $realPageCount);
                $izq--; $der++;
            }

            return $mpdf->Output('fanzine_punilla.pdf', 'D');

        } catch (\setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException $e) {
            // ERROR ESPECÍFICO DE CIFRADO O VERSIÓN
            return back()->with('error_fanzine', '⚠️ El PDF tiene restricciones de seguridad o una compresión no soportada. Tip: Abrilo en Chrome, dale a "Imprimir" y elegí "Guardar como PDF" para limpiarlo.');
        } catch (\Exception $e) {
            // CUALQUIER OTRO ERROR (Memoria, archivo corrupto, etc.)
            return back()->with('error_fanzine', 'Ocurrió un problema: ' . $e->getMessage());
        }
    }

    private function renderPagina($mpdf, $numPag, $x) {
        if ($numPag > 0) {
            try {
                $tplId = $mpdf->importPage($numPag);
                $mpdf->useTemplate($tplId, $x, 0, 148.5, 210);
            } catch (\Exception $e) {
                // no hace nada y queda el hueco blanco.
            }
        }
    }
}