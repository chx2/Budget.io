<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $budgets = Budget::where('user_id', Auth::id())->get();
        return Inertia::render('Reports/Index', [
            'budgets'  => $budgets
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function show(Request $request)
    {
        $request->validate([
            'budget' => ['required'],
            'type' => ['required'],
        ]);

        $budget = Budget::where('uid', $request->budget)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $incomes = $budget->incomes()->get();
        $expenses = $budget->expenses()->get();

        //Calculate Totals
        $gain = 0.00;
        $loss = 0.00;
        foreach($incomes as $income) {
            $gain += $income->amount;
        }
        foreach($expenses as $expense) {
            $loss += $expense->amount;
        }

        //Total Report
        if ($request->type === 'total') {
            $pdf = PDF::loadView('total', [
                'budget'    => $budget,
                'incomes'   => $incomes,
                'expenses'  => $expenses,
                'start'     => Carbon::parse($budget->start_date)->toFormattedDateString(),
                'end'       => Carbon::parse($budget->end_date)->toFormattedDateString(),
                'gain'      => $gain,
                'loss'      => $loss
            ]);
            return $pdf->stream('total.pdf');
        }
        //Income
        else if($request->type === 'income') {
            $pdf = PDF::loadView('income', [
                'budget'    => $budget,
                'incomes'   => $incomes,
                'start'     => Carbon::parse($budget->start_date)->toFormattedDateString(),
                'end'       => Carbon::parse($budget->end_date)->toFormattedDateString(),
                'gain'      => $gain,
            ]);
            return $pdf->stream('income.pdf');
        }
        //Expenses, possibly more future ones
        else {
            $pdf = PDF::loadView('expense', [
                'budget'    => $budget,
                'expenses'  => $expenses,
                'start'     => Carbon::parse($budget->start_date)->toFormattedDateString(),
                'end'       => Carbon::parse($budget->end_date)->toFormattedDateString(),
                'loss'      => $loss
            ]);
            return $pdf->stream('income.pdf');
        }
    }
}
