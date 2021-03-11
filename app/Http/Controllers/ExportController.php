<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Pdf as PDF;
use App\Models\Budget;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Send a PDF copy of the budget
     *
     * @param Request $request
     * @return mixed
     */
    public function pdf(Request $request)
    {
        $budget = Budget::where('id', '=', $request->id)
            ->where('user_id', '=', Auth::id())->firstOrFail();
        $incomes = $budget->incomes()->get();
        $expenses = $budget->expenses()->get();

        //Calculate budget total
        $gain = 0.00;
        $loss = 0.00;
        foreach($incomes as $income) {
            $gain += $income->amount;
        }
        foreach($expenses as $expense) {
            $loss += $expense->amount;
        }

        $pdf = PDF::loadView('budget', [
            'budget'    => $budget,
            'incomes'   => $incomes,
            'expenses'  => $expenses,
            'start'     => Carbon::parse($budget->start_date)->toFormattedDateString(),
            'end'       => Carbon::parse($budget->end_date)->toFormattedDateString(),
            'gain'      => $gain,
            'loss'      => $loss
        ]);
        return $pdf->stream('budget.pdf');
    }
}
