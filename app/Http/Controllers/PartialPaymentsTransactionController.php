<?php

namespace App\Http\Controllers;

use App\Models\PartialPaymentsTransaction;
use Illuminate\Http\Request;

/**
 * Class PartialPaymentsTransactionController
 * @package App\Http\Controllers
 */
class PartialPaymentsTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partialPaymentsTransactions = PartialPaymentsTransaction::paginate();

        return view('partial-payments-transaction.index', compact('partialPaymentsTransactions'))
            ->with('i', (request()->input('page', 1) - 1) * $partialPaymentsTransactions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partialPaymentsTransaction = new PartialPaymentsTransaction();
        return view('partial-payments-transaction.create', compact('partialPaymentsTransaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PartialPaymentsTransaction::$rules);

        $partialPaymentsTransaction = PartialPaymentsTransaction::create($request->all());

        return redirect()->route('partial-payments-transactions.index')
            ->with('success', 'PartialPaymentsTransaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partialPaymentsTransaction = PartialPaymentsTransaction::find($id);

        return view('partial-payments-transaction.show', compact('partialPaymentsTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partialPaymentsTransaction = PartialPaymentsTransaction::find($id);

        return view('partial-payments-transaction.edit', compact('partialPaymentsTransaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PartialPaymentsTransaction $partialPaymentsTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartialPaymentsTransaction $partialPaymentsTransaction)
    {
        request()->validate(PartialPaymentsTransaction::$rules);

        $partialPaymentsTransaction->update($request->all());

        return redirect()->route('partial-payments-transactions.index')
            ->with('success', 'PartialPaymentsTransaction updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $partialPaymentsTransaction = PartialPaymentsTransaction::find($id)->delete();

        return redirect()->route('partial-payments-transactions.index')
            ->with('success', 'PartialPaymentsTransaction deleted successfully');
    }
}
