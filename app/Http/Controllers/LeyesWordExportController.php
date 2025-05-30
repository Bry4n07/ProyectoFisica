<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LeyesWordExportController extends Controller
{
    public function export(Request $request)
    {
        $tipo = $request->input('tipo'); // "F", "M", "A" , "M1", "M2", "A1" o A2
        $nombre = Auth::user()->name;
        $fecha = now()->format('d/m/Y');

        // Valores desde Vue o ejemplo fijo
        $m = $request->input('masa');
        $a = $request->input('aceleracion');
        $f = $request->input('fuerza');
        //Tercera ley
        $M1 = $request->input('masa1');
        $M2 = $request->input('masa2');
        $A1 = $request->input('aceleracion1');
        $A2 = $request->input('aceleracion2');

        $contenido = "";
        $ejemplo = "";
        $pregunta = "";
        $respuesta = "";
        // tercera ley
        $contenido3 = "";
        $ejemplo3 = "";
        $pregunta3 = "";
        $respuesta3 = "";

        // segunda Ley para dar el documento de word
        if ($tipo === "F") {
            $fuerza = $m * $a;
            $contenido = "
            Cálculo de la Fuerza:\n
            Masa (m): {$m} kg\n
            Aceleración (a): {$a} m/s²\n
            F = m × a\n
            F = {$m} × {$a} = {$fuerza} N
            ";

            $ejemplo = "Un bloque de {$m} kg es empujado con una aceleración de {$a} m/s² sobre una superficie sin fricción.";

            $pregunta ="Cuál es la fuerza neta que actúa sobre el bloque";

            $respuesta = "La fuerza neta que actúa sobre el bloque es {$fuerza} N.";

        } elseif ($tipo === "M") {
            $masa = number_format($f / $a, 2);
            $contenido = "
            Cálculo de la Masa:\n
            Fuerza (F): {$f} N\n
            Aceleración (a): {$a} m/s²\n
            m = F ÷ a\n
            m = {$f} ÷ {$a} = {$masa} kg
            ";

            $ejemplo = "Una fuerza de {$f} N se aplica a un objeto, produciendo una aceleración de {$a} m/s².";

            $pregunta = "Cuál es la masa del objeto";

            $respuesta = "La masa del objeto es {$masa} kg.";

        } elseif ($tipo === "A") {
            $aceleracion = number_format($f / $m, 2);
            $contenido = "
            Cálculo de la Aceleración:\n
            Fuerza (F): {$f} N\n
            Masa (m): {$m} kg\n
            a = F ÷ m\n
            a = {$f} ÷ {$m} = {$aceleracion} m/s²
            ";

            $ejemplo = "Un objeto con una masa de {$m} kg es empujado con una fuerza de {$f} N.";

            $pregunta = "Cuál es la aceleración del objeto";

            $respuesta = "La aceleración del objeto es {$aceleracion} m/s².";

        } 
          // Tercera Ley para dar el documento de word
        elseif ($tipo === "M1") {
            $masa1 = number_format(($M2 * $A2) / $A1, 2);
            $contenido = "
            Cálculo de Masa 1 (M1):\n
            M2 = {$M2} kg
            A2 = {$A2} m/s²
            A1 = {$A1} m/s²\n
            M1 = (M2 × A2) ÷ A1 = ({$M2} × {$A2}) ÷ {$A1} = {$masa1} kg
            ";

            $ejemplo = "Un camión remolca una plataforma de {$M2} kg (M2), que acelera a {$A2} m/s² (A2). El camión acelera a {$A1} m/s² (A1).";
            $pregunta = "Cuál es la masa del camión";
            $respuesta = "La masa del camión es {$masa1} kg.";
        }
        elseif ($tipo === "A1") {
            $aceleracion1 = number_format(($M2 * $A2) / $M1, 2);
            $contenido = "
            Cálculo de Aceleración 1 (A1):\n
            M2 = {$M2} kg
            A2 = {$A2} m/s²
            M1 = {$M1} kg\n
            A1 = (M2 × A2) ÷ M1 = ({$M2} × {$A2}) ÷ {$M1} = {$aceleracion1} m/s²
            ";
            $ejemplo = "Un robot de {$M1} kg (M1) empuja una caja de {$M2} kg (M2), que acelera a {$A2} m/s² (A2).";
            $pregunta = "Cuál es la aceleración del robot";
            $respuesta = "La aceleración del robot es {$aceleracion1} m/s².";
        }
        elseif ($tipo === "M2") {
            $masa2 = number_format(($M1 * $A1) / $A2, 2);
            $contenido = "
            Cálculo de Masa 2 (M2):\n
            M1 = {$M1} kg
            A1 = {$A1} m/s²
            A2 = {$A2} m/s²\n
            M2 = (M1 × A1) ÷ A2 = ({$M1} × {$A1}) ÷ {$A2} = {$masa2} kg
            ";

            $ejemplo = "Un dron de {$M1} kg (M1) acelera a {$A1} m/s² (A1) al empujar una carga que acelera a {$A2} m/s² (A2).";
            $pregunta = "Cuál es la masa de la carga";
            $respuesta = "La masa de la carga es {$masa2} kg.";
        }
        elseif ($tipo === "A2") {
            $aceleracion2 = number_format(($M1 * $A1) / $M2, 2);
            $contenido = "
            Cálculo de Aceleración 2 (A2):\n
            M1 = {$M1} kg
            A1 = {$A1} m/s²
            M2 = {$M2} kg\n
            A2 = (M1 × A1) ÷ M2 = ({$M1} × {$A1}) ÷ {$M2} = {$aceleracion2} m/s²
            ";

            $ejemplo = "Un carrito de {$M1} kg (M1) empuja otro de {$M2} kg (M2), acelerando a {$A1} m/s² (A1).";
            $pregunta = "Cuál es la aceleración del segundo carrito";
            $respuesta = "La aceleración del segundo carrito es {$aceleracion2} m/s².";
        }
        else {
            $contenido = "No se especificó qué variable calcular.";
            $ejemplo = "";
            $pregunta = "";
            $respuesta = "";
            $contenido3 = "";
            $ejemplo3 = "";
            $pregunta3 = "";
            $respuesta3 = "";

        }

        //Cargar Plantilla de Word - seleccionar la plantilla adecuada
        if (in_array($tipo, ['F', 'M', 'A'])) {
            $templatePath = storage_path('app/plantillas/segunda_ley.docx');
        } elseif (in_array($tipo, ['M1', 'A1', 'M2', 'A2'])) {
            $templatePath = storage_path('app/plantillas/tercera_ley.docx');
        } else {
            return response()->json(['error' => 'Tipo de cálculo no reconocido.'], 400);
        }
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('contenido', ($contenido), 1); // permite saltos de línea
        $templateProcessor->setValue('ejemplo', ($ejemplo), 1);
        $templateProcessor->setValue('nombre', $nombre);
        $templateProcessor->setValue('fecha', $fecha);
        $templateProcessor->setValue('pregunta', ($pregunta), 1);
        $templateProcessor->setValue('respuesta', ($respuesta), 1);

        $templateProcessor->setValue('contenido3', ($contenido3), 1); // permite saltos de línea
        $templateProcessor->setValue('ejemplo3', ($ejemplo3), 1);
        $templateProcessor->setValue('pregunta3', ($pregunta3), 1);
        $templateProcessor->setValue('respuesta3', ($respuesta3), 1);

        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $templateProcessor->saveAs($tempFile);

        return response()->download($tempFile, 'segunda_ley_resultado.docx')->deleteFileAfterSend(true);
    }
}