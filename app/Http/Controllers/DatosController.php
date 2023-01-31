<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Location;
use App\Models\Profile;
use App\Models\Promoter;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatosController extends Controller
{
    public function profiles(){
        $profiles = DB::connection('mysql_2')->table("perfiles")->get();
        foreach ($profiles as $profile){
            Profile::create([
                'name'  => $profile->nombrePerfil,
            ]);
        }
        return response()->json($profiles);
    }

    public function groups(){
        $groups = DB::connection('mysql_2')->table("grupos")->get();
        foreach ($groups as $group){
            Group::create([
                'name'  => $group->nombre,
                'order'  => $group->activo,
            ]);
        }
        return response()->json($groups);
    }

    public function locations(){
        $locations = DB::connection('mysql_2')->table("ubicacion")->get();
        foreach ($locations as $location){
            Location::create([
                'location'  => $location->ubicacion,
                'name'  => $location->Nombre,
                'group_id'  => $location->grupo,
                // 'manager_id' => $location->responsable
            ]);
        }
        return response()->json($locations);
    }

    public function therapists(){
        $therapists = DB::connection('mysql_2')->table("terapeutas")->get();
        foreach ($therapists as $therapist){
            Therapist::create([
                'name'  => $therapist->nombre,
            ]);
        }
        return response()->json($therapists);
    }

    public function promoters(){
        $promoters = DB::connection('mysql_2')->table("promotores")->get();
        foreach ($promoters as $promoter){
            Promoter::create([
                'name'  => $promoter->nombre,
            ]);
        }
        return response()->json($promoters);
    }

    public function users(){
        $users = DB::connection('mysql_2')->table("user")->get();
        // dd($users);
        foreach ($users as $user){
            
            User::create([
                'username'    => $user->usr,
                'password'    => Hash::make($user->pwd),
                'name'        => $user->nombre,
                'post'        => $user->puesto,
                'profile_id'  => $user->perfil,
                'location_id' => $user->idubicacion,
            ]);
        }
        return response()->json($users);
    }

    public function services(){}

    public function groupsServices(){}

    public function transactions(){}

    public function partialPayments(){}

    public function servicesTransactions(){}

    public function promotersTransactions(){}

    public function therapistsTransactions(){}

    public function cancellationHistories(){}

    public function reprintHistories(){}
}
