<?php

namespace App\Http\Controllers;

use App\Models\LocationsTransaction;
use Illuminate\Http\Request;

/**
 * Class LocationsTransactionController
 * @package App\Http\Controllers
 */
class LocationsTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locationsTransactions = LocationsTransaction::paginate();

        return view('locations-transaction.index', compact('locationsTransactions'))
            ->with('i', (request()->input('page', 1) - 1) * $locationsTransactions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locationsTransaction = new LocationsTransaction();
        return view('locations-transaction.create', compact('locationsTransaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(LocationsTransaction::$rules);

        $locationsTransaction = LocationsTransaction::create($request->all());

        return redirect()->route('locations-transactions.index')
            ->with('success', 'LocationsTransaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locationsTransaction = LocationsTransaction::find($id);

        return view('locations-transaction.show', compact('locationsTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locationsTransaction = LocationsTransaction::find($id);

        return view('locations-transaction.edit', compact('locationsTransaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  LocationsTransaction $locationsTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationsTransaction $locationsTransaction)
    {
        request()->validate(LocationsTransaction::$rules);

        $locationsTransaction->update($request->all());

        return redirect()->route('locations-transactions.index')
            ->with('success', 'LocationsTransaction updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $locationsTransaction = LocationsTransaction::find($id)->delete();

        return redirect()->route('locations-transactions.index')
            ->with('success', 'LocationsTransaction deleted successfully');
    }
}
