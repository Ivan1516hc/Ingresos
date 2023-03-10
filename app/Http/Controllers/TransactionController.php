<?php

namespace App\Http\Controllers;

use App\Mail\cancelTransaction;
use App\Models\CancellationHistory;
use App\Models\PartialPayment;
use App\Models\PartialPaymentsTransaction;
use App\Models\PromotersTransaction;
use App\Models\ServicesTransaction;
use App\Models\TherapistsTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    public function ticket($invoice)
    {
        $user = Auth::user();
        $model = Transaction::query();
        ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
        ($user->profile_id == 2 ? $model->where('location_id', $user->location_id) : null);
        $transaction = $model->where('invoice', $invoice)->first();
        if ($transaction == null) {
            return;
        }
        $service_transaction = ServicesTransaction::where('transaction_id', $invoice)->get();
        $therapist = TherapistsTransaction::where('transaction_id', $invoice)->first();
        $promoter = PromotersTransaction::where('transaction_id', $invoice)->first();
        $partial = PartialPaymentsTransaction::where('transaction_id', $invoice)->first();
        $transaction['numberToWord'] = $this->convertNumberToWords($transaction->total);
        return view('transaction.ticket', compact('transaction', 'service_transaction', 'therapist', 'promoter', 'partial'));
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
        request()->validate(Transaction::$rules);
        $user = Auth::user();
        $total = 0;
        $serviciosAgregados = json_decode($request->serviciosAgregados);
        $year = Carbon::now()->format('Y');

        $number = Transaction::select('invoice')->where('location_id', $user->location_id)->whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $folio = $number->invoice ?? null;
        if ($folio == null) {
            if ($user->location_id < 10) {
                $folio = intval($year . '0' . $user->location_id . '00001');
            } else {
                $folio = intval($year . $user->location_id . '00001');
            }
        } else {
            $folio = $folio + 1;
        }

        foreach ($serviciosAgregados as $service) {
            $total += $service->total;
        }

        DB::beginTransaction();

        try {
            if (isset($request->cuota)) {
                $transaction = Transaction::create([
                    'invoice' => $folio,
                    'total' => $request->cuota,
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
                        'cost'  => $request->cuota
                    ]);
                }
            } else {
                $transaction = Transaction::create([
                    'invoice' => $folio,
                    'total' => $total,
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
            }
            if (isset($request->payment_partial)) {
                if ($request->beneficiary_id != 'DIFZAP2019026294') {
                    $query = PartialPayment::where('beneficiary_id', $request->beneficiary_id)->where('status', 1)->get();
                    if ($query->count() > 0) {
                        return back()->with('message', 'Beneficiario con deuda.');
                    }
                }
                $data = PartialPayment::create([
                    'beneficiary_id' => $request->beneficiary_id,
                    'beneficiary_name' => $request->beneficiary_name,
                    'service_id' => $serviciosAgregados[0]->id,
                    'user_id' => $user->id,
                    'payment' => $serviciosAgregados[0]->cost,
                    'partiality' => 5,
                    'status' => 1
                ]);
            }
            if (isset($request->therapists)) {
                $data = TherapistsTransaction::create([
                    'therapist_id' => $request->therapists,
                    'transaction_id' => $folio
                ]);
            }
            if (isset($request->promoters)) {
                $data = PromotersTransaction::create([
                    'promoter_id' => $request->promoters,
                    'transaction_id' => $folio
                ]);
            }

            DB::commit();
            return redirect('/ticket/' . $folio);

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

    public function requestCancel(Request $request)
    {
        $user = Auth::user();
        try {
            $transaction = Transaction::find($request->id);
            if ($transaction->status == 1) {
                CancellationHistory::create([
                    'transaction_id' => $transaction->invoice,
                    'user_id' => $transaction->user_id,
                    'reason' => $request->reason,
                    'status' => 2
                ]);
                Transaction::find($request->id)->update(['status' => 2]);
                //The email sending is done using the to method on the Mail facade
                Mail::to('bihernandez@difzapopan.gob.mx')->send(new cancelTransaction($transaction,$request->reason));
                DB::commit();
                return back()->with('success', 'Petición de Cancelado Mandada.');
            }
            if ($transaction->status == 2) {
                Transaction::find($request->id)->update(['status' => 1]);
                CancellationHistory::where('transaction_id', $transaction->invoice)->update(['status' => 3]);
                DB::commit();
                return back()->with('success', 'Petición de Cancelado Cancelada.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('success', 'Movimiento Cancelado.');
        }
    }

    function convertNumberToWords(float $number)
    {
        $number = number_format($number, 2, '.', '');
        $decimalPart = intval(substr($number, -2));
        $integerPart = intval(substr($number, 0, -3));

        $units = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve', 'veinte', 'veintiuno', 'veintidos', 'veintitres', 'veinticuatro', 'veinticinco', 'veintiseis', 'veintisiete', 'veintiocho', 'veintinueve'];
        $tens = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
        $hundreds = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

        if ($integerPart == 0) {
            $result = 'cero';
        } else {
            $thousands = ['', 'mil', 'millones', 'mil millones', 'billones', 'mil billones'];
            $groupCount = 0;
            $result = '';

            do {
                $group = $integerPart % 1000;
                $integerPart = intdiv($integerPart, 1000);

                if ($group != 0) {
                    $groupString = '';

                    if ($group >= 100) {
                        $groupString .= $hundreds[intdiv($group, 100)] . ' ';
                        $group %= 100;
                    }

                    if ($group >= 30) {
                        $groupString .= $tens[intdiv($group, 10)];
                        if (($group % 10) != 0) {
                            $groupString .= ' Y ';
                        }
                        $group %= 10;
                    }

                    if ($group > 0) {
                        if ($group == 1 && $groupCount == 1) {
                            $groupString .= '';
                        } else {
                            $groupString .= $units[$group] . ' ';
                        }
                    }

                    $groupString .= $thousands[$groupCount] . ' ';
                    $result = $groupString . $result;
                }

                $groupCount++;
            } while ($integerPart > 0);
        }
        $result .= ' PESOS ';
        if ($decimalPart > 0) {
            $result .= 'con ' . $decimalPart . '/100 CENTAVOS';
        }

        return ucfirst(trim($result));
    }
}
