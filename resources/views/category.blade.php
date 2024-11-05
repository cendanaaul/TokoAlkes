@extends('layout.main')

@section('container')
    <h1 class="text-3xl font-bold text-center mt-10">Product by Category: {{ $header }}</h1>

    <div class="container mx-auto mt-8 mb-10">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($categories as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <a href="#"
                            class="inline-block bg-yellow-500 text-white text-sm font-semibold px-2 py-1 rounded-full mb-2">{{ $item->category->name }}</a>
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $item->title }}</h2>
                        <p class="text-xl text-red-600 font-bold mb-2">Rp. {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                        <a href="/product/{{ $item->id }}"
                            class="block text-center bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition duration-200">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
