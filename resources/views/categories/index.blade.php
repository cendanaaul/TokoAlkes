@extends('layout.main')

@section('container')
    <div class="container mx-auto mt-5 p-5 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Categories</h2>

        @if (Session::has('success'))
            <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-3">
            <a href="/categories/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                New Category</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Deskcription</th>
                    <th class="py-2 px-4 border-b text-right">Actions</th> <!-- Align text to the right -->
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->desk }}</td>
                        <td class="py-2 px-4 border-b text-right">
                            <!-- Align actions to the right -->
                            <a href="{{ route('category.edit', $category->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                            <form action="{{ route('category.delete', $category->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2"
                                    onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
