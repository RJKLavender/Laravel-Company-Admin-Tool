@extends('layouts.app')
@section('title', 'Add an Employee')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-8">
            
            <div class="form-container-card p-5 py-md-4 mt-4 shadow-lg">
                <!-- Header -->
                <div class="mb-4">
                    <h1 class="h3 fw-bold m-0" style="color: var(--purple-hover);">Add New Employee</h1>
                </div>

                <!-- Error Alert Block -->
                @if ($errors->any())
                    <div class="alert dark-error-alert p-4 mb-4 shadow-sm" role="alert">
                        <div class="fw-bold fs-5 mb-1">Please Correct The Errors Below:</div>
                        <ul class="mb-0 ps-3">
                        <!-- Loops through all Form Errors -->
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Add Employee Form -->
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    <!-- First and Last Name Grid Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 col-12">
                            <!-- First Name -->
                            <label for="first_name" class="form-label form-label-custom">First Name</label>
                            <input type="text" name="first_name" id="first_name" 
                                   value="{{ old('first_name') }}" 
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   placeholder="John">
                            @error('first_name') 
                                <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                            @enderror
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-6 col-12">
                            <label for="last_name" class="form-label form-label-custom">Last Name</label>
                            <input type="text" name="last_name" id="last_name" 
                                   value="{{ old('last_name') }}" 
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   placeholder="Doe">
                            @error('last_name') 
                                <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                            @enderror
                        </div>
                    </div>

                    <!-- Company Selection Dropdown -->
                    <div class="mb-3">
                        <label for="company_id" class="form-label form-label-custom">Company</label>
                        <select name="company_id" id="company_id" class="form-select form-select-dark @error('company_id') is-invalid @enderror">
                            <option value="">Select a Company</option>
                            <!--Loops through Comapnies Table for all current Company Options Then Assigns that ID to the the Employee's Entry -->
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label form-label-custom">Email Address</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email') }}" 
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="johndoe@company.com">
                        @error('email') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phone" class="form-label form-label-custom">Phone Number</label>
                        <input type="text" name="phone" id="phone" 
                               value="{{ old('phone') }}" 
                               class="form-control @error('phone') is-invalid @enderror"
                               placeholder="+1 (555) 000-0000">
                        @error('phone') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Save Employee and Cancel Buttons -->
                    <div class="d-flex justify-content-center align-items-center gap-2 pt-2">
                        <button type="submit" class="btn btn-purple px-4 py-2 fw-bold">
                            Save Employee
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