<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ExpenseController extends Controller
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
        return Inertia::render('Expenses/Create', [
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

        $expense = new Expense();
        $expense->budget_id = $budget->id;
        $expense->uid = Str::uuid();
        $expense->source = $request->source;
        $expense->amount = $request->amount;
        $expense->notes = $request->notes;
        $expense->created_at = Carbon::now();
        $expense->updated_at = Carbon::now();
        $expense->save();

        return Redirect::route('budgets.show', $request->budget);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Inertia\Response
     */
    public function edit(Expense $expense)
    {
        $edit = Expense::where('uid', $expense->uid)->first();
        return Inertia::render('Expenses/Edit', [
            'budget'   => $expense->budget->uid,
            'expense'   => $edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'source'    => ['required', 'max:50'],
            'amount'    => ['required', 'numeric']
        ]);

        $new = Expense::findOrFail($expense->id);
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
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Expense $expense)
    {
        $budget = $expense->budget->uid;
        $expense->delete();
        return Redirect::to('/budgets/' . $budget . '#expense');
    }
}
