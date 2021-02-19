<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
            'due_date'  => ['required'],
            'source'    => ['required', 'max:50'],
            'amount'    => ['required', 'numeric'],
            'budget_id' => ['required'],
        ]);

        $expense = new Expense();
        $expense->budget_id = $request->budget_id;
        $expense->due_date = Carbon::parse($request->due_date);
        $expense->source = $request->source;
        $expense->amount = $request->amount;
        $expense->notes = $request->notes;
        $expense->created_at = Carbon::now();
        $expense->updated_at = Carbon::now();
        $expense->save();

        return Redirect::route('budgets.show', $request->budget_id);
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
        $edit = Expense::findOrFail($expense->id);
        return Inertia::render('Expenses/Edit', [
            'budget'   => $expense->budget_id,
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
            'due_date'  => ['required'],
            'source'    => ['required', 'max:50'],
            'amount'    => ['required', 'numeric']
        ]);

        $new = Expense::findOrFail($expense->id);
        $new->due_date = Carbon::parse($request->due_date);
        $new->source = $request->source;
        $new->amount = $request->amount;
        $new->notes = $request->notes;
        $new->updated_at = Carbon::now();
        $new->save();

        return Redirect::route('budgets.show', $request->budget_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Expense $expense)
    {
        $budget = $expense->budget_id;
        $expense->delete();
        return Redirect::to('/budgets/' . $budget . '#expense');
    }
}
