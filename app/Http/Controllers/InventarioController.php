<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Capturamos el término de búsqueda
        
        // Si se realiza una búsqueda, filtrar los inventarios por el término
        if ($query) {
            $inventarios = Inventario::where('serie', 'LIKE', "%{$query}%")
                ->orWhere('activo_especifico', 'LIKE', "%{$query}%")
                ->orWhere('resguardatario', 'LIKE', "%{$query}%")
                ->orWhere('estatus', 'LIKE', "%{$query}%")
                ->orWhere('estado', 'LIKE', "%{$query}%")
                ->orWhere('modelo', 'LIKE', "%{$query}%")
                ->orWhere('departamento', 'LIKE', "%{$query}%")
                ->orWhere('juzgado', 'LIKE', "%{$query}%")
                ->orWhere('ubicacion', 'LIKE', "%{$query}%")
                ->get(); // Obtener los resultados filtrados
        } else {
            // Si no se realiza una búsqueda, mostrar todos los inventarios
            $inventarios = Inventario::all();
        }

        return view('inventarios.index', compact('inventarios', 'query'));
    }

    public function create()
    {
        return view('inventarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_registro' => 'required|date',
            'serie' => 'required|string|max:100',
            'activo_especifico' => 'required|string|max:255',
            'resguardatario' => 'required|string|max:255',
            'estatus' => 'required|string|max:50',
            'ubicacion' => 'nullable|string|max:255',
            'departamento' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'juzgado' => 'required|string|max:255',
        ]);

        $inventario = Inventario::create($request->all());

        // Generar código QR y guardar la ruta en la base de datos
        $inventario->qr_code = $this->generarCodigoQR($inventario);
        $inventario->save();

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado exitosamente.');
    }

    public function show(Inventario $inventario)
    {
        return view('inventarios.show', compact('inventario'));
    }

    public function edit(Inventario $inventario)
    {
        $inventario->fecha_registro = Carbon::parse($inventario->fecha_registro);
        return view('inventarios.edit', compact('inventario'));
    }

    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'fecha_registro' => 'required|date',
            'serie' => 'required|string|max:100',
            'activo_especifico' => 'required|string|max:255',
            'resguardatario' => 'required|string|max:255',
            'estatus' => 'required|string|max:50',
            'ubicacion' => 'nullable|string|max:255',
            'departamento' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'juzgado' => 'required|string|max:255',
        ]);

        // Eliminar QR anterior si existe
        if ($inventario->qr_code && file_exists(public_path($inventario->qr_code))) {
            unlink(public_path($inventario->qr_code));
        }

        // Actualizar el inventario
        $inventario->update($request->all());

        // Generar nuevo QR
        $inventario->qr_code = $this->generarCodigoQR($inventario);
        $inventario->save();

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado exitosamente.');
    }

    public function destroy(Inventario $inventario)
    {
        // Eliminar QR si existe
        if ($inventario->qr_code && file_exists(public_path($inventario->qr_code))) {
            unlink(public_path($inventario->qr_code));
        }

        $inventario->delete();

        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado exitosamente.');
    }

    /**
     * Generar el código QR del inventario con su información.
     */
    private function generarCodigoQR(Inventario $inventario)
    {
        $qrPath = 'qrcodes/inventario-' . $inventario->id . '.svg';

        // Información para el código QR
        $qrInfo = "Serie: " . $inventario->serie . "\n";
        $qrInfo .= "Activo Específico: " . $inventario->activo_especifico . "\n";
        $qrInfo .= "Resguardatario: " . $inventario->resguardatario . "\n";
        $qrInfo .= "Estatus: " . $inventario->estatus . "\n";
        $qrInfo .= "Estado: " . $inventario->estado . "\n";
        $qrInfo .= "Modelo: " . $inventario->modelo . "\n";
        $qrInfo .= "Departamento: " . $inventario->departamento . "\n";  
        $qrInfo .= "Juzgado: " . $inventario->juzgado . "\n";
        $qrInfo .= "Ubicación: " . $inventario->ubicacion . "\n";

        // Generar y guardar el QR
        QrCode::format('svg')->size(300)->generate($qrInfo, public_path($qrPath));

        return $qrPath;
    }
}
