@extends('layouts.app')
@section('title', 'Company Admin Tool Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white font-weight-bold">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- Tool Description Section --}}
                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">Corporate Directory & Administration Tool</h2>
                        <p class="text-muted leading-relaxed">
                            Welcome to your administrative dashboard. This centralized management system allows authorized personnel to track, create, modify, and monitor corporate profiles alongside internal staff records. Use the primary navigation menu to review individual business profiles or update individual employee directories seamlessly.
                        </p>
                    </div>

                    <hr class="my-4 text-muted">

                    {{-- Database Records Counter Cards --}}
                    <h3 class="h5 text-secondary mb-4">Database Overview</h3>
                    <div class="row g-4 text-center">
                        
                        <!-- Companies Metric -->
                        <div class="col-sm-6">
                            <div class="border rounded p-4 bg-light shadow-sm">
                                <div class="text-uppercase tracking-wide font-weight-bold text-muted small mb-2">Total Companies</div>
                                <div class="display-5 font-weight-bold text-primary">{{ $companyCount }}</div>
                                <a href="{{ route('companies.index') }}" class="btn btn-sm btn-outline-primary mt-3">Manage Companies</a>
                            </div>
                        </div>

                        <!-- Employees Metric -->
                        <div class="col-sm-6">
                            <div class="border rounded p-4 bg-light shadow-sm">
                                <div class="text-uppercase tracking-wide font-weight-bold text-muted small mb-2">Total Employees</div>
                                <div class="display-5 font-weight-bold text-success">{{ $employeeCount }}</div>
                                <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-success mt-3">Manage Employees</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection