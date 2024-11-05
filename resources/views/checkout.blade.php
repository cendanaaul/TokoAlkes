@extends('layout.main')

@section('container')
    <div class="text-center mt-10 mb-5">
        <h1 class="text-3xl font-bold">{{ $header }} Page</h1>
        @if (Session::has('success'))
            <div class="alert alert-success mb-5 mt-5 p-3 bg-green-500 text-white rounded-lg shadow-md">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <div class="container mx-auto mt-8 mb-8">
        <form action="{{ route('postcheckout', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-lg rounded-lg p-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex justify-center">
                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->title }}"
                            class="rounded-lg object-fit w-60 h-60">
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
                        <h6 class="text-lg text-red-500">Rp. {{ $item->totalprice }}</h6>
                        <hr>
                        <div class="font-medium">Metode Pembayaran</div>
                        <select name="pembayaran" id="">
                            <option value="Cod">COD</option>
                            <option value="Debit">Debit</option>
                        </select>
                        <button
                            class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300"
                            type="submit">Pesan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
