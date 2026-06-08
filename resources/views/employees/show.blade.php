@extends('layouts.app')
@section('title', $employee->first_name .' '. $employee->last_name . ' Employee Profile')

@section('content')
<div class="container">
    <!-- Top Nav Action Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">Employee Profile</h1>
        <a href="{{ route('employees.index') }}" class="btn btn-purple px-4 fw-bold">
            &larr; Back to Employees
        </a>
    </div>

    <!-- Main Profile Details Card Grid -->
    <div class="profile-details-card p-4 p-md-5 mb-4 shadow-sm">
        <!-- Card Header displaying the full name -->
        <h2 class="h3 fw-bold pb-3 mb-4 profile-card-header">
            {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
        
        <!-- Field Matrix Grid Structure -->
        <div class="row g-4">
            <!-- First Name Field -->
            <div class="col-md-6 col-12">
                <span class="field-label fs-5">First Name</span>
                <span class="field-value  fs-5">{{ $employee->first_name }}</span>
            </div>
            
            <!-- Last Name Field -->
            <div class="col-md-6 col-12">
                <span class="field-label  fs-5">Last Name</span>
                <span class="field-value  fs-5">{{ $employee->last_name }}</span>
            </div>
            
            <!-- Email Address Field -->
            <div class="col-md-6 col-12">
                <span class="field-label  fs-5">Email Address</span>
                <span class="field-value  fs-5" style="color: var(--text-muted);">{{ $employee->email ?? '-' }}</span>
            </div>
            
            <!-- Phone Number Field -->
            <div class="col-md-6 col-12">
                <span class="field-label  fs-5">Phone Number</span>
                <span class="field-value  fs-5" style="color: var(--text-muted);">{{ $employee->phone ?? '-' }}</span>
            </div>
            
            <!-- Company Assignment Field Block -->
            <div class="col-12 mt-4">
                <span class="field-label fs-5">Current Employer</span>
                @if($employee->company)
                    <a href="{{ route('companies.show', $employee->company->id) }}" class="company-link fs-5">
                        💼 {{ $employee->company->name }}
                    </a>
                @else
                    <span class="text-muted opacity-50 italic small">No Company Assigned</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Core Level Management Actions Footprint Controls -->
    <div class="d-flex align-items-center gap-3 pt-2">
        <a href="{{ route('employees.edit', $employee->id) }}" class="action-link text-warning fw-bold">
            Edit Details
        </a>
        <span class="opacity-25" style="color: var(--text-muted);">|</span>
        
        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Delete this employee?');">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-link p-0 action-link text-danger fw-bold border-0 align-baseline">
                Delete Employee
            </button>
        </form>
    </div>
</div>
@endsection