@extends('layout.main')

@section('container')
<div class="container mx-auto mt-10 mb-10" style="height: 100vh">
    <div class="flex justify-center items-center h-full">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">
            <form action="/register" method="POST">
                @csrf
                <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Username</label>
                        <input type="text" name="name"
                            class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="Masukkan Username">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" name="password"
                            class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="Masukkan Password">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email"
                            class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="Masukkan Email">
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-medium mb-2">Date of Birth</label>
                        <input type="date" name="birth"
                            class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                        <input type="text" name="city"
                            class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="Masukkan Alamat">
                    </div>
                    <div class="mb-4">
                        <label for="contact" class="block text-gray-700 font-medium mb-2">Contact</label>
                        <input type="text" name="notel"
                            class="border border-gray-300 rounded-lg w-full p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="Masukkan Nomor Kontak">
                    </div>
                </div>

                <div class="mb-6">
                    <button type="submit"
                        class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full hover:bg-blue-700 transition duration-300">Register</button>
                </div>
                <small class="text-center block">You have an account? <a href="/login"
                        class="text-blue-600 hover:underline">Login</a></small>
            </form>
        </div>
    </div>
</div>
@endsection