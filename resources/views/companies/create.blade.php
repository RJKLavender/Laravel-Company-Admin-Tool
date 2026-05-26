@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Add New Company</h1>
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

    <!-- Note the enctype attribute for file handling -->
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
            <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="https://example.com"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('website') border-red-500 @enderror">
            @error('website') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
            <input type="file" name="logo" id="logo" 
                   class="w-full border p-1 rounded bg-gray-50 focus:ring-2 focus:ring-blue-500 @error('logo') border-red-500 @enderror">
            <p class="text-gray-400 text-xs mt-1">Minimum dimensions: 100x100 pixels.</p>
            @error('logo') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('companies.index') }}" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save Company</button>
        </div>
    </form>
</div>
@endsection