<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Clients;
use Illuminate\Http\Request;

class ApiBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Bookings::all();
        if ($bookings->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No se encontraron reservas.'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'bookings' => $bookings
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bookings = Bookings::create($request->all()["data"]);
        $id = $bookings->id;
        if ($request->all()['dataClient'] != "0") {
            foreach ($request->all()['dataClient'] as $item) {
                $client = new Clients;
                $client->fill($item);
                $client->id_booking = $id;
                $client->save();
            }
        }
        if ($bookings && $bookings->id) {
            return response()->json([
                'status' => true,
                'message' => "Reserva creada exitosamente",
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Error al crear la reserva"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Bookings::where('id_hotel', $id)->get();

        if ($booking) {
            return response()->json([
                'status' => true,
                'booking' => $booking
            ]);
        } else {
            return response()->json([
                'status' => false,
                'bookings' => []
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $name, $status)
    {
        $rowsAffected = Bookings::where('id', $id)->update([$name => $status]);
        if ($rowsAffected > 0) {
            return response()->json([
                'status' => true,
                'message' => "Bookings modificado!",
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No se realizaron cambios en Bookings.",
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rowsAffected = Bookings::where('id', $request->all()["data"]["id"])->update($request->all()["data"]);
        if ($rowsAffected > 0) {
            return response()->json([
                'status' => true,
                'message' => "Bookings modificado!",
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No se realizaron cambios en Bookings.",
            ], 200);
        }
    }
}
