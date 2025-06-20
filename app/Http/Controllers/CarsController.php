<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarsRequest;
use App\Models\Cars;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index():JsonResponse
    {
//        Italo Ramírez
        $cars=Cars::select([
            'id',
            'modelo',
            'marca',
            'anio',
            'color',
            'placa'])->get();
        return response()->json($cars);
    }

    public function show(int $id): JsonResponse
    {
        $show= Cars::findOrFail($id);
        return response()->json([
            'status' => 200,
            'car' => $show
        ]);
    }

    public function store(CarsRequest $request)
    {
        $car = new Cars();

        $car->modelo = $request->modelo;
        $car->marca = $request->marca;
        $car->anio = $request->anio;
        $car->color = $request->color;
        $car->placa = $request->placa;

        $car->save();

        return response()->json([
            'status' => 201,
            'car' => $car
        ]);
    }

    public function update(Request $request, int $id)
    {
        $car = Cars::findOrFail($id);
        $payload = [
            'modelo' => $request->modelo,
            'marca' => isset($request->marca) ? $request->marca : $car->marca,
            'anio' => isset($request->anio) ? $request->anio : $car->anio,
            'color' => isset($request->color) ? $request->color : $car->color,
            'placa' => isset($request->placa) ? $request->placa : $car->placa
        ];

        $car->update($payload);

        return response()->json([
            'status' => 200,
            'car' => $car
        ]);
    }

    public function destroy(int $id)
    {
        $car = Cars::findOrFail($id);
        $car->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Car deleted successfully'
        ]);
    }
}
