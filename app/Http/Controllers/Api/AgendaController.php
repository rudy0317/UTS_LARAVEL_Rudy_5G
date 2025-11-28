<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // GET - semua
    public function index()
    {
        return response()->json(Agenda::all(), 200);
    }

    // POST - tambah data
    public function store(Request $request)
    {
        // Validasi optional
        $request->validate([
            'judul' => 'required|string',
            'keterangan' => 'nullable|string',
            'is_done' => 'nullable'
        ]);

        $agenda = Agenda::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'is_done' => filter_var($request->is_done, FILTER_VALIDATE_BOOLEAN)
        ]);

        return response()->json($agenda, 201);
    }

    // GET by ID
    public function show($id)
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }

        return response()->json($agenda, 200);
    }

    // PUT - update
    public function update(Request $request, $id)
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }

        $agenda->update([
            'judul' => $request->judul ?? $agenda->judul,
            'keterangan' => $request->keterangan ?? $agenda->keterangan,
            'is_done' => $request->has('is_done')
                ? filter_var($request->is_done, FILTER_VALIDATE_BOOLEAN)
                : $agenda->is_done
        ]);

        return response()->json($agenda, 200);
    }

    // DELETE
    public function destroy($id)
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }

        $agenda->delete();

        return response()->json(['message' => 'Agenda deleted'], 200);
    }
}