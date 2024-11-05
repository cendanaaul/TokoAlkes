@extends('layout.main')

@section('container')
<div class="container mx-auto mt-10 mb-10">
    <form action="{{ route('posttambah') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="max-w-xl mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-800">Tambah Product</h3>
                <hr class="my-4">

                <div class="mb-5">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title Product</label>
                    <input type="text" name="title" required
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan judul produk">
                </div>

                <div class="mb-5">
                    <label for="image" class="block text-gray-700 font-medium mb-2">Image Product</label>
                    <input type="file" name="image" required accept="image/*"
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-5">
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price Product</label>
                    <input type="text" name="price" required
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan harga produk">
                </div>

                <div class="mb-5">
                    <label for="body" class="block text-gray-700 font-medium mb-2">Description Product</label>
                    <input type="text" name="body" required
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan deskripsi produk">
                </div>

                <div class="mb-5">
                    <label for="category" class="block text-gray-700 font-medium mb-2">Category Product</label>
                    <select name="category" required
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Tambah
                        Product</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection