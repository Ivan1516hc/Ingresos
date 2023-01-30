<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatosController extends Controller
{
    public function users(){
        $users = DB::connection('mysql_2')->table("vw_personas")->get();
        dd($users);
        foreach ($users as $user){
            User::create([
                'name'  => $user->colonia,
                'town'  => $user->ciudad,
                'type'  => $user->tipo,
            ]);
        }
        return response()->json($users);
    }
}
