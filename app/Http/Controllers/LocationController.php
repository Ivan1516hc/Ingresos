<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class LocationController
 * @package App\Http\Controllers
 */
class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();

            if ($user->profile_id === 2) {
                if (in_array($request->route()->getName(), ['location.create', 'location.store', 'location.destroy'])) {
                    abort(403, 'Unauthorized action.');
                }
            }

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::paginate();

        return view('location.index', compact('locations'))
            ->with('i', (request()->input('page', 1) - 1) * $locations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = new Location();
        $groups = Group::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('location.create', compact('location','groups','departments','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Location::$rules);

        $location = Location::create($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Ubicación creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);

        return view('location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        $groups = Group::all();
        $departments = Department::all();
        $users = User::all();

        return view('location.edit', compact('location','groups','departments','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        request()->validate(Location::$rules);

        $location->update($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $location = Location::find($id)->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Ubicacion eliminada satisfactoriamente');
    }
}
