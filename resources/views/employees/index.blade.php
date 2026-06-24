@extends('layouts.app')
@section('title', 'List of Employees')

@section('content')
<div class="container">
    <!-- Title and Add Employee Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold m-0" style="color: var(--text-main);">List of Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-purple px-4 fw-bold">
            Add Employee
        </a>
    </div>

    <!-- Success Messaging Alert box -->
    @if(session('success'))
        <div class="alert alert-success border-0 bg-success text-white px-4 py-3 mb-4 shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-8 col-lg-7"> 
            <form action="{{ url()->current() }}" method="GET">
                <!-- Retain current sort and order preferences natively -->
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                @if(request('direction'))
                    <input type="hidden" name="direction" value="{{ request('direction') }}">
                @endif

                <!--Search Form-->
                <div class="row g-3 align-items-center">
                    <!-- Search Field Container -->
                    <div class="col">
                        <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                            <!-- Search Icon Wrapper -->
                            <span class="input-group-text border-0 text-muted" style="background-color: #2a2a2a; color: var(--text-main) !important;">
                                <svg xmlns="http://w3.org" width="14" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </span>
                            
                            <!-- Text Input -->
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                class="form-control border-0 text-white py-2" 
                                style="background-color: var(--bg-dark-grey, #1e1e1e); color-scheme: dark; font-size: 0.95rem;"
                                placeholder="Search by last name, or full name (e.g. 'Smith' or 'John Smith')..."
                                aria-label="Search by employee name"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <!-- Action Buttons Container (Search & Clear) -->
                    <div class="col-auto d-flex align-items-center" style="gap: 12px;">
                        <button class="btn btn-purple fw-bold px-4 py-2" type="submit" style="border-radius: 8px;">
                            Search
                        </button>

                        @if(request('search'))
                            <a href="{{ url()->current() . (request('sort') ? '?sort='.request('sort').'&direction='.request('direction') : '') }}" 
                               class="btn fw-bold px-4 py-2 custom-clear-btn" 
                               style="border-radius: 8px; color: var(--text-main, #ffffff); border: 2px solid rgba(255, 255, 255, 0.4); background: transparent;"
                               title="Reset Table">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- List of Employees Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle shadow-sm">
            <thead style="vertical-align: middle !important;">
                <tr>
                    <!-- Sortable First Name Column -->
                    <th scope="col">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'first_name', 'direction' => ($sort === 'first_name' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                            First Name 
                            <span class="sort-triangle {{ $sort === 'first_name' ? $direction : 'default' }}"></span>
                        </a>
                    </th>
                    
                    <!-- Sortable Last Name Column -->
                    <th scope="col">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'last_name', 'direction' => ($sort === 'last_name' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                            Last Name 
                            <span class="sort-triangle {{ $sort === 'last_name' ? $direction : 'default' }}"></span>
                        </a>
                    </th>
                    
                    <!-- Sortable Company Column -->
                    <th scope="col">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'company_name', 'direction' => ($sort === 'company_name' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                            Company 
                            <span class="sort-triangle {{ $sort === 'company_name' ? $direction : 'default' }}"></span>
                        </a>
                    </th>
                    
                    <!-- Sortable Email Column -->
                    <th scope="col">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => ($sort === 'email' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                            Email 
                            <span class="sort-triangle {{ $sort === 'email' ? $direction : 'default' }}"></span>
                        </a>
                    </th>
                    
                    <!-- Sortable Phone Column -->
                    <th scope="col">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'phone', 'direction' => ($sort === 'phone' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--text-main);">
                            Phone 
                            <span class="sort-triangle {{ $sort === 'phone' ? $direction : 'default' }}"></span>
                        </a>
                    </th>
                    
                    <th scope="col" class="text-center" style="color: var(--text-main);">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <!-- First Name -->
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}" class="profile-link fw-bold">
                            {{ $employee->first_name }}
                        </a>
                    </td>
                    
                    <!-- Last Name -->
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}" class="profile-link fw-bold">
                            {{ $employee->last_name }}
                        </a>
                    </td>
                    
                    <!-- Company Profile Reference Link -->
                    <td>
                        @if($employee->company)
                            <a href="{{ route('companies.show', $employee->company->id) }}" class="profile-link fw-medium" style="color: var(--purple-primary) !important;">
                                {{ $employee->company->name }}
                            </a>
                        @else
                            <span class="text-white-50 italic small" style="font-size:1rem; ">No Company Employer</span>
                        @endif
                    </td>
                    
                    <!-- Email and Contact Phone Number -->
                    <td>{{ $employee->email ?? '-' }}</td>
                    <td>{{ $employee->phone ?? '-' }}</td>
                    
                    <!-- Actions Links (View, Edit, Delete) -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-4">
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info px-3 py-2 fw-bold">View</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-edit px-3 py-2 fw-bold">Edit</a>
                            
                            <form id="deleteForm-{{ $employee->id }}" action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline m-0">
                                @csrf 
                                @method('DELETE')

                                <!-- The Trigger Button -->
                                <button type="button" class="btn btn-delete px-3 py-2 fw-bold border-0 align-baseline" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $employee->id }}">
                                    Delete
                                </button>
                            </form>
                        </div>

                        <!-- Bootstrap Delete Confirmation Modal -->
                        <div class="modal fade text-start" id="deleteModal-{{ $employee->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $employee->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        
                            <div class="modal-content bg-dark text-light border-secondary">
      
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title" id="deleteModalLabel-{{ $employee->id }}">Confirm Employee Deletion</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
      
                            <div class="modal-body text-wrap opacity-90 text-center">
                                Are you sure you want to permanently delete <strong>{{ $employee->first_name }} {{ $employee->last_name }}</strong>? This action cannot be undone.
                            </div>
      
                            <div class="modal-footer border-secondary">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" form="deleteForm-{{ $employee->id }}" class="btn btn-danger fw-bold">Delete Employee</button>
                            </div>

                            </div>
                        </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Row Handled by Vendor/Pagination Bootstrap Files -->
    <div class="d-flex justify-content-center mt-4">
        {{ $employees->appends(request()->query())->links() }}
    </div>
</div>
@endsection