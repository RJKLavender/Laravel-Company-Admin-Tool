@extends('layouts.app')
@section('title', 'Add a Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-8">
            <div class="form-container-card p-5 py-md-4 mt-4 shadow-lg">
                <!-- Header -->
                <div class="mb-4">
                    <h1 class="h3 fw-bold m-0" style="color: var(--purple-hover);">Add New Company</h1>
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

                <!-- Add Company Form Enctype Used for Logo Directory -->
                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Company Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label form-label-custom">Company Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Acme Corporation">
                        @error('name') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label form-label-custom">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="corporate@acme.com">
                        @error('email') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Website URL -->
                    <div class="mb-3">
                        <label for="website" class="form-label form-label-custom">Website URL</label>
                        <input type="url" name="website" id="website" value="{{ old('website') }}" 
                               placeholder="https://acme.com"
                               class="form-control @error('website') is-invalid @enderror">
                        @error('website') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Logo File Selector -->
                    <div class="mb-3">
                        <label for="logo" class="form-label form-label-custom">Company Logo</label>
                        <input type="file" name="logo" id="logo" 
                               class="form-control form-control-file-custom @error('logo') is-invalid @enderror">
                        <div class="form-text text-white-50 opacity-70 small mt-1">Minimum dimensions: 100x100 pixels.</div>
                        @error('logo') 
                            <div class="invalid-feedback-custom mt-1"><strong class="px-2">{{ $message }}</strong></div> 
                        @enderror
                    </div>

                    <!-- Save Company and Cancel Buttons -->
                    <div class="d-flex justify-content-center align-items-center gap-2 pt-2">
                        <button type="submit" class="btn btn-purple px-4 py-2 fw-bold">
                            Save Company
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