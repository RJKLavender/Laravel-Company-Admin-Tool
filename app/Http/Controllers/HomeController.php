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
        $companyCount = Company::count();
        $employeeCount = Employee::count();
        return view('home', compact('companyCount', 'employeeCount'));
    }
}
