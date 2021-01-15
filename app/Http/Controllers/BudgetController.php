<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->get();
        return Inertia::render('Budgets/Index', [
            'budgets' => $budgets,
            'auth_url' => 'logout'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Budgets/Create');
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
            'name' => ['required', 'max:50'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        $budget = new Budget();
        $budget->name = $request->name;
        $budget->user_id = Auth::id();
        $budget->start_date = Carbon::parse($request->start_date);
        $budget->end_date = Carbon::parse($request->end_date);
        $budget->created_at = Carbon::now();
        $budget->updated_at = Carbon::now();
        $budget->save();

        return Redirect::route('budgets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Inertia\Response
     */
    public function show(Budget $budget)
    {
        $found = Budget::where('id', $budget->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $incomes = $budget->incomes()->get()->toArray();
        $expenses = $budget->expenses()->get()->toArray();

        return Inertia::render('Budgets/Show', [
            'budget'   => $found,
            'incomes'  => $incomes,
            'expenses' => $expenses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        return Redirect::route('budgets.index');
    }
}
