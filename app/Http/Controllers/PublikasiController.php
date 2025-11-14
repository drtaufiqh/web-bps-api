<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    // GET /publikasi
    public function index()
    {
        return Publikasi::all();
    }

    // POST /publikasi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);

        $publikasi = Publikasi::create($validated);
        return response()->json($publikasi, 201);
    }

    // GET /publikasi/{id}
    public function show($id)
    {
        $publikasi = Publikasi::find($id);
        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }
        return $publikasi;
    }

    // PUT/PATCH /publikasi/{id}
    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::find($id);
        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'releaseDate' => 'sometimes|required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);

        $publikasi->update($validated);
        return response()->json($publikasi);
    }

    // DELETE /publikasi/{id}
    public function destroy($id)
    {
        $publikasi = Publikasi::find($id);
        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }

        $publikasi->delete();
        return response()->json(["message" => "Publikasi berhasil dihapus"]);
    }
}
