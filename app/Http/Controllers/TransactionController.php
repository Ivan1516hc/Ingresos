<?php

namespace App\Http\Controllers;

use App\Models\ServicesTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $serviciosAgregados = json_decode($request->serviciosAgregados);
        
        $year = Carbon::now()->format('Y');
        
        $number = Transaction::select('invoice')->where('location_id',28)->whereYear('created_at',2024)->orderBy('id','desc')->first();
        $folio= $number->invoice ?? null;
        if($folio == null){
            $folio=intval($year.$user->location_id.'00001');
        }else{
            $folio = $folio+1;
        }


        $transaction = Transaction::create([
            'invoice' => $folio,
            'bill' => $request->bill,
            'total' => $request->total,
            'beneficiary_id' => $request->beneficiary_id,
            'beneficiary_name' => $request->beneficiary_name,
            'location_id' => $user->location_id,
            'user_id' => $user->id,
        ]);

        foreach ($serviciosAgregados as $service) {
            $service_transaction = ServicesTransaction::create([
                'transaction_id' => $folio,
                'service_id' => $service->id,
                'amount'  => $service->cant,
                'cost'  => $service->total
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
