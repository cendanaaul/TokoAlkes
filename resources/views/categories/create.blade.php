@extends('layout.main')

@section('container')
    <div class="container mx-auto mt-5 p-5 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Add New Category</h2>

        <form action="{{ route('category.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="desk" class="block text-sm font-medium text-gray-700">Category deskciption</label>
                <input type="text" name="desk"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500"
                    required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                Category</button>
        </form>
    </div>
@endsection
