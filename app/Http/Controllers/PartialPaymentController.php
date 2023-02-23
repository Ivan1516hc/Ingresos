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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partialPayment = new PartialPayment();
        return view('partial-payment.create', compact('partialPayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PartialPayment::$rules);

        $partialPayment = PartialPayment::create($request->all());

        return redirect()->route('partial-payments.index')
            ->with('success', 'PartialPayment created successfully.');
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

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $partialPayment = PartialPayment::find($id)->delete();

        return redirect()->route('partial-payments.index')
            ->with('success', 'PartialPayment deleted successfully');
    }
}
