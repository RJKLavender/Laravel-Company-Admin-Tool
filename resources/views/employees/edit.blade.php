@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Employee: {{ $employee->first_name }}</h1>
    </div>

    <!-- Error Alert Block -->
    @if ($errors->any())
        <div class="bg-red-50 text-red-800 p-4 rounded-md border border-red-200 mb-6 text-sm">
            <div class="font-semibold mb-1">Please correct the errors below:</div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT') <!-- Crucial directive for routing to the update controller method -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}" 
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('first_name') border-red-500 @enderror">
                @error('first_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}" 
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('last_name') border-red-500 @enderror">
                @error('last_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
            <select name="company_id" id="company_id" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('company_id') border-red-500 @enderror">
                <option value="">Select a Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" 
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" 
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
            @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('employees.index') }}" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Update Employee</button>
        </div>
    </form>
</div>
@endsection