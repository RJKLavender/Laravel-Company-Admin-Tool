@extends('layouts.app')
@section('title', $employee->first_name . $employee->last_name . 'Employee Profile')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Employee Profile</h1>
        <a href="{{ route('employees.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">&larr; Back to Employees</a>
    </div>

    <!-- Profile Details Card Grid -->
    <div class="border border-gray-200 rounded-lg p-6 mb-6 bg-gray-50">
        <h2 class="text-xl font-semibold text-gray-900 border-b pb-3 mb-4">
            {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
            <div>
                <span class="block text-sm font-semibold text-gray-500 uppercase tracking-wider">First Name</span>
                <span class="text-gray-900 font-medium">{{ $employee->first_name }}</span>
            </div>
            <div>
                <span class="block text-sm font-semibold text-gray-500 uppercase tracking-wider">Last Name</span>
                <span class="text-gray-900 font-medium">{{ $employee->last_name }}</span>
            </div>
            <div>
                <span class="block text-sm font-semibold text-gray-500 uppercase tracking-wider">Email Address</span>
                <span class="text-gray-600">{{ $employee->email ?? '-' }}</span>
            </div>
            <div>
                <span class="block text-sm font-semibold text-gray-500 uppercase tracking-wider">Phone Number</span>
                <span class="text-gray-600">{{ $employee->phone ?? '-' }}</span>
            </div>
            <div class="md:col-span-2">
                <span class="block text-sm font-semibold text-gray-500 uppercase tracking-wider">Assigned Company</span>
                @if($employee->company)
                    <a href="{{ route('companies.show', $employee->company->id) }}" class="text-blue-600 hover:underline font-semibold">
                        {{ $employee->company->name }}
                    </a>
                @else
                    <span class="text-gray-400 italic">None</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Management Controls Matching Index Style -->
    <div class="flex space-x-3 border-t pt-4">
        <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 font-semibold hover:underline inline-flex items-center">
            Edit Details
        </a>
        <span class="text-gray-300">|</span>
        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this employee?');">
            @csrf 
            @method('DELETE')
            <button type="submit" class="text-red-600 font-semibold hover:underline">
                Delete Employee
            </button>
        </form>
    </div>
</div>
@endsection