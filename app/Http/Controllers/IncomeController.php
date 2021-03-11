<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Incomes/Create', [
            'budget'   => $_GET['budget']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'source'    => ['required', 'max:50'],
            'amount'    => ['required', 'numeric'],
            'budget' => ['required'],
        ]);

        $budget = Budget::where('uid', $request->budget)->first();

        $income = new Income();
        $income->budget_id = $budget->id;
        $income->uid = Str::uuid();
        $income->source = $request->source;
        $income->amount = $request->amount;
        $income->notes = $request->notes;
        $income->created_at = Carbon::now();
        $income->updated_at = Carbon::now();
        $income->save();

        return Redirect::route('budgets.show', $request->budget);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Inertia\Response
     */
    public function edit(Income $income)
    {
        $edit = Income::where('uid', $income->uid)->first();
        return Inertia::render('Incomes/Edit', [
            'budget'   => $edit->budget->uid,
            'income'   => $edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'source'    => ['required', 'max:50'],
            'amount'    => ['required', 'numeric']
        ]);

        $new = Income::findOrFail($income->id);
        $new->uid = Str::uuid();
        $new->source = $request->source;
        $new->amount = $request->amount;
        $new->notes = $request->notes;
        $new->updated_at = Carbon::now();
        $new->save();

        return Redirect::route('budgets.show', $request->budget);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Income $income)
    {
        $budget = $income->budget->uid;
        $income->delete();
        return Redirect::route('budgets.show', $budget);
    }
}
