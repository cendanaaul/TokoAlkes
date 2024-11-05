@extends('layout.main')

@section('container')
<h1 class="mt-5 text-center text-3xl font-bold">All {{ $header }}</h1>
<div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-5 mt-5">
        @foreach ($categories as $item)
        <div class="card bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-48 object-fit">
            <div class="p-4">
                <a href="/category/{{ $item->category->id }}"
                    class="inline-block bg-yellow-300 text-gray-800 text-sm font-semibold rounded-full px-3 py-1 mb-2">{{
                    $item->category->name }}</a>
                <h5 class="text-lg font-semibold">{{ $item->title }}</h5>
                <p class="text-gray-700 text-base">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                <a href="/product/{{ $item->id }}"
                    class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700">Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection