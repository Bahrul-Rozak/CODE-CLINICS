<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee_data = Employee::all();
        return view('admin.backend.employee.index', compact('employee_data'));
    }

    public function create()
    {
        return view('admin.backend.employee.create');
    }

    public function store(Request $request)
    {
        // Testing dulu lah..
        // dd($request->all());

        // Validasi input


        $request->validate([
            'employee_code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:255',
            'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
            'position' => 'required|in:nurse,pharmacist,doctor,finance,security',
        ]);

        Employee::create([
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'religion' => $request->religion,
            'position' => $request->position,
        ]);

        return redirect()->route('employee.index')->with('message', 'Employee Created Successfully');
    }

    public function show()
    {
        $employee_data = Employee::all();
        return view('employee.index', compact('employee_data'));
    }

    public function edit($id)
    {
        $employee_data = Employee::find($id);
        return view('admin.backend.employee.edit', compact('employee_data'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'employee_code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:255',
            'religion' => 'required|in:islam,kristen,hindu,budha,konghucu',
            'position' => 'required|in:nurse,pharmacist,doctor,finance,security',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {

        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }
}
