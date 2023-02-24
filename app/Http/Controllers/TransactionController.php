<?php

namespace App\Http\Controllers;

use App\Models\CancellationHistory;
use App\Models\PartialPayment;
use App\Models\ServicesTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();

            if ($user->profile_id === 1) {
                if (in_array($request->route()->getName(), ['transactions.create', 'transactions.store'])) {
                    abort(403, 'Unauthorized action.');
                }
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $model = Transaction::query();
        ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
        ($user->profile_id == 2 ? $model->where('location_id', $user->location_id) : null);
        $transactions = $model->orderBy('id', 'desc')->where('status', '<>', 3)->paginate();

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
        dd($request->all());
        request()->validate(Transaction::$rules);
        $user = Auth::user();
        $total = 0;
        $serviciosAgregados = json_decode($request->serviciosAgregados);

        $year = Carbon::now()->format('Y');

        $number = Transaction::select('invoice')->where('location_id', $user->location_id)->whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $folio = $number->invoice ?? null;
        if ($folio == null) {
            $folio = intval($year . $user->location_id . '00001');
        } else {
            $folio = $folio + 1;
        }

        foreach ($serviciosAgregados as $service) {
            $total += $service->total;
        }

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'invoice' => $folio,
                'bill' => $request->bill,
                'total' => $total,
                'beneficiary_id' => $request->beneficiary_id,
                'beneficiary_name' => $request->beneficiary_name,
                'location_id' => $user->location_id,
                'user_id' => $user->id,
            ]);

            if (isset($request->payment_partial)) {
                if ($request->beneficiary_id != 'DIFZAP2019026294') {
                    $query = PartialPayment::where('beneficiary_id', $request->beneficiary_id)->where('status', 1)->get();
                    if ($query->count() > 0) {
                        return back()->with('message', 'Beneficiario con deuda.');
                    }
                }
                $partialPayment = PartialPayment::create([
                    'beneficiary_id' => $request->beneficiary_id,
                    'beneficiary_name' => $request->beneficiary_name,
                    'service_id' => $serviciosAgregados[0]->id,
                    'user_id' => $user->id,
                    'payment' => $serviciosAgregados[0]->cost,
                    'partiality' => 1,
                    'status' => 1
                ]);
            }

            foreach ($serviciosAgregados as $service) {
                $service_transaction = ServicesTransaction::create([
                    'transaction_id' => $folio,
                    'service_id' => $service->id,
                    'amount'  => $service->cant,
                    'cost'  => $service->total
                ]);
            }

            DB::commit();
            return back()
                ->with('success', 'Movimiento registrado');
            // return redirect()->route('transactions.index')
            //     ->with('success', 'Movimiento registrado');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('message', $th->getMessage());
        }
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

    public function cancel($id)
    {
        $user = Auth::user();
        try {
            $transaction = Transaction::find($id);
            CancellationHistory::create([
                'transaction_id' => $transaction->invoice,
                'user_id' => $transaction->user_id,
                'authorized_user_id'  => $user->id,
            ]);
            Transaction::find($id)->update(['status' => 3]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('success', $th->getMessage());
        }
        return back()->with('success', 'Movimiento Cancelado.');
    }

    public function requestCancel($id)
    {
        $user = Auth::user();
        try {
            $transaction = Transaction::find($id);
            if ($transaction->status == 1) {
                Transaction::find($id)->update(['status' => 2]);
            }
            if ($transaction->status == 2) {
                Transaction::find($id)->update(['status' => 1]);
            }
            DB::commit();
            return back()->with('success', 'Petición de Cancelado Mandada.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('success', 'Movimiento Cancelado.');
        }
    }
}
