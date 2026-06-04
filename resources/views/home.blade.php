@extends('layouts.app')
@section('title', 'Company Admin Tool Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Removed all default Bootstrap background classes -->
            <div class="card dashboard-card mt-4 shadow-lg">
                <div class="card-header dashboard-header">
                    {{ __('Home Directory') }}
                </div>

                <div class="card-body py-4 px-md-5">
                    {{-- Tool Description Section --}}
                    <div class="mb-3">
                        <h2 class="h4 mb-3" style="color: var(--purple-primary); font-weight: 700;">
                            Company Directory & Administration Tool
                        </h2>
                        <p style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.7;">
                            This is an administrative tool that allows for Adminstrative Mangement to personnally track, create, modify, and monitor each company's details and each company's internal staff records. 
                        </p>
                    </div>

                    <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">

                    {{-- Database Records Counter Cards --}}
                    <h3 class="h6 mb-4 text-uppercase tracking-widest" style="color: var(--purple-primary); font-weight: 700;">
                        Current Total Company and Staff Figures
                    </h3>
                    
                    <div class="row g-4 text-center">
                        <!-- Companies Metric -->
                        <div class="col-sm-6">
                            <div class="metric-box p-4">
                                <div class="text-uppercase tracking-wider font-weight-bold small mb-3" style="color: var(--text-muted);">Total Companies</div>
                                <div class="display-5 font-weight-bold text-primary mb-2">{{ $companyCount }}</div>
                                <a href="{{ route('companies.index') }}" class="btn btn-metric-primary mt-2 px-4 py-2">
                                    Manage Companies
                                </a>
                            </div>
                        </div>

                        <!-- Employees Metric -->
                        <div class="col-sm-6">
                            <div class="metric-box p-4">
                                <div class="text-uppercase tracking-wider font-weight-bold small mb-3" style="color: var(--text-muted);">Total Employees</div>
                                <div class="display-5 font-weight-bold text-success mb-2">{{ $employeeCount }}</div>
                                <a href="{{ route('employees.index') }}" class="btn btn-metric-success mt-2 px-4 py-2">
                                    Manage Employees
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection