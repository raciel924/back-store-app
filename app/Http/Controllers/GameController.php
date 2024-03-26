<?php

namespace App\Http\Controllers;

use App\Models\CompanyGames;
use App\Models\Games;
use App\Models\Company;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::all();
        return response()->json($games, 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $companyExists = Company::where('id', $request->get('company_id'))->exists();
        if (!$companyExists) {
            return response()->json(['success' => false, 'message' => 'El company_id proporcionado no existe'], 400);
        }
        DB::beginTransaction();
        try {

            $game = new Games();
            $game->nombre = $request->get("nombre");
            $game->save();


            $juego = new CompanyGames();
            $juego->stock = $request->get("stock");
            $juego->price = $request->get("price");
            $juego->company_id = $request->get("company_id");
            $juego->game_id = $game->id;
            $juego->save();
            DB::commit();

            return response()->json(["success" => true, "game" => $game, "details" => $juego ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["success" => false, "message" => "Hubo un error al guardar los datos"], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Games::find($id);
        if ($game) {
            return response()->json($game, 200);
        } else {
            return response()->json(['error' => 'Game not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $game = Games::find($id);

        if ($game) {
            $game->nombre =$request->get('nombre');
            $game->save();

            $game->companies()->updateExistingPivot($request->get('company_id'), [
                'stock' => $request->get('stock'),
                'price' => $request->get('price')
            ]);


            return response()->json($game, 200);
        } else {

            return response()->json(['error' => 'Game not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Games::find($id);
        if ($game) {
            $game->delete();
            return response()->json(['message' => 'Game deleted'], 200);
        } else {
            return response()->json(['error' => 'Game not found'], 404);
        }
    }
}
