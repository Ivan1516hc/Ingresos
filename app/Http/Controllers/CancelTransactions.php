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
        $model = Transaction::query();
        ($user->profile_id == 1 ? $model->where('created_at', '>=', now()->subMonth(1)) : ($user->profile_id == 2 ? $model->where('location_id', $user->location_id)->where('created_at', '>=', now()->subDays(3)) : null));

        $transactions = $model->orderBy('id', 'desc')->where('status', 2)->paginate();

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

    public function cancelJD($id)
    {
        $user = Auth::user();
        // if($user->profile_id !== 2){
        //     return;
        // }
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
}
