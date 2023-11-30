<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;

class ApiHotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotels::all();
        if ($hotels->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No se encontraron reservas.',
                'hotels' => []
            ]);
        } else {
            return response()->json([
                'status' => true,
                'hotels' => $hotels
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request)
    {
        $hotels = Hotels::create($request->all()["data"]);
        if ($hotels) {
            return response()->json([
                'status' => true,
                'message' => "Hotel creado exitosamente",
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el hotel"
            ], 500);
        }
    }
}
