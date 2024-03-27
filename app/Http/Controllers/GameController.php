<?php

namespace App\Http\Controllers;

use App\Models\CompanyGames;
use App\Models\Games;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response()->json([
            "success" => true,
            "data" => $games,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//     {
//         //
//     }

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
        if (!ctype_digit($id)) {
            return response()->json([
                'success' => false,
                'message' => 'El ID debe ser un número.'
            ], 400); // Código de estado 400 para solicitud incorrecta
        }
        $game = Games::findOrFail($id);;
        return response()->json([
            "success" => true,
            "data" => $game,
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
        $companyExists = Company::where('id', $request->get('company_id'))->exists();
        if (!$companyExists) {
            return response()->json(['success' => false, 'message' => 'El company_id proporcionado no existe'], 400);
        }

        $game = Games::find($id);
        if (!$game) {
            return response()->json(['error' => 'El id del juego no existe'], 404);
        }

        DB::beginTransaction();
        try {
            $companyGame = CompanyGames::where('game_id', $game->id)
                ->where('company_id', $request->get('company_id'))
                ->first();

            if (!$companyGame) {
                return response()->json(['success' => false, 'message' => 'No se encontró la relación juego-compañía'], 404);
            }

            $companyGame->stock = $request->get('stock');
            $companyGame->price = $request->get('price');
            $companyGame->save();
            DB::commit();

            return response()->json(['success' => true, 'game' => $game], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["success" => false, "message" => "Hubo un error al actualizar los datos"], 500);
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
        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        DB::beginTransaction();
        try {
            if ($game->companies()) {
                $game->companies()->detach();
            }

            $game->delete();
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Game deleted'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Hubo un error al eliminar el juego'], 500);
        }
    }
}
