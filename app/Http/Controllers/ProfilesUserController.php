<?php

namespace App\Http\Controllers;

use App\Models\ProfilesUser;
use Illuminate\Http\Request;

/**
 * Class ProfilesUserController
 * @package App\Http\Controllers
 */
class ProfilesUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profilesUsers = ProfilesUser::paginate();

        return view('profiles-user.index', compact('profilesUsers'))
            ->with('i', (request()->input('page', 1) - 1) * $profilesUsers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profilesUser = new ProfilesUser();
        return view('profiles-user.create', compact('profilesUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProfilesUser::$rules);

        $profilesUser = ProfilesUser::create($request->all());

        return redirect()->route('profiles-users.index')
            ->with('success', 'ProfilesUser created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profilesUser = ProfilesUser::find($id);

        return view('profiles-user.show', compact('profilesUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profilesUser = ProfilesUser::find($id);

        return view('profiles-user.edit', compact('profilesUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProfilesUser $profilesUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilesUser $profilesUser)
    {
        request()->validate(ProfilesUser::$rules);

        $profilesUser->update($request->all());

        return redirect()->route('profiles-users.index')
            ->with('success', 'ProfilesUser updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $profilesUser = ProfilesUser::find($id)->delete();

        return redirect()->route('profiles-users.index')
            ->with('success', 'ProfilesUser deleted successfully');
    }
}
