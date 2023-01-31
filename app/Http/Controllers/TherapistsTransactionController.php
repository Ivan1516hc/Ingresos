<?php

namespace App\Http\Controllers;

use App\Models\TherapistsTransaction;
use Illuminate\Http\Request;

/**
 * Class TherapistsTransactionController
 * @package App\Http\Controllers
 */
class TherapistsTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $therapistsTransactions = TherapistsTransaction::paginate();

        return view('therapists-transaction.index', compact('therapistsTransactions'))
            ->with('i', (request()->input('page', 1) - 1) * $therapistsTransactions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $therapistsTransaction = new TherapistsTransaction();
        return view('therapists-transaction.create', compact('therapistsTransaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TherapistsTransaction::$rules);

        $therapistsTransaction = TherapistsTransaction::create($request->all());

        return redirect()->route('therapists-transactions.index')
            ->with('success', 'TherapistsTransaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $therapistsTransaction = TherapistsTransaction::find($id);

        return view('therapists-transaction.show', compact('therapistsTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $therapistsTransaction = TherapistsTransaction::find($id);

        return view('therapists-transaction.edit', compact('therapistsTransaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TherapistsTransaction $therapistsTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TherapistsTransaction $therapistsTransaction)
    {
        request()->validate(TherapistsTransaction::$rules);

        $therapistsTransaction->update($request->all());

        return redirect()->route('therapists-transactions.index')
            ->with('success', 'TherapistsTransaction updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $therapistsTransaction = TherapistsTransaction::find($id)->delete();

        return redirect()->route('therapists-transactions.index')
            ->with('success', 'TherapistsTransaction deleted successfully');
    }
}
