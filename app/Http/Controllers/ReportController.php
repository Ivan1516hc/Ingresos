<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function dayReports(Request $request)
    {
        $user = Auth::user();
        $model = Transaction::query();
        // ($user->id == 2 ? $model->where('location_id',$user->location_id) : null);
        ($user->id == 3 ? $model->where('user_id', $user->id) : null);
        if ($request->begin && $request->finish) {
            $transaction = $model->whereBetween('created_at', [$request->begin, $request->finish]);
        } else {
            $transaction = $model->where('created_at', Carbon::today());
        }

        return response()->json($transaction);
    }

    public function locationReports(Request $request)
    {
        $user = Auth::user();
        $model = Transaction::query();
        ($user->id == 3 ? $model->where('location_id', $user->location_id) : $model->where('location_id', $request->location_id));
        $transaction = $model->whereBetween('created_at', [$request->begin, $request->finish]);

        return response()->json($transaction);
    }
}
