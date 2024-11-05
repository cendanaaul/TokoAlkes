@extends('layout.main')

@section('container')
    <div class="container mx-auto mt-10 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Gambar Produk -->
            <div class="flex justify-center items-center">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset($item->image) }}" alt="{{ "$item->title" }}" class="w-full h-64 object-cover">
                </div>
            </div>

            <!-- Detail Produk dan Form Keranjang -->
            <div class="flex justify-center items-center">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('postcart', $item->id) }}" method="POST">
                        @csrf
                        <h4 class="text-2xl font-semibold text-center text-gray-800 mb-2">{{ $item->title }}</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="text-lg text-gray-600 mb-1">Price:</div>
                        <h5 class="text-3xl text-red-600 font-bold text-center mb-4">Rp.
                            {{ number_format($item->price, 0, ',', '.') }}</h5>
                        <p class="text-gray-700 mb-4">{{ $item->body }}</p>
                        <label for="total" class="block text-gray-700 mb-1">Total Qty:</label>
                        <input type="number" name="total" required
                            class="border rounded-lg p-2 mb-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan jumlah">
                        <div class="flex justify-between">
                            <button type="submit"
                                class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition duration-200">Cart</button>
                            <a href="/products"
                                class="bg-red-600 text-white rounded-lg px-4 py-2 hover:bg-red-700 transition duration-200">Back</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kategori Produk -->
            <div class="flex justify-center items-center">
                <div
                    class="relative flex flex-col items-center shadow-lg rounded-lg bg-gradient-to-r from-purple-100 to-blue-100 p-6 group hover:shadow-xl transition duration-300">
                    <!-- Body Card -->
                    <div class="text-center">
                        <!-- Nama Kategori -->
                        <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $item->category->name }}</h2>

                        <!-- Deskripsi Singkat (Opsional) -->
                        <p class="text-sm text-gray-600 mb-6">
                            {{ $item->category->desk }}
                        </p>

                        <!-- Tombol Detail -->
                        <a href="/category/{{ $item->category->id }}"
                            class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out transform hover:-translate-y-1">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ currentIndex: 0 }" class="w-full mx-auto bg-white shadow-md mx-5 rounded-lg p-6 mb-6 relative">
        <h3 class="text-xl font-semibold mb-4">Ulasan Produk</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Loop untuk setiap ulasan, hanya menampilkan tiga ulasan sesuai indeks -->
            @isset($reviews)
                @foreach ($reviews as $index => $review)
                    <div x-show="currentIndex <= {{ $index }} && {{ $index }} < currentIndex + 3"
                        class="bg-gray-100 p-4 rounded-lg shadow">
                        <div class="flex items-center mb-2">
                            <!-- Nama Pengguna -->
                            <span class="font-medium text-gray-900">{{ $review->user->name }}</span>
                            <!-- Rating -->
                            <div class="ml-4 flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.945a1 1 0 00.95.69h4.149c.969 0 1.371 1.24.588 1.81l-3.358 2.424a1 1 0 00-.364 1.118l1.286 3.945c.3.921-.755 1.688-1.54 1.118l-3.358-2.424a1 1 0 00-1.176 0l-3.358 2.424c-.784.57-1.838-.197-1.54-1.118l1.286-3.945a1 1 0 00-.364-1.118L2.317 9.372c-.783-.57-.38-1.81.588-1.81h4.149a1 1 0 00.95-.69l1.286-3.945z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <!-- Tanggal Ulasan -->
                        <p class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</p>
                        <!-- Komentar -->
                        <p class="mt-2 text-gray-700">{{ $review->comment }}</p>
                    </div>
                @endforeach
            @endisset
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center mt-6">
            <button @click="currentIndex = Math.max(currentIndex - 3, 0)"
                class="text-gray-700 hover:text-gray-900 font-semibold px-4 py-2 bg-gray-200 rounded-lg">
                &larr; Sebelumnya
            </button>
            <button @click="currentIndex = Math.min(currentIndex + 3, {{ count($reviews) }} - 3)"
                class="text-gray-700 hover:text-gray-900 font-semibold px-4 py-2 bg-gray-200 rounded-lg">
                Berikutnya &rarr;
            </button>
        </div>
    </div>


@endsection
