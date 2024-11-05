@extends('layout.main')

@section('container')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg h-[60vh] rounded-lg mt-6">
    <div class="flex items-center">
        <!-- Avatar -->
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=128"
            alt="{{ $user->name }}" class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-lg mr-6">

        <!-- Informasi Pengguna -->
        <div>
            <h2 class="text-3xl font-semibold">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="mt-2 text-gray-500">Bergabung sejak: {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Detail Akun</h3>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <p><strong>Kota :</strong> {{ $user->city }}</p>
            <p><strong>Nomor Telpon:</strong> {{ $user->notel }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $user->formatted_birth}}</p>
        </div>
    </div>

</div>
@endsection