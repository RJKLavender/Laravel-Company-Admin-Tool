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

    <!-- List of Employees Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle shadow-sm">
            <thead>
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
                            <span class="text-muted opacity-50 italic small">None</span>
                        @endif
                    </td>
                    
                    <!-- Email and Contact Phone Number -->
                    <td>{{ $employee->email ?? '-' }}</td>
                    <td>{{ $employee->phone ?? '-' }}</td>
                    
                    <!-- Actions Links (View, Edit, Delete) -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <a href="{{ route('employees.show', $employee->id) }}" class="action-link text-info">View</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="action-link text-warning">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Delete this employee?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 action-link text-danger border-0 align-baseline">Delete</button>
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
        {{ $employees->appends(request()->query())->links() }}
    </div>
</div>
@endsection