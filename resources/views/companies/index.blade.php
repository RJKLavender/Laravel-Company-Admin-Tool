@extends('layouts.app')
@section('title', 'List of Companies')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Companies</h1>
        <a href="{{ route('companies.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Company</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-3 text-left">Logo</th>
                <th class="border p-3 text-left">Name</th>
                <th class="border p-3 text-left">Email</th>
                <th class="border p-3 text-left">Website</th>
                <th class="border p-3 text-center">Employees</th>
                <th class="border p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr class="hover:bg-gray-50">
                <td class="border p-3">
                    @if($company->logo)
                        <!-- Logo links directly to the company profile view -->
                        <a href="{{ route('companies.show', $company->id) }}">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" width="100" height="100" class="w-12 h-12 object-cover rounded border hover:opacity-80 transition">
                        </a>
                    @else
                        <span class="text-gray-400 text-sm">No Logo</span>
                    @endif
                </td>
                <td class="border p-3 font-semibold">
                    <!-- Company Name links directly to the company profile view -->
                    <a href="{{ route('companies.show', $company->id) }}" class="text-blue-600 hover:underline">
                        {{ $company->name }}
                    </a>
                </td>
                <td class="border p-3 text-gray-600">{{ $company->email ?? '-' }}</td>
                <td class="border p-3 text-blue-600">
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="hover:underline">{{ $company->website }}</a>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                
                <!-- Real-time Employee Count Column -->
                <td class="border p-3 text-center font-bold text-gray-700">
                    {{ $company->employees_count ?? $company->employees->count() }}
                </td>

                <td class="border p-3 text-center space-x-2">
                    <!-- Added a direct view profile action link -->
                    <a href="{{ route('companies.show', $company->id) }}" class="text-blue-600 hover:underline">View</a>
                    <a href="{{ route('companies.edit', $company->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this company? All employees will be unassigned.');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $companies->links() }}</div>
</div>
@endsection