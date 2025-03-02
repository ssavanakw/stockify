@extends('layouts.main')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Create Supplier</h2>

        <form action="{{ route('suppliers.store') }}" method="POST" class="bg-gray-50 p-4 rounded-lg shadow-md">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="font-semibold">Supplier Name</label>
                    <input type="text" id="name" name="name" class="border rounded-lg p-2 w-full" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="font-semibold">Email</label>
                    <input type="email" id="email" name="email" class="border rounded-lg p-2 w-full" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="phone" class="font-semibold">Phone</label>
                    <input type="text" id="phone" name="phone" class="border rounded-lg p-2 w-full">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="address" class="font-semibold">Address</label>
                    <textarea id="address" name="address" class="border rounded-lg p-2 w-full h-20"></textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <a href="{{ route('suppliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray transition mr-2">Cancel</a>
                <button type="submit" class="bg-blue text-white px-4 py-2 rounded-lg hover bg-blue transition">
                    Save Supplier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
