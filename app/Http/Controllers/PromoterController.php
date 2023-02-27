<?php

namespace App\Http\Controllers;

use App\Models\Promoter;
use Illuminate\Http\Request;

/**
 * Class PromoterController
 * @package App\Http\Controllers
 */
class PromoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promoters = Promoter::paginate();

        return view('promoter.index', compact('promoters'))
            ->with('i', (request()->input('page', 1) - 1) * $promoters->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promoter = new Promoter();
        return view('promoter.create', compact('promoter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Promoter::$rules);

        $promoter = Promoter::create($request->all());

        return redirect()->route('promoters.index')
            ->with('success', 'Promoter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promoter = Promoter::find($id);

        return view('promoter.show', compact('promoter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promoter = Promoter::find($id);

        return view('promoter.edit', compact('promoter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Promoter $promoter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promoter $promoter)
    {
        request()->validate(Promoter::$rules);

        $promoter->update($request->all());

        return redirect()->route('promoters.index')
            ->with('success', 'Promoter updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $promoter = Promoter::find($id)->delete();

        return redirect()->route('promoters.index')
            ->with('success', 'Promoter deleted successfully');
    }

    public function getPromoters(){
        $promoters = Promoter::all();
        return response()->json($promoters);
    }
}
