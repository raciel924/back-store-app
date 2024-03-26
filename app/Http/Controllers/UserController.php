<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class UserController extends Controller
{
    public function indexCompanies(){
        $query = Company::all();
        return response()->json([
            "success" => true,
            "data" => $query,  
        ]);
    }
}
