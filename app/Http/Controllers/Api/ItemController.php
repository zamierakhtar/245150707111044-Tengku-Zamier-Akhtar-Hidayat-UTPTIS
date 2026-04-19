<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ItemController extends Controller
{
    private static $items = [
        ['id' => 1, 'nama_barang' => 'Macbook Pro', 'harga' => 15000000],
        ['id' => 2, 'nama_barang' => 'Padel Racket', 'harga' => 2500000],
    ];

    public function index() {
        return response()->json(self::$items, 200);
    }

    public function show($id) {
        $item = collect(self::$items)->firstWhere('id', $id);
        if (!$item) {
            return response()->json(['message' => "Item dengan ID {$id} tidak ditemukan"], 404);
        }
        return response()->json($item, 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'harga' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return response()->json(['message' => 'Berhasil menambah barang', 'data' => $request->all()], 201);
    }

    public function update(Request $request, $id) {
        return response()->json(['message' => "Item ID {$id} berhasil diupdate (PUT)"]);
    }

    public function updatePartial(Request $request, $id) {
        return response()->json(['message' => "Item ID {$id} berhasil diupdate (PATCH)"]);
    }

    public function destroy($id) {
        return response()->json(['message' => "Item ID {$id} berhasil dihapus"]);
    }
}
