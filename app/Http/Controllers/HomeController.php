<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;  
use App\Models\Employee;

class HomeController extends Controller
{
   
     /**
     * Shows the home page view
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            // Fetchs the counts of how many employees and companies are currently in database
            $companyCount = \App\Models\Company::count();
            $employeeCount = \App\Models\Employee::count();
            
            return view('home', compact('companyCount', 'employeeCount'));
    }
}
