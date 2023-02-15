<?php

namespace App\Http\Controllers;

use App\Models\ServicesTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('invoice', 'desc')->where('status', '<>', 3)->paginate();

        return view('transaction.index', compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * $transactions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction = new Transaction();
        return view('transaction.create', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $serviciosAgregados = json_decode($request->serviciosAgregados);
        

        $transaction = Transaction::created([
            'invoice' => 'PENDIENTE',
            'bill' => $request->bill,
            'total' => $request->total,
            'beneficiary_id' => $request->beneficiary_id,
            'beneficiary_name' => $request->beneficiary_name,
            'location_id' => 'PENDIENTE',
            'user_id' => 'pendiente',
        ]);

        foreach ($serviciosAgregados as $service) {
            $service_transaction = ServicesTransaction::created([
                'transaction_id' => 'PENDIENTE',
                dd($request->all()),
                'service_id' => $service->id,
            ]);
        }

        return response()->json($serviciosAgregados);
        // request()->validate(Transaction::$rules);

        // $transaction = Transaction::create($request->all());

        // return redirect()->route('transactions.index')
        //     ->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);

        return view('transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        request()->validate(Transaction::$rules);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id)->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully');
    }
}
