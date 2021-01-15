<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StatController extends Controller
{
    /**
     * Display Stats
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->get();

        //We need to get the incomes/expenses attached to each budget
        $ids = $budgets->pluck('id')->toArray();
        $incomes = Income::whereIn('budget_id', $ids)->get();
        $expenses = Expense::whereIn('budget_id', $ids)->get();
        return Inertia::render('Stats/Index', [
            'budgets' => $budgets,
            'incomes' => $incomes,
            'expenses' => $expenses
        ]);
    }
}
