<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $query = Company::all();
        return response()->json([
            "success" => true,
            "data" => $query,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = new Company($request->all());
        $game->save();
        return response()->json($game, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!ctype_digit($id)) {
            return response()->json([
                'success' => false,
                'message' => 'El ID debe ser un número.'
            ], 400); // Código de estado 400 para solicitud incorrecta
        }
        $query = Company::findOrFail($id);
        return response()->json([
            "success" => true,
            "data" => $query,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $comapny = Company::find($id);
        if ($comapny) {
            $comapny->fill($request->all());
            $comapny->save();

            return response()->json($comapny, 200);
        } else {
            return response()->json(['error' => 'Game not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $comapny = Company::find($id);
        if ($comapny) {
            $comapny->delete();
            return response()->json(['message' => 'Company deleted'], 200);
        } else {
            return response()->json(['error' => 'Company not found'], 404);
        }
    }
}
