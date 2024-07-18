<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use App\Models\Attendence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendenceController extends Controller
{
    public function employeeAttendList()
    {
        $allData = Attendence::select('date')->groupBy('date')->orderBy('id', 'desc')->get();

        return view('backend.attendence.view_employee_attend', compact('allData'));
    }

    public function addEmployeeAttend()
    {
        $employee = Employee::all();

        return view('backend.attendence.add_employee_attend', compact('employee'));
    }

    public function employeeAttendStore(Request $request)
    {
        $countemployee = count($request->employee_id);
        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new Attendence();

            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $toastr = array(
            'success' => 'Data Inserted Succesfully.'
        );
        return redirect()->route('employee.attend.list')->with($toastr);
    }

    public function employeeAttendEdit($date)
    {
        $editData = Attendence::where('date', $date)->get();

        return view('backend.attendence.edit_employee_attend', compact('editData'));
    }

    public function employeeAttendUpdate(Request $request)
    {
        Attendence::where('date', date('Y-m-d', strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);
        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new Attendence();

            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $toastr = array(
            'success' => 'Data Updated Successfully.'
        );
        return redirect()->route('employee.attend.list')->with($toastr);
    }

    public function employeeAttendDetails($date)
    {
        $details = Attendence::where('date', $date)->get();

        return view('backend.attendence.details_employee_attend', compact('details'));
    }
}
