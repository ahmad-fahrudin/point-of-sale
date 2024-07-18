<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function addAdvanceSalary()
    {
        $employee = Employee::latest()->get();

        return view('backend.salary.add_advance_salary', compact('employee'));
    }

    public function AdvanceSalaryStore(Request $request)
    {
        $validateData = $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advance = AdvanceSalary::where('month', $month)->where('employee_id', $employee_id)->first();
        if ($advance === NULL) {
            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);

            $toastr = array(
                'success' => 'Advance Salary Paid Successfully'
            );

            return redirect()->route('all.advance.salary')->with($toastr);
        } else {
            $toastr = array(
                'warning' => 'Advance Already Paid.'
            );

            return redirect()->back()->with($toastr);
        }
    } // end method

    public function allAdvanceSalary()
    {
        $salary = AdvanceSalary::latest()->get();

        return view('backend.salary.all_advance_salary', compact('salary'));
    }

    public function editAdvanceSalary($id)
    {
        $employee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);


        return view('backend.salary.edit_advance_salary', compact('salary', 'employee'));
    }

    public function AdvanceSalaryUpdate(Request $request)
    {
        $salary_id = $request->id;

        AdvanceSalary::findOrFail($salary_id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'created_at' => Carbon::now(),
        ]);
        $toastr = array(
            'success' => 'Updated Successfully.'
        );

        return redirect()->route('all.advance.salary')->with($toastr);
    }

    public function deleteAdvanceSalary($id)
    {
        AdvanceSalary::findOrFail($id)->delete();

        $toastr = array(
            'success' => 'Successfuly Delete Data.'
        );

        return redirect()->back()->with($toastr);
    }


    // //////////////////////////////////////////// Pay Salary All Method /////////////////////////////////////////////////////
    public function paySalary()
    {
        $employee = Employee::latest()->get();

        return view('backend.salary.pay_salary', compact('employee'));
    }

    public function payNowSalary($id)
    {
        $paysalary = Employee::findOrFail($id);

        return view('backend.salary.paid_salary', compact('paysalary'));
    }

    public function employeeSalaryStore(Request $employe)
    {
        $employee_id = $employe->id;

        PaySalary::insert([
            'employee_id' => $employee_id,
            'salary_month' => $employe->salary_month,
            'paid_amount' => $employe->paid_amount,
            'advance_salary' => $employe->advance_salary,
            'due_salary' => $employe->due_salary,
            'created_at' => Carbon::now(),
        ]);
        $toastr = array(
            'success' => 'Salary Paid Successfully.'
        );

        return redirect()->route('pay.salary')->with($toastr);
    }

    public function monthSalary()
    {
        $paidsalary = PaySalary::latest()->get();

        return view('backend.salary.month_salary', compact('paidsalary'));
    }

    public function historySalary($id)
    {
        $historysalary = PaySalary::findOrFail($id);

        return view('backend.salary.history_salary', compact('historysalary',));
    }
}
