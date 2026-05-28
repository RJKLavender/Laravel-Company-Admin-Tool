<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest; 

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
     
    Employee::create($request->validated());

    return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load('company'); 
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $companies = Company::all();
        return view('employees.edit', compact('employee'), compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // The request runs validation automatically before this code block starts.
    $employee->update($request->validated());

    return redirect()->route('employees.index')->with('success', 'Employee data updated successfully.');

    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }

}

    
