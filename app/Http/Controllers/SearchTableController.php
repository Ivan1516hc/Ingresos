<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchTableController extends Controller
{
    public function searchTransaction(Request $request)
    {
        $search = $request->search;
        $param = explode(":", $request->opcion);

        $user = Auth::user();
        $model = Transaction::query();
        ($user->profile_id == 3 ? $model->where('user_id', $user->id) : null);
        ($user->profile_id == 2 ? $model->where('location_id', $user->location_id) : null);
        $transactions = $model->where('status', '<>', 3)->where($param[1], 'like', '%' . $search . '%')->paginate();

        return view('transaction.index', compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * $transactions->perPage());
    }
}
