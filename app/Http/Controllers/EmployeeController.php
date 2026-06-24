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
    public function index(Request $request)
    {
    //sorting options for employee view
    $sortableColumnsEmployee = ['first_name', 'last_name', 'company_name', 'email', 'phone'];

    $sort = in_array($request->get('sort'), $sortableColumnsEmployee) ? $request->get('sort') : 'last_name';
    $direction = $request->get('direction') === 'desc' ? 'desc' : 'asc';

    $query = Employee::with('company');

    //search by either first or last name 
    if ($request->filled('search')) {
        // Clean up extra spaces and split the input string by spaces
        $words = explode(' ', preg_replace('/\s+/', ' ', trim($request->search)));

        $query->where(function ($subQuery) use ($words) {
            if (count($words) === 1) {
                // Scenario A: Only one word typed -> strictly search last name
                $subQuery->where('last_name', 'like', $words[0] . '%');
            } else {
                // Scenario B: Multiple words typed -> word 1 is First Name, word 2 is Last Name
                $subQuery->where('first_name', 'like', $words[0] . '%')
                         ->where('last_name', 'like', $words[1] . '%');
            }
        });
    }

    // checks if sortable company
    if ($sort === 'company_name') {
        $query->orderBy(
            Company::select('name')
                ->whereColumn('companies.id', 'employees.company_id')
                ->take(1),
            $direction
        );
    } else {
        $query->orderBy($sort, $direction);
    }

    $employees = $query->paginate(10)->withQueryString();

    return view('employees.index', compact('employees', 'sort', 'direction'));
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

    return redirect()->route('employees.index')->with('success', 'Employee has been successfully created.');
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
        $companies = Company::orderBy('name')->get(); //gets company list for dropdown box
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the employee's details within the database
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $currentCompanyId = $employee->company_id;
        $employee->update($request->validated());
        
        if ($request->input('source') === 'profile' && $currentCompanyId) {
        return redirect()->route('companies.show', $currentCompanyId)
            ->with('success', 'Employee has been successfully removed from this company.');
        }

        return redirect()->route('employees.index')->with('success', 'Employee has been successfully updated.');
    }

    /*
    * Deletes the employee from the database
    */
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee has been successfully deleted.');
    }

}

    
