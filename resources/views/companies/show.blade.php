@extends('layouts.app')
@section('title', $company->name . ' Company Profile')

@section('content')

<div class="container">
    <!--Title and Back to Companies Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">Company Profile</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-purple px-4 fw-bold">
            &larr; Back to Companies
        </a>
    </div>

    <!-- Company Profile Card Header -->
    <div class="profile-header-card p-4 mb-5 shadow-sm">
        <div class="row align-items-center g-4">
            
            <!-- Logo Box -->
            <div class="col-auto">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" class="profile-logo-bubble shadow">
                @else
                    <div class="profile-logo-placeholder">No Logo</div>
                @endif
            </div>

            <!-- Company Profile Details -->
            <div class="col-sm col-12">
                <h2 class="h2 fw-bold text-white mb-2">{{ $company->name }}</h2>
                
                <div class="g-2 text-sm">
                    <div class="col-md-6 mt-2">
                        <span class="fw-bold fs-5" style="color: var(--purple-primary);">Email:</span> 
                        <span class=" fs-5" style="color: var(--text-muted);">{{ $company->email ?? '-' }}</span>
                    </div>
                    <!-- Company Website -->
                    <div class="col-md-6 mt-2">
                        <span class="fw-bold fs-5 me-2" style="color: var(--purple-primary);">Website:</span> 
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="website-link font-medium fs-5">
                               {{ 'www.' . str_replace(['http://', 'https://', 'www.'], '', $company->website)}}
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                    <!-- Employee Count Bubble for Company -->
                    <div class="col-12 mt-2">
                        <span class="fw-bold fs-5" style="color: var(--purple-primary);">Total Number of Employees:</span> 
                        <span class="badge fs-5 rounded-pill px-3 py-1 ms-1" style="background-color: var(--bg-dark-grey); color: #fff; border: 1px solid rgba(139, 92, 246, 0.3);">
                            {{ $company->employees->count() }} Staff Employees
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table of Employeed Staff -->
    <div class="mb-2">
        <h3 class="h4 fw-bold mb-3" style="color: var(--text-main); letter-spacing: 0.5px;">Current Staff Employees</h3>
        
        <!-- If statement checks if empty then if not shows table list of employees -->
        @if($company->employees->isEmpty())
            <div class="empty-state-box p-4 text-center italic">
                This company currently has no staff employees.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle shadow-sm">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loops through the empoloyees that belong to this company to show their infomation -->
                        @foreach($company->employees as $worker)
                        <tr>
                            <!-- First Name -->
                            <td>
                                <a href="{{ route('employees.show', $worker->id) }}" class="profile-link fw-bold">
                                    {{ $worker->first_name }}
                                </a>
                            </td>
                            
                            <!-- Last Name -->
                            <td>
                                <a href="{{ route('employees.show', $worker->id) }}" class="profile-link fw-bold">
                                    {{ $worker->last_name }}
                                </a>
                            </td>
                            
                            <!-- Email -->
                            <td>{{ $worker->email ?? '-' }}</td>
                            
                            <!-- Action Links (View, Edit & Delete) Uses Put Method to Update Company and Employee -->
                            <td class="text-center flex-row justify-content-center d-sm-flex">
                                 <a href="{{ route('companies.show', $company->id) }}" class="action-link text-info px-2">View</a>
                                <a href="{{ route('companies.edit', $company->id) }}" class="action-link px-2 text-warning">Edit</a>
                                <form action="{{ route('employees.update', $worker->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Remove this employee from the company roster?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="first_name" value="{{ $worker->first_name }}">
                                    <input type="hidden" name="last_name" value="{{ $worker->last_name }}">
                                    <input type="hidden" name="company_id" value="">
                                    <button type="submit" class="btn btn-link p-0 action-link px-2 text-danger border-0 align-baseline">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Company Action Links (Edit & Delete) -->
    <div class="d-flex align-items-center gap-3 pt-2">
        <a href="{{ route('companies.edit', $company->id) }}" class="action-link text-warning fw-bold">
            Edit Company
        </a>
        <span class="opacity-25" style="color: var(--text-muted);">|</span>
        <!-- Delete Method for Delete Link with Warning Box for Confirmation -->
        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Delete this company? All employees will be unassigned.');">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-link p-0 action-link text-danger fw-bold border-0 align-baseline">
                Delete Company
            </button>
        </form>
    </div>
</div>
@endsection