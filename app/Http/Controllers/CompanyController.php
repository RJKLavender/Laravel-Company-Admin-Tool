<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $validatedData = $request->validated(); // Contains only verified fields

    if ($request->hasFile('logo')) {
        $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
    }

    Company::create($validatedData);

    return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validatedData = $request->validated();

    if ($request->hasFile('logo')) {
        // Optional: Delete old logo file from storage here before saving the new one
        $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $company->update($validatedData);

    return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
               if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted.');
    }
}
