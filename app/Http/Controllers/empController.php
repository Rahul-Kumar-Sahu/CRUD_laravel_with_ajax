<?php

namespace App\Http\Controllers;

use App\Models\employeeDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class empController extends Controller
{

    public function index()
    {
        return view('employee.index');
    }

    // fetch data form employee table
    public function getEmps()
    {
        $employees = employeeDetails::all();
        return response()->json(
            $employees
        );

    }
    public function add(Request $request)
    {
        $data['details'] = [];
        if (@$request->id) {
            $data['details'] = DB::select('SELECT * FROM employee_details WHERE emp_id = ?', [$request->id])[0];
        }

        return view('employee.add', $data);
    }

    public function store(Request $request)
    {
        // validate the employee data
        $validatedData = $request->validate([
            'emp_name' => 'required|string|max:255',
            'emp_email' => [
                'required',
                'email',
                Rule::unique('employee_details', 'emp_email')->ignore($request->emp_id, 'emp_id')
            ],
            'emp_phone' => [
                'required',
                'digits:10',
                Rule::unique('employee_details', 'emp_phone')->ignore($request->emp_id, 'emp_id')
            ],
            'emp_address' => 'nullable|string|max:500',
            'emp_department' => 'required|string|max:100',
            'emp_joining_date' => 'required|date',
            'emp_designation' => 'required|string|max:100',
        ]);

        if (!empty($request->emp_id)) {
            $employee = true;
            if ($employee) {
                // DB::enableQueryLog();
                $sts = DB::table('employee_details')->where('emp_id', $request->emp_id)->update($validatedData);
                // dd(DB::getQueryLog());

                if ($sts) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Employee Updated Successfully',
                        'redirect' => route(name: 'index')
                    ]);
                }else{
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Employee Updation faild',
                        'redirect' => route(name: 'index')
                    ]);
                }
            }
        } else {
            employeeDetails::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee Created Successfully',
                'redirect' => route(name: 'index')
            ]);
        }


    }

    public function delete($id)
    {
        $result = DB::delete('DELETE FROM employee_details WHERE emp_id = ?', [$id]);
        if ($result) {
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Employee Deleted Successfully'
            ]);
        } else {
            return response()->back()->with([
                'status' => 'error',
                'message' => 'Employee not Deleted'
            ]);
        }


    }

    public function updateFetch($id)
    {
        $result = DB::select('SELECT * FROM employee_details WHERE emp_id = ?', [$id]);

        if ($result) {
            return response()->json([
                'success' => 'Employees details updated successfully',
                // 'redirect_url' => route('loadView.emp.update'),
                'data' => $result
            ]);
        }

    }

    public function updateDetails()
    {

    }

}
