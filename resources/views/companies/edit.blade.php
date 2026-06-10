@extends('layouts.app')
@section('title', 'Update '. $company->name .' Company Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-8">
            
            <div class="form-container-card p-5 py-md-4 mt-4 shadow-lg">
                <!-- Header -->
                <div class="mb-4">
                    <h1 class="h3 fw-bold m-0" style="color: var(--purple-primary);">
                        Edit Company: <span style="color: var(--purple-primary);">{{ $company->name }}</span>
                    </h1>
                </div>

                <!-- Error Alert Block (works the same as the create view) -->
                @if ($errors->any())
                    <div class="alert dark-error-alert p-4 mb-4 shadow-sm" role="alert">
                        <div class="fw-bold fs-5 mb-1">Please Correct The Errors Below:</div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Company Form (Enctype + PUT method explicitly retained) -->
                <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Company Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label form-label-custom">Company Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" 
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label form-label-custom">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}" 
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Website URL -->
                    <div class="mb-3">
                        <label for="website" class="form-label form-label-custom">Website URL</label>
                        <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}" 
                               class="form-control @error('website') is-invalid @enderror">
                        @error('website') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Logo File Selector with Inline Image Preview -->
                    <div class="mb-3">
                        <label for="logo" class="form-label form-label-custom mb-2">Company Logo</label>
                        
                        @if($company->logo)
                            <div class="d-flex align-items-center gap-3 mb-3 p-2 rounded" style="background-color: var(--bg-dark-grey); border: 1px solid rgba(255,255,255,0.04);">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Current Logo" class="edit-logo-preview shadow-sm">
                                <span class="text-xs text-white-50">Current logo uploaded. Choose a new file to replace it.</span>
                            </div>
                        @endif

                        <input type="file" name="logo" id="logo" 
                               class="form-control form-control-file-custom @error('logo') is-invalid @enderror">
                         @error('logo') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Update Company and Cancel Buttons -->
                    <div class="d-flex justify-content-center align-items-center gap-2 pt-2">
                        <button type="submit" class="btn btn-purple px-4 py-2 fw-bold">
                            Update Company
                        </button>
                        <a href="{{ route('companies.index') }}" class="btn btn-secondary-custom px-4 py-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection