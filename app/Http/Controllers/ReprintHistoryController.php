<?php

namespace App\Http\Controllers;

use App\Models\ReprintHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $model = ReprintHistory::query();
        ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
        ($user->profile_id == 2 ? $model->whereHas('user', function ($query) use ($user) {
            return  $query->where('location_id', $user->location_id);
        }) : null);
        $reprintHistories = $model->orderBy('id', 'desc')->paginate();

        return view('reprint-history.index', compact('reprintHistories'))
            ->with('i', (request()->input('page', 1) - 1) * $reprintHistories->perPage());
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

    public function reprint(Request $request)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $data['transaction_id'] = $request->invoice;
        ReprintHistory::create($data);
        return response()->json($data);
    }
}
