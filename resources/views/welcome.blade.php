@extends('layout.main')

@section('container')
    @include('layout.carousel')

    {{-- @if (Session::has('success'))
<div class="alert alert-success show mt-5">{{ Session::get('success') }}</div>
@endif --}}

    <h1 class="text-2xl text-bold ms-4">Alat Kesehatan</h1>

    <div class="grid grid-cols-1 gap-5 justify-items-center md:grid-cols-3 lg:grid-cols-5 mb-10 mt-10">
        @foreach ($categories as $item)
            <div
                class="relative flex flex-col items-center shadow-lg rounded-lg bg-gradient-to-r from-purple-100 to-blue-100 p-6 group hover:shadow-xl transition duration-300">
                <!-- Body Card -->
                <div class="text-center">
                    <!-- Nama Kategori -->
                    <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $item->name }}</h2>

                    <!-- Deskripsi Singkat (Opsional) -->
                    <p class="text-sm text-gray-600  h-[140px]">
                        {{ Str::limit($item->desk, 100) }}
                    </p>

                    <!-- Tombol Detail -->
                    <a href="/category/{{ $item->id }}"
                        class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out transform hover:-translate-y-1">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
