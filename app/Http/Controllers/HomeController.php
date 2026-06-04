<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;  
use App\Models\Employee;

class HomeController extends Controller
{
   
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            // Fetch your counts for the dashboard
            $companyCount = \App\Models\Company::count();
            $employeeCount = \App\Models\Employee::count();

            // CORRECT: Return the home view
            return view('home', compact('companyCount', 'employeeCount'));
    }
}
