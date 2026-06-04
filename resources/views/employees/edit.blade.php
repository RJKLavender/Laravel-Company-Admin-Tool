@extends('layouts.app')
@section('title', 'Update '. $employee->first_name . ' ' . $employee->last_name . ' Employee Details')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-8">
            
            <div class="form-container-card p-5 py-md-4 mt-4 shadow-lg">
                <!-- Header Component -->
                <div class="mb-4">
                    <h1 class="h3 fw-bold m-0" style="color: var(--purple-primary);">
                        Edit Employee: <span style="color: var(--purple-primary);">{{ $employee->first_name }}</span>
                    </h1>
                </div>

                <!-- Error Alert Block -->
                @if ($errors->any())
                    <div class="alert dark-error-alert p-4 mb-4 shadow-sm" role="alert">
                        <div class="fw-bold mb-1">Please correct the errors below:</div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Data Form -->
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- First and Last Name Grid Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <label for="first_name" class="form-label form-label-custom">First Name</label>
                            <input type="text" name="first_name" id="first_name" 
                                   value="{{ old('first_name', $employee->first_name) }}" 
                                   class="form-control @error('first_name') is-invalid @enderror">
                            @error('first_name') 
                                <div class="invalid-feedback-custom mt-1"><strong>{{ $message }}</strong></div> 
                            @enderror
                        </div>

                        <div class="col-md-6 col-12">
                            <label for="last_name" class="form-label form-label-custom">Last Name</label>
                            <input type="text" name="last_name" id="last_name" 
                                   value="{{ old('last_name', $employee->last_name) }}" 
                                   class="form-control @error('last_name') is-invalid @enderror">
                            @error('last_name') 
                                <div class="invalid-feedback-custom mt-1"><strong>{{ $message }}</strong></div> 
                            @enderror
                        </div>
                    </div>

                    <!-- Company Selection Dropdown -->
                    <div class="mb-3">
                        <label for="company_id" class="form-label form-label-custom">Company</label>
                        <select name="company_id" id="company_id" class="form-select form-select-dark @error('company_id') is-invalid @enderror">
                            <option value="">Select a Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id') 
                            <div class="invalid-feedback-custom mt-1"><strong>{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Email Field Wrapper -->
                    <div class="mb-3">
                        <label for="email" class="form-label form-label-custom">Email Address</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $employee->email) }}" 
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email') 
                            <div class="invalid-feedback-custom mt-1"><strong>{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Phone Field Wrapper -->
                    <div class="mb-3">
                        <label for="phone" class="form-label form-label-custom">Phone Number</label>
                        <input type="text" name="phone" id="phone" 
                               value="{{ old('phone', $employee->phone) }}" 
                               class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') 
                            <div class="invalid-feedback-custom mt-1"><strong>{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Bottom Navigation Form Action Anchors -->
                    <div class="d-flex justify-content-center align-items-center gap-2 pt-2">
                        <button type="submit" class="btn btn-purple px-4 py-2 fw-bold">
                            Update Employee
                        </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary-custom px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection