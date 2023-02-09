<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

/**
 * Class CommunityController
 * @package App\Http\Controllers
 */
class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::paginate();

        return view('community.index', compact('communities'))
            ->with('i', (request()->input('page', 1) - 1) * $communities->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $community = new Community();
        return view('community.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Community::$rules);

        $community = Community::create($request->all());

        return redirect()->route('communities.index')
            ->with('success', 'Community created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $community = Community::find($id);

        return view('community.show', compact('community'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $community = Community::find($id);

        return view('community.edit', compact('community'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Community $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        request()->validate(Community::$rules);

        $community->update($request->all());

        return redirect()->route('communities.index')
            ->with('success', 'Community updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $community = Community::find($id)->delete();

        return redirect()->route('communities.index')
            ->with('success', 'Community deleted successfully');
    }
}
