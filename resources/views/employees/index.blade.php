@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Employees</h1>
        <a href="{{ route('employees.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Add Employee</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-3 text-left">First Name</th>
                <th class="border p-3 text-left">Last Name</th>
                <th class="border p-3 text-left">Company</th>
                <th class="border p-3 text-left">Email</th>
                <th class="border p-3 text-left">Phone</th>
                <th class="border p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr class="hover:bg-gray-50">
                <!-- Clickable name leads directly to the employee profile view -->
                <td class="border p-3 font-semibold">
                    <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">
                        {{ $employee->first_name }}
                    </a>
                </td>
                <td class="border p-3 font-semibold">
                    <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">
                        {{ $employee->last_name }}
                    </a>
                </td>
                <!-- Clickable company name leads directly to the company profile view -->
                <td class="border p-3 text-gray-700">
                    @if($employee->company)
                        <a href="{{ route('companies.show', $employee->company->id) }}" class="text-blue-600 hover:underline font-medium">
                            {{ $employee->company->name }}
                        </a>
                    @else
                        <span class="text-gray-400 italic">None</span>
                    @endif
                </td>
                <td class="border p-3 text-gray-600">{{ $employee->email ?? '-' }}</td>
                <td class="border p-3 text-gray-600">{{ $employee->phone ?? '-' }}</td>
                <td class="border p-3 text-center space-x-2">
                    <!-- Added a direct view action link -->
                    <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">View</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this employee?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $employees->links() }}</div>
</div>
@endsection