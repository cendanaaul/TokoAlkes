@extends('layout.main')

@section('container')
<div class="container mx-auto mt-10 mb-10" style="height: 100vh">
    <div class="flex justify-center items-center h-full">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            @if (Session::has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ Session::get('error') }}
            </div>
            @endif
            @if (Session::has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ Session::get('success') }}
            </div>
            @endif
            <form action="/login" method="POST">
                @csrf
                <div class="text-center mb-6">
                    <img src="{{ asset('/asset/image/logo.jpg') }}" alt="Logo"
                        class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h2 class="text-2xl font-semibold">Selamat Datang di <br>Toko Alat Kesehatan</h2>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email"
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password"
                        class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Password" required>
                </div>
                <div class="mb-6">
                    <button type="submit"
                        class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full hover:bg-blue-700 transition duration-300">Login</button>
                </div>
                <small class="text-center block">You don't have any account? <a href="/register"
                        class="text-blue-600 hover:underline">Register</a></small>
            </form>
        </div>
    </div>
</div>
@endsection