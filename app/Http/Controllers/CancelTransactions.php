<?php

namespace App\Http\Controllers;

use App\Models\CancellationHistory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CancelTransactions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $model = CancellationHistory::query();
        ($user->profile_id == 1 ? $model->where('created_at', '>=', now()->subMonth(1)) 
        : ($user->profile_id == 2 ? $model->whereHas('user.location', function ($query) use ($user) {
                return $query->where('manager_id', $user->id);
            }) : null));

        $transactions = $model->orderBy('id', 'desc')->paginate();

        return view('cancel-transactions.index', compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * $transactions->perPage());
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

        return view('cancel-transactions.show', compact('transaction'));
    }

    public function cancelJD(Request $request)
    {
        $user = Auth::user();
        try {
            CancellationHistory::find($request->id)->update(['status'=>1,'authorized_user_id'=>$user->id]);
            Transaction::where('invoice',$request->transaction_id)->update(['status' => 3]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('success', $th->getMessage());
        }
        return back()->with('success', 'Movimiento Cancelado.');
    }
}
