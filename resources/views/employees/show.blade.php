@extends('layouts.app')
@section('title', $employee->first_name .' '. $employee->last_name . ' Employee Profile')

@section('content')
<div class="container">
    <!-- Title and Back to Employees Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">Employee Profile</h1>
        <a href="{{ route('employees.index') }}" class="btn btn-purple px-4 fw-bold">
            &larr; Back to Employees
        </a>
    </div>

    <!-- Employee Profile Card -->
    <div class="profile-details-card p-4 p-md-5 mb-4 shadow-sm">
        <!-- Card Header -->
        <h2 class="h3 fw-bold pb-3 mb-4 profile-card-header">
            {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
        
        <!-- Employee Profile Details -->
        <div class="row g-4">
            <!-- First Name -->
            <div class="col-md-6 col-12">
                <span class="field-label fs-5">First Name</span>
                <span class="field-value  fs-5">{{ $employee->first_name }}</span>
            </div>
            
            <!-- Last Name -->
            <div class="col-md-6 col-12">
                <span class="field-label  fs-5">Last Name</span>
                <span class="field-value  fs-5">{{ $employee->last_name }}</span>
            </div>
            
            <!-- Email -->
            <div class="col-md-6 col-12">
                <span class="field-label  fs-5">Email Address</span>
                <span class="field-value  fs-5" style="color: var(--text-muted);">{{ $employee->email ?? '-' }}</span>
            </div>
            
            <!-- Phone Number -->
            <div class="col-md-6 col-12">
                <span class="field-label  fs-5">Phone Number</span>
                <span class="field-value  fs-5" style="color: var(--text-muted);">{{ $employee->phone ?? '-' }}</span>
            </div>
            
            <!-- Current Company Employer -->
            <div class="col-12 mt-4">
                <span class="field-label fs-5">Current Company Employer</span>
                @if($employee->company)
                    <a href="{{ route('companies.show', $employee->company->id) }}" class="company-link fs-5">
                        💼 {{ $employee->company->name }}
                    </a>
                @else
                    <span class="text-muted opacity-50 italic small">This Employee is currently not employed to any company.</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Employee Action Links (Edit & Delete) -->
    <div class="d-flex align-items-center gap-3 pt-2">
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-edit px-3 py-2 fw-bold">
            Edit Details
        </a>
        <span class="opacity-25" style="color: var(--text-muted);">|</span>
        
        <!-- Updated Form using target binding and removing native onsubmit -->
        <form id="deleteEmployeeForm" action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline m-0">
            @csrf 
            @method('DELETE')
            <button type="button" 
                    class="btn btn-delete px-3 py-2 fw-bold border-0 align-baseline"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteEmployeeModal">
                Delete Employee
            </button>
        </form>
    </div>
</div>

<!-- Dark Styled Bootstrap Confirmation Modal -->
<div class="modal fade text-start" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light border-secondary">
      
      <div class="modal-header border-secondary">
        <h5 class="modal-title" id="deleteEmployeeLabel">Confirm Employee Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body text-wrap opacity-90">
        Are you sure you want to permanently delete <strong>{{ $employee->first_name }} {{ $employee->last_name }}</strong>? This action cannot be undone.
      </div>
      
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <!-- Tied securely to the form above via form="" attribute -->
        <button type="submit" form="deleteEmployeeForm" class="btn btn-danger fw-bold">Delete Employee</button>
      </div>

    </div>
  </div>
</div>
@endsection