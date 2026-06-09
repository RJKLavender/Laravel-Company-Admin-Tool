@extends('layouts.app')
@section('title', 'List of Companies')

@section('content')
<div class="container">
    <!-- Title and Add Company Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">List of Companies</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-purple px-4 fw-bold">
            Add Company
        </a>
    </div>

    <!-- Success Messaging Alert Box -->
    @if(session('success'))
        <div class="alert alert-success border-0 bg-success text-white px-4 py-3 mb-4 shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- List of Companies Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle shadow-sm">
            <thead>
                <tr>
                    <th scope="col" style="width: 80px;">Logo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                    <th scope="col" class="text-center">Employees</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <!-- Logo Section -->
                    <td>
                        @if($company->logo)
                            <a href="{{ route('companies.show', $company->id) }}">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" class="company-logo-frame">
                            </a>
                        @else
                            <span class="text-muted small opacity-50 italic">No Logo</span>
                        @endif
                    </td>

                    <!-- Company Name -->
                    <td>
                        <a href="{{ route('companies.show', $company->id) }}" class="profile-link fw-bold">
                            {{ $company->name }}
                        </a>
                    </td>
                    
                    <!-- Contact Email -->
                    <td>{{ $company->email ?? '-' }}</td>

                    <!-- Company Website -->
                    <td>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="website-link font-medium">
                                {{ str_replace(['http://', 'https://', 'www.'], '', $company->website) }}
                            </a>
                        @else
                            <span class="text-muted opacity-50">-</span>
                        @endif
                    </td>
                    
                    <!-- Staff Count Pill -->
                    <td class="text-center">
                        <span class="badge rounded-pill px-3 py-2 border border-secondary" style="background-color: var(--bg-dark-grey); color: var(--text-main); font-size: 1.1rem;">
                            {{ $company->employees_count ?? $company->employees->count() }}
                        </span>
                    </td>
                    
                    <!-- Actions Links (View, Edit & Delete) -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-3 px-2">
                            <a href="{{ route('companies.show', $company->id) }}" class="action-link text-info">View</a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="action-link text-warning">Edit</a>
                            <!-- Delete Method for Delete Link with Warning Box for Confirmation -->
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Delete this company? All employees will be unassigned.');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 action-link text-danger border-0 align-baseline">Remove</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Row Handled by Vendor/Pagination Bootstrap Files -->
    <div class="d-flex justify-content-center mt-4">
        {{ $companies->links() }}
    </div>
</div>
@endsection