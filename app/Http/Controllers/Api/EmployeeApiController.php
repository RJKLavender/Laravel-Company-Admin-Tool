<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;

class EmployeeApiController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(Employee::paginate(10)); // Returns JSON
    }
}