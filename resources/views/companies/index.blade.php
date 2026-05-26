@extends('layouts.app')

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
                <th class="border p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr class="hover:bg-gray-50">
                <td class="border p-3">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="w-12 h-12 object-cover rounded">
                    @else
                        <span class="text-gray-400 text-sm">No Logo</span>
                    @endif
                </td>
                <td class="border p-3 font-semibold">{{ $company->name }}</td>
                <td class="border p-3 text-gray-600">{{ $company->email ?? '-' }}</td>
                <td class="border p-3 text-blue-600"><a href="{{ $company->website }}" target="_blank">{{ $company->website ?? '-' }}</a></td>
                <td class="border p-3 text-center space-x-2">
                    <a href="{{ route('companies.edit', $company->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this company?');">
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