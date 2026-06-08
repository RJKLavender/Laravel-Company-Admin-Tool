<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Displays a list of employees with 10 per page
     */
    public function index()
    {
         $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Shows a form for adding a employee to the database
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(); //adds companies into a dropdown menu to select which company this new employee belongs to.
        return view('employees.create', compact('companies'));
    }

    /**
     * Stores the new employee details to the database
     */
    public function store(StoreEmployeeRequest $request)
    {
     
    Employee::create($request->validated());

    return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    /**
     * Displays the employee's profile
     */
    public function show(Employee $employee)
    {
        $employee->load('company'); //loads the company details of which company this employee belongs to
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Shows a form for editing the employee details 
     */
    public function edit(Employee $employee)
    {
        $companies = Company::orderBy('name')->get();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the employee's details within the database
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
       
    $employee->update($request->validated());

    return redirect()->route('employees.index')->with('success', 'Employee data updated successfully.');
    }

    /*
    * Deletes the employee from the database
    */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }

}

    
