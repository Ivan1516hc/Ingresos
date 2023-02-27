<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use Illuminate\Http\Request;

/**
 * Class TherapistController
 * @package App\Http\Controllers
 */
class TherapistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $therapists = Therapist::paginate();

        return view('therapist.index', compact('therapists'))
            ->with('i', (request()->input('page', 1) - 1) * $therapists->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $therapist = new Therapist();
        return view('therapist.create', compact('therapist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Therapist::$rules);

        $therapist = Therapist::create($request->all());

        return redirect()->route('therapists.index')
            ->with('success', 'Therapist created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $therapist = Therapist::find($id);

        return view('therapist.show', compact('therapist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $therapist = Therapist::find($id);

        return view('therapist.edit', compact('therapist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Therapist $therapist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Therapist $therapist)
    {
        request()->validate(Therapist::$rules);

        $therapist->update($request->all());

        return redirect()->route('therapists.index')
            ->with('success', 'Therapist updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $therapist = Therapist::find($id)->delete();

        return redirect()->route('therapists.index')
            ->with('success', 'Therapist deleted successfully');
    }

    public function getTherapists(){
        $therapists = Therapist::all();

        return response()->json($therapists);
    }
}
