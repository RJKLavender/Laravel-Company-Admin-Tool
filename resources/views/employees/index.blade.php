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
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col" class="text-center">Actions</th>
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
                            <!-- Delete Method for Delete Link with Warning Box for Confirmation -->
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
        {{ $employees->links() }}
    </div>
</div>
@endsection