<?php

namespace App\Http\Controllers;

use App\Models\GroupsService;
use Illuminate\Http\Request;

/**
 * Class GroupsServiceController
 * @package App\Http\Controllers
 */
class GroupsServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupsServices = GroupsService::paginate();

        return view('groups-service.index', compact('groupsServices'))
            ->with('i', (request()->input('page', 1) - 1) * $groupsServices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupsService = new GroupsService();
        return view('groups-service.create', compact('groupsService'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(GroupsService::$rules);

        $groupsService = GroupsService::create($request->all());

        return redirect()->route('groups-services.index')
            ->with('success', 'GroupsService created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groupsService = GroupsService::find($id);

        return view('groups-service.show', compact('groupsService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groupsService = GroupsService::find($id);

        return view('groups-service.edit', compact('groupsService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  GroupsService $groupsService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupsService $groupsService)
    {
        request()->validate(GroupsService::$rules);

        $groupsService->update($request->all());

        return redirect()->route('groups-services.index')
            ->with('success', 'GroupsService updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $groupsService = GroupsService::find($id)->delete();

        return redirect()->route('groups-services.index')
            ->with('success', 'GroupsService deleted successfully');
    }
}
