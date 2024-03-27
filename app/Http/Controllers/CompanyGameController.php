<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyGames;
use App\Models\Games;
use Illuminate\Http\Request;

class CompanyGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companyGames = CompanyGames::all();
        return response()->json([
            "success" => true,
            "data" => $companyGames,
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
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
     public function show($id)
     {
         $gamesCompany = Company::where("id",$id)->with(["juegos"])->get();
         return response()->json([
             "success" => true,
             "data" => $gamesCompany,
         ]);
     }
    public function showName(Request $request)
    {

        $filter = $request->name;
        $games = Games::where("nombre","like", "%$filter%")->with(["companies"])->get();
        return response()->json([
            "success" => true,
            "data" => $games,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
