<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

//Controller for the Company JSON File Rescource 
class CompanyApiController extends Controller
{
    public function index()
    {
        return CompanyResource::collection(Company::paginate(10)); // Returns JSON view
    }
}