<?php

namespace App\Http\Controllers;

use App\Models\ServicesTransaction;
use Illuminate\Http\Request;

/**
 * Class ServicesTransactionController
 * @package App\Http\Controllers
 */
class ServicesTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicesTransactions = ServicesTransaction::paginate();

        return view('services-transaction.index', compact('servicesTransactions'))
            ->with('i', (request()->input('page', 1) - 1) * $servicesTransactions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicesTransaction = new ServicesTransaction();
        return view('services-transaction.create', compact('servicesTransaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ServicesTransaction::$rules);

        $servicesTransaction = ServicesTransaction::create($request->all());

        return redirect()->route('services-transactions.index')
            ->with('success', 'ServicesTransaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicesTransaction = ServicesTransaction::find($id);

        return view('services-transaction.show', compact('servicesTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicesTransaction = ServicesTransaction::find($id);

        return view('services-transaction.edit', compact('servicesTransaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ServicesTransaction $servicesTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicesTransaction $servicesTransaction)
    {
        request()->validate(ServicesTransaction::$rules);

        $servicesTransaction->update($request->all());

        return redirect()->route('services-transactions.index')
            ->with('success', 'ServicesTransaction updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $servicesTransaction = ServicesTransaction::find($id)->delete();

        return redirect()->route('services-transactions.index')
            ->with('success', 'ServicesTransaction deleted successfully');
    }
}
