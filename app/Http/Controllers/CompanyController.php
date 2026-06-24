<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    /**
     * Display a view containing a list of companies with 10 per page
     */
    public function index(Request $request)
    {

        //sortable options for company view
        $sortableColumsCoampany = ['name','email','website','employees_count'];
        
        $sort = in_array($request->get('sort'), $sortableColumsCoampany) ? $request->get('sort') : 'name';
        $direction = $request->get('direction') === 'desc' ? 'desc' : 'asc';

        //Search function Code
        $query = Company::withCount('employees');

        if ($request->filled('search')) {
            $query->where('name', 'like', $request->search . '%');
        }

        $companies = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();

        $allCompanies = Company::select('id', 'name')->orderBy('name', 'asc')->get();

        return view('companies.index', compact('companies', 'sort', 'direction', 'allCompanies'));   
    }

    /**
     * Shows a form view in order to add a company
     */
    public function create()
    {
      return view('companies.create');
    }

    /**
     * Stores a new companie details to database 
    */
    public function store(StoreCompanyRequest $request)
    {
        $validatedData = $request->validated(); // Contains only verified fields

    if ($request->hasFile('logo')) {
    // This saves the file directly into: storage/app/public/logos/
    $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        }
    
    Company::create($validatedData);
    // returns the view with success message
    return redirect()->route('companies.index')->with('success', 'Company has been successfully created.');
    }

    /**
     * Displays the chosen company's profile view 
     */
    public function show(Company $company)
    {
        $company->load('employees'); //pulls employees details that are staff at that company

        return view('companies.show', compact('company'));
    }

    /**
     * Shows a form for editing company details 
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Updates the newly edited company details to database
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validatedData = $request->validated();

    if ($request->hasFile('logo')) {
        // switchs logos and stores new logo to storage
        $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $company->update($validatedData);
    // returns the view with success message
    return redirect()->route('companies.index')->with('success', 'Company has been successfully updated.');
    }

    /**
     * Deletes the company from the database
     */
    public function destroy(Request $request, Company $company)
    {
        $employeeCount = $company->employees()->count();

        if ($request->input('source') === 'profile') {
        if ($employeeCount > 0) {
            return redirect()->route('companies.show', $company->id)
                ->withErrors(['delete_error' => 'Cannot delete a company with active employees via its profile page.']);
        }
        
        // Safe to delete if count is zero
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Company removed successfully.');
        }

        if ($employeeCount > 0) {
        // Enforce dropdown selection validation if employees exist
        $request->validate([
            'reassign_company_id' => 'required|exists:companies,id|not_in:' . $company->id
        ]);

        // Bulk reassign all employees to the selected target company ID
        $company->employees()->update([
            'company_id' => $request->reassign_company_id
        ]);
        }

        //deletes the logo from storage
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        
        //deletes the company from the database and supplys success message.
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company has been successfully deleted and employees reassigned.');
    }
}
