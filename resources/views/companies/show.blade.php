@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Company Profile</h1>
        <a href="{{ route('companies.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">&larr; Back to Companies</a>
    </div>

    <!-- Company Meta Details Block -->
    <div class="border border-gray-200 rounded-lg p-6 mb-8 bg-gray-50 flex flex-col md:flex-row items-start md:items-center gap-6">
        <div class="flex-shrink-0">
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" width="100" height="100" class="w-24 h-24 object-cover rounded border bg-white p-1">
            @else
                <div class="w-24 h-24 bg-gray-200 text-gray-400 rounded border flex items-center justify-center text-xs font-medium">
                    No Logo
                </div>
            @endif
        </div>

        <div class="flex-grow space-y-2">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $company->name }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 text-sm">
                <p class="text-gray-600"><span class="font-semibold text-gray-500">Email:</span> {{ $company->email ?? '-' }}</p>
                <p class="text-gray-600">
                    <span class="font-semibold text-gray-500">Website:</span> 
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $company->website }}</a>
                    @else
                        -
                    @endif
                </p>
                <p class="text-gray-600 sm:col-span-2 mt-1">
                    <span class="font-semibold text-gray-500">Total Headcount:</span> 
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $company->employees->count() }} Registered</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Employee Roster Table Built to Match Index Format -->
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Assigned Employee Roster</h3>
        
        @if($company->employees->isEmpty())
            <div class="border p-4 text-center text-gray-400 italic rounded">
                No employees are currently assigned to this company.
            </div>
        @else
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-3 text-left">First Name</th>
                        <th class="border p-3 text-left">Last Name</th>
                        <th class="border p-3 text-left">Email</th>
                        <th class="border p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->employees as $worker)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-3 font-semibold">
                            <a href="{{ route('employees.show', $worker->id) }}" class="text-blue-600 hover:underline">
                                {{ $worker->first_name }}
                            </a>
                        </td>
                        <td class="border p-3 font-semibold">
                            <a href="{{ route('employees.show', $worker->id) }}" class="text-blue-600 hover:underline">
                                {{ $worker->last_name }}
                            </a>
                        </td>
                        <td class="border p-3 text-gray-600">{{ $worker->email ?? '-' }}</td>
                        <td class="border p-3 text-center">
                            <!-- Detach action structured using the updated index row style -->
                            <form action="{{ route('employees.update', $worker->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Remove this employee from the company roster?');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="first_name" value="{{ $worker->first_name }}">
                                <input type="hidden" name="last_name" value="{{ $worker->last_name }}">
                                <input type="hidden" name="company_id" value="">
                                <button type="submit" class="text-orange-600 hover:underline font-medium">
                                    Remove Staff
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Company Level Controls Matching Index Style -->
    <div class="flex space-x-3 border-t pt-4">
        <a href="{{ route('companies.edit', $company->id) }}" class="text-yellow-600 font-semibold hover:underline inline-flex items-center">
            Edit Company
        </a>
        <span class="text-gray-300">|</span>
        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this company? All employees will be unassigned.');">
            @csrf 
            @method('DELETE')
            <button type="submit" class="text-red-600 font-semibold hover:underline">
                Delete Company
            </button>
        </form>
    </div>
</div>
@endsection