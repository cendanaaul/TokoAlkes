@extends('layout.main')

@section('container')
    <div class="text-center mt-10 mb-5">
        <h1 class="text-3xl font-bold">Page {{ $header }}</h1>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success mb-5 mt-5 p-3 bg-green-500 text-white rounded-lg shadow-md">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="container mx-auto mt-5 mb-5">
        @foreach ($product as $item)
            <div class="bg-white shadow-md rounded-lg p-5 mb-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex justify-center">
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->title }}"
                            class="rounded-lg object-fit w-48 h-48">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h4 class="text-xl font-semibold text-center">{{ $item->product->title }}</h4>
                        <hr class="my-2">
                        <label class="font-medium">Qty Product:</label>
                        <input type="number" value="{{ $item->qty }}" class="form-control mb-2 border rounded-md p-2"
                            disabled>
                        <hr>
                        <div class="font-medium">Product Price:</div>
                        <h6 class="text-lg text-red-500">Rp. {{ $item->product->price }}</h6>
                        <div class="font-medium">Total Price:</div>
                        <h6 class="text-lg text-red-500">Rp. {{ $item->transaksi->totalprice }}</h6>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="flex flex-row items-center space-x-4 justify-center mb-4">
                            <div class="flex items-center space-x-2">
                                <h6 class="text-lg font-semibold inline-flex items-center space-x-1">
                                    <span class="badge bg-green-500 text-white p-2 rounded-lg shadow-lg flex items-center">
                                        <svg class="w-5 h-5 text-white mr-1" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $item->transaksi->pembayaran }}
                                    </span>
                                </h6>
                            </div>

                            <div class="flex items-center space-x-2">
                                <h6 class="text-lg font-semibold inline-flex items-center space-x-1">
                                    <span
                                        class="badge p-2 rounded-lg shadow-lg flex items-center
                                         {{ $item->transaksi->status === 'Diterima' ? 'bg-blue-500 text-white' : 'bg-red-500 text-white' }}">
                                        <svg class="w-5 h-5 text-white mr-1" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $item->transaksi->status }}
                                    </span>
                                </h6>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="font-medium">Invoice:</div>
                            <h6 class="text-lg badge bg-green-600 text-white">{{ $item->transaksi->code }}</h6>
                        </div>
                        <div>
                            <div class="font-medium mb-2">Detail Invoice:</div>
                            <a href="{{ route('pdf', $item->id) }}"
                                class="btn btn-primary bg-blue-600 text-white hover:bg-blue-700 rounded-lg px-4 py-2 transition duration-300">PDF</a>
                        </div>
                    </div>
                </div>
                @if (Auth::check())
                    @if ($item->transaksi->status === 'Diterima')
                        <form action="{{ route('reviews.store', $item->product->id) }}" method="POST"
                            class="bg-white p-6 rounded-lg shadow-md">
                            @csrf
                            <h3 class="text-xl font-semibold mb-4">Tinggalkan Ulasan</h3>

                            <!-- Rating -->
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                                <input type="number" name="rating" id="rating" min="1" max="5" required
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                            </div>

                            <!-- Comment -->
                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">Komentar</label>
                                <textarea name="comment" id="comment" rows="4"
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                                    placeholder="Tulis komentar Anda (opsional)"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                                Kirim Ulasan
                            </button>
                        </form>
                    @else
                        <p class="text-center text-gray-500 mt-4">
                            hanya bisa memberikan ulasan jika transaksi sudah diterima
                        </p>
                    @endif
                @else
                    <p class="text-center text-gray-500 mt-4">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> untuk memberikan
                        ulasan.
                    </p>
                @endif


            </div>
        @endforeach
    </div>
@endsection
