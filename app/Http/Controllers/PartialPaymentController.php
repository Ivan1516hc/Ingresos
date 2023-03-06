<?php

namespace App\Http\Controllers;

use App\Models\PartialPayment;
use App\Models\PartialPaymentsTransaction;
use App\Models\Service;
use App\Models\ServicesTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PartialPaymentController
 * @package App\Http\Controllers
 */
class PartialPaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();

            if ($user->profile_id === 3) {
                if (in_array($request->route()->getName(), ['services.edit', 'services.update'])) {
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
        $model = PartialPayment::query();
        ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
        ($user->profile_id == 2 ? $model->whereHas('user', function ($query) use ($user) {
            return $query->where('location_id', $user->location_id);
        }) : null);
        $partialPayments = $model->orderBy('id', 'desc')->paginate();

        return view('partial-payment.index', compact('partialPayments'))
            ->with('i', (request()->input('page', 1) - 1) * $partialPayments->perPage());
    }


    public function edit($id)
    {
        $partialPayment = PartialPayment::find($id);

        return view('partial-payment.edit', compact('partialPayment'));
    }

    public function update(Request $request, PartialPayment $partialPayment)
    {
        request()->validate(PartialPayment::$rules);

        $partialPayment->update($request->all());

        return redirect()->route('partial-payments.index')
            ->with('success', 'PartialPayment updated successfully');
    }

    public function abono($id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $model = PartialPayment::query();
            ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
            ($user->profile_id == 2 ? $model->whereHas('user', function ($query) use ($user) {
                return $query->where('location_id', $user->location_id);
            }) : null);
            $transaction = $model->where('id', $id)->first();
            $service = Service::where('id', $transaction->service_id)->first();
            $transaction->update([
                'payment' =>  $transaction->payment + ($service->cost / 5)
            ]);

            $new = PartialPayment::find($id);

            if ($new->payment == $service->cost) {
                $transaction->update(['status' =>  2]);
            }

            $year = Carbon::now()->format('Y');

            $number = Transaction::select('invoice')->where('location_id', $user->location_id)->whereYear('created_at', $year)->orderBy('id', 'desc')->first();
            $folio = $number->invoice ?? null;
            if ($folio == null) {
                if ($user->location < 10) {
                    $folio = intval($year . '0' . $user->location_id . '00001');
                } else {
                    $folio = intval($year . $user->location_id . '00001');
                }
            } else {
                $folio = $folio + 1;
            }

            Transaction::create([
                'invoice' => $folio,
                'total' => ($service->cost / 5),
                'beneficiary_id' => $transaction->beneficiary_id,
                'beneficiary_name' => $transaction->beneficiary_name,
                'location_id' => $user->location_id,
                'user_id' => $user->id,
            ]);

            PartialPaymentsTransaction::create([
                'transaction_id' => $folio,
                'partial_payment_id' => $id
            ]);

            ServicesTransaction::create([
                'transaction_id' => $folio,
                'service_id' => $service->id,
                'amount'  => 1,
                'cost'  => ($service->cost / 5)
            ]);

            DB::commit();
            return response()->json(
                '/ticket/' . $folio
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('message', $th->getMessage());
        }
    }

    public function requestCancel($id)
    {
        $user = Auth::user();
        $model = PartialPayment::query();
        ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
        ($user->profile_id == 2 ? $model->whereHas('user', function ($query) use ($user) {
            return $query->where('location_id', $user->location_id);
        }) : null);
        try {
            $transaction = $model->where('id', $id)->first();
            if ($transaction->status == 1) {
                $transaction->update(['status' => 2]);
                DB::commit();
                return back()->with('success', 'Pago parcial Terminado.');
            }
            if ($transaction->status == 2) {
                $transaction->update(['status' => 1]);
                DB::commit();
                return back()->with('success', 'Pago parcial activado.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('success', 'Movimiento Cancelado.');
        }
    }
}
