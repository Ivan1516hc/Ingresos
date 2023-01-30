<?php

namespace App\Http\Controllers;

use App\Models\ReprintHistory;
use Illuminate\Http\Request;

/**
 * Class ReprintHistoryController
 * @package App\Http\Controllers
 */
class ReprintHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reprintHistories = ReprintHistory::paginate();

        return view('reprint-history.index', compact('reprintHistories'))
            ->with('i', (request()->input('page', 1) - 1) * $reprintHistories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reprintHistory = new ReprintHistory();
        return view('reprint-history.create', compact('reprintHistory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ReprintHistory::$rules);

        $reprintHistory = ReprintHistory::create($request->all());

        return redirect()->route('reprint-histories.index')
            ->with('success', 'ReprintHistory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reprintHistory = ReprintHistory::find($id);

        return view('reprint-history.show', compact('reprintHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reprintHistory = ReprintHistory::find($id);

        return view('reprint-history.edit', compact('reprintHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ReprintHistory $reprintHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReprintHistory $reprintHistory)
    {
        request()->validate(ReprintHistory::$rules);

        $reprintHistory->update($request->all());

        return redirect()->route('reprint-histories.index')
            ->with('success', 'ReprintHistory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reprintHistory = ReprintHistory::find($id)->delete();

        return redirect()->route('reprint-histories.index')
            ->with('success', 'ReprintHistory deleted successfully');
    }
}
