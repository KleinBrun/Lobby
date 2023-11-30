<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ApiClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Clients::all();
        if ($clients->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No se encontraron reservas.',
                'clients' => []
            ]);
        } else {
            return response()->json([
                'status' => true,
                'clients' => $clients
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $clients = Clients::create($request->all()["data"]);

        // return response()->json([
        //     'status' => true,
        //     'message' => "Clients Created successfully!",
        //     'hotels' => $clients
        // ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clients = Clients::where('id_booking', $id)->get();

        if ($clients) {
            return response()->json([
                'status' => true,
                'clients' => $clients
            ]);
        } else {
            return response()->json([
                'status' => false,
                'clients' => []
            ]);
        }
    }
}
