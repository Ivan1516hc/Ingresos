<?php

namespace App\Http\Controllers;

use App\Models\PartialPayment;
use Illuminate\Http\Request;

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
        $partialPayments = PartialPayment::orderBy('id','desc')->paginate();

        return view('partial-payment.index', compact('partialPayments'))
            ->with('i', (request()->input('page', 1) - 1) * $partialPayments->perPage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partialPayment = PartialPayment::find($id);

        return view('partial-payment.show', compact('partialPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partialPayment = PartialPayment::find($id);

        return view('partial-payment.edit', compact('partialPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PartialPayment $partialPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartialPayment $partialPayment)
    {
        request()->validate(PartialPayment::$rules);

        $partialPayment->update($request->all());

        return redirect()->route('partial-payments.index')
            ->with('success', 'PartialPayment updated successfully');
    }

}
