<?php

namespace App\Http\Controllers;

use App\Models\PromotersTransaction;
use Illuminate\Http\Request;

/**
 * Class PromotersTransactionController
 * @package App\Http\Controllers
 */
class PromotersTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotersTransactions = PromotersTransaction::paginate();

        return view('promoters-transaction.index', compact('promotersTransactions'))
            ->with('i', (request()->input('page', 1) - 1) * $promotersTransactions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotersTransaction = new PromotersTransaction();
        return view('promoters-transaction.create', compact('promotersTransaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PromotersTransaction::$rules);

        $promotersTransaction = PromotersTransaction::create($request->all());

        return redirect()->route('promoters-transactions.index')
            ->with('success', 'PromotersTransaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotersTransaction = PromotersTransaction::find($id);

        return view('promoters-transaction.show', compact('promotersTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotersTransaction = PromotersTransaction::find($id);

        return view('promoters-transaction.edit', compact('promotersTransaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PromotersTransaction $promotersTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromotersTransaction $promotersTransaction)
    {
        request()->validate(PromotersTransaction::$rules);

        $promotersTransaction->update($request->all());

        return redirect()->route('promoters-transactions.index')
            ->with('success', 'PromotersTransaction updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $promotersTransaction = PromotersTransaction::find($id)->delete();

        return redirect()->route('promoters-transactions.index')
            ->with('success', 'PromotersTransaction deleted successfully');
    }
}
