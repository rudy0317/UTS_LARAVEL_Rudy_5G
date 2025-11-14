<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index() {
        return agenda::all();
    }

    public function store(Request $request) {
        return agenda::create($request->all());
    }

    public function show($id) {
        return agenda::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $agenda = agenda::findOrFail($id);
        $agenda->update($request->all());
        return $agenda;
    }

    public function destroy($id) {
        return agenda::destroy($id);
    }
}