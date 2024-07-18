<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function addExpense()
    {
        return view('backend.expense.add_expense');
    }

    public function storeExpense(Request $request)
    {
        $validate = $request->validate([
            'details' => 'required',
            'amount' => 'required',
        ]);

        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now(),
        ]);
        $toastr = array(
            'success' => 'Expense Data Inserted Successfully.'
        );

        return redirect()->back()->with($toastr);
    }

    public function todayExpense()
    {
        $date = date('d-m-Y');
        $today = Expense::where('date', $date)->get();

        return view('backend.expense.today_expense', compact('today'));
    }

    public function editExpense($id)
    {
        $expense = Expense::findOrFail($id);

        return view('backend.expense.edit_expense', compact('expense'));
    }

    public function updateExpense(Request $request)
    {
        $expense_id = $request->id;

        Expense::findOrFail($expense_id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
        ]);
        $toastr = array(
            'success' => 'Expense Data Inserted Successfully.'
        );

        return redirect()->route('today.expense')->with($toastr);
    }

    public function monthExpense()
    {
        $month = date('F');
        $monthexpense = Expense::where('month', $month)->get();

        return view('backend.expense.month_expense', compact('monthexpense'));
    }

    public function yearExpense()
    {
        $year = date('Y');
        $yearexpense = Expense::where('year', $year)->get();

        return view('backend.expense.year_expense', compact('yearexpense'));
    }
}
