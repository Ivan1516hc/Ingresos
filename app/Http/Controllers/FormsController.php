<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function getLocations(){
        $locations = Location::all();

        return response()->json($locations);
    }
}
