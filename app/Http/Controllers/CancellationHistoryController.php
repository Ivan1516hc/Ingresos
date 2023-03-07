<?php

namespace App\Http\Controllers;

use App\Models\CancellationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CancellationHistoryController
 * @package App\Http\Controllers
 */
class CancellationHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $model = CancelTransactions::query();
        $cancellationHistories = CancellationHistory::orderBy('id','desc')->paginate();

        return view('cancellation-history.index', compact('cancellationHistories'))
            ->with('i', (request()->input('page', 1) - 1) * $cancellationHistories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cancellationHistory = new CancellationHistory();
        return view('cancellation-history.create', compact('cancellationHistory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CancellationHistory::$rules);

        $cancellationHistory = CancellationHistory::create($request->all());

        return redirect()->route('cancellation-histories.index')
            ->with('success', 'CancellationHistory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cancellationHistory = CancellationHistory::find($id);

        return view('cancellation-history.show', compact('cancellationHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cancellationHistory = CancellationHistory::find($id);

        return view('cancellation-history.edit', compact('cancellationHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CancellationHistory $cancellationHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CancellationHistory $cancellationHistory)
    {
        request()->validate(CancellationHistory::$rules);

        $cancellationHistory->update($request->all());

        return redirect()->route('cancellation-histories.index')
            ->with('success', 'CancellationHistory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cancellationHistory = CancellationHistory::find($id)->delete();

        return redirect()->route('cancellation-histories.index')
            ->with('success', 'CancellationHistory deleted successfully');
    }
}
