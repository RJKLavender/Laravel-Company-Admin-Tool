@extends('layouts.app')
@section('title', $employee->first_name .' '. $employee->last_name . ' Employee Profile')

@section('content')
<style>
    /* Profile Summary Panel Card */
    .profile-details-card {
        background-color: var(--bg-card-grey) !important;
        border: 1px solid rgba(139, 92, 246, 0.15) !important;
        border-radius: 12px;
    }

    .profile-card-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }

    /* Subtitle Labels for Data Fields */
    .field-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--purple-primary);
        margin-bottom: 0.25rem;
    }

    .field-value {
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--text-main);
    }

    /* Interactive Context Anchor Links */
    .company-link {
        color: #38bdf8 !important; /* Premium readable sky blue link */
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.15s ease;
    }
    .company-link:hover {
        text-decoration: underline !important;
        opacity: 0.85;
    }

    .action-link {
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: opacity 0.15s;
    }
    .action-link:hover {
        text-decoration: underline !important;
        opacity: 0.85;
    }
</style>

<div class="container">
    <!-- Top Nav Action Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold m-0" style="color: var(--text-main);">Employee Profile</h1>
        <a href="{{ route('employees.index') }}" class="btn btn-purple px-4 fw-bold">
            &larr; Back to Employees
        </a>
    </div>

    <!-- Main Profile Details Card Grid -->
    <div class="profile-details-card p-4 p-md-5 mb-4 shadow-sm">
        <!-- Card Header displaying the full name -->
        <h2 class="h4 fw-bold pb-3 mb-4 profile-card-header">
            {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
        
        <!-- Field Matrix Grid Structure -->
        <div class="row g-4">
            <!-- First Name Field -->
            <div class="col-md-6 col-12">
                <span class="field-label">First Name</span>
                <span class="field-value">{{ $employee->first_name }}</span>
            </div>
            
            <!-- Last Name Field -->
            <div class="col-md-6 col-12">
                <span class="field-label">Last Name</span>
                <span class="field-value">{{ $employee->last_name }}</span>
            </div>
            
            <!-- Email Address Field -->
            <div class="col-md-6 col-12">
                <span class="field-label">Email Address</span>
                <span class="field-value" style="color: var(--text-muted);">{{ $employee->email ?? '-' }}</span>
            </div>
            
            <!-- Phone Number Field -->
            <div class="col-md-6 col-12">
                <span class="field-label">Phone Number</span>
                <span class="field-value" style="color: var(--text-muted);">{{ $employee->phone ?? '-' }}</span>
            </div>
            
            <!-- Company Assignment Field Block -->
            <div class="col-12 mt-4">
                <span class="field-label">Assigned Company</span>
                @if($employee->company)
                    <a href="{{ route('companies.show', $employee->company->id) }}" class="company-link">
                        💼 {{ $employee->company->name }}
                    </a>
                @else
                    <span class="text-muted opacity-50 italic small">No Company Assigned</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Core Level Management Actions Footprint Controls -->
    <div class="d-flex align-items-center gap-3 border-top pt-4" style="border-color: rgba(255, 255, 255, 0.08) !important;">
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