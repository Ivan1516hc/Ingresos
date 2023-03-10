<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ServiceController
 * @package App\Http\Controllers
 */
class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();

            if ($user->profile_id === 2 || $user->profile_id === 3) {
                if (in_array($request->route()->getName(), ['services.create', 'services.store','services.edit', 'services.update', 'services.destroy'])) {
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
        $services = Service::paginate();

        return view('service.index', compact('services'))
            ->with('i', (request()->input('page', 1) - 1) * $services->perPage());
    }

    public function getServicesUser(){
        $user = Auth::user();
        $services = Service::where('not_binding',0)->whereHas('groups.locations.users', function ($query) use($user){
            return $query->where('users.id',$user->id);
        } )->get();

        return response()->json($services);
    }

    public function getServicesNotbilding(){
        $user = Auth::user();
        $services = Service::where('not_binding',1)->whereHas('groups.locations.users', function ($query) use($user){
            return $query->where('users.id',$user->id);
        } )->get();

        return response()->json($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = new Service();
        return view('service.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Service::$rules);

        $service = Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);

        return view('service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);

        return view('service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        request()->validate(Service::$rules);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $service = Service::find($id)->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully');
    }
}
