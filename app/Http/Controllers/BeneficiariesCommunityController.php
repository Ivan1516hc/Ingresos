<?php

namespace App\Http\Controllers;

use App\Models\BeneficiariesCommunity;
use Illuminate\Http\Request;

/**
 * Class BeneficiariesCommunityController
 * @package App\Http\Controllers
 */
class BeneficiariesCommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiariesCommunities = BeneficiariesCommunity::paginate();

        return view('beneficiaries-community.index', compact('beneficiariesCommunities'))
            ->with('i', (request()->input('page', 1) - 1) * $beneficiariesCommunities->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beneficiariesCommunity = new BeneficiariesCommunity();
        return view('beneficiaries-community.create', compact('beneficiariesCommunity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BeneficiariesCommunity::$rules);

        $beneficiariesCommunity = BeneficiariesCommunity::create($request->all());

        return redirect()->route('beneficiaries-communities.index')
            ->with('success', 'BeneficiariesCommunity created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiariesCommunity = BeneficiariesCommunity::find($id);

        return view('beneficiaries-community.show', compact('beneficiariesCommunity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiariesCommunity = BeneficiariesCommunity::find($id);

        return view('beneficiaries-community.edit', compact('beneficiariesCommunity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BeneficiariesCommunity $beneficiariesCommunity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BeneficiariesCommunity $beneficiariesCommunity)
    {
        request()->validate(BeneficiariesCommunity::$rules);

        $beneficiariesCommunity->update($request->all());

        return redirect()->route('beneficiaries-communities.index')
            ->with('success', 'BeneficiariesCommunity updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $beneficiariesCommunity = BeneficiariesCommunity::find($id)->delete();

        return redirect()->route('beneficiaries-communities.index')
            ->with('success', 'BeneficiariesCommunity deleted successfully');
    }
}
