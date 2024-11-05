@extends('layout.main')

@section('container')

<div class="text-center mt-10 mb-8">
    <h1 class="text-3xl font-bold">Page {{ $header }}</h1>
    @if (Session::has('success'))
    <div class="alert alert-success mb-5 mt-5 p-3 bg-green-500 text-white rounded-lg shadow-md">
        {{ Session::get('success') }}
    </div>
    @endif
</div>

<div class="container flex justify-items-center mx-2 gap-6 mt-8 min-h-[45vh] mb-8">
    @foreach ($product as $item)
    <div class="bg-white shadow-lg max-w-2xl  rounded-lg p-5 transition-transform transform hover:scale-105">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex justify-center">
                <img src="{{ $item->product->image }}" alt="{{ $item->product->title }}"
                    class="rounded-lg object-fit w-48 h-48">
            </div>
            <div class="flex flex-col justify-center">
                <h4 class="text-xl font-semibold text-center">{{ $item->product->title }}</h4>
                <hr class="my-2">
                <label for="" class="font-medium">Qty Product:</label>
                <input type="number" value="{{ $item->qty }}" class="form-control mb-2 border rounded-md p-2" disabled>
                <hr>
                <div class="font-medium">Product Price:</div>
                <h6 class="text-lg text-red-500">Rp. {{ $item->product->price }}</h6>
                <div class="font-medium">Total Price:</div>
                <h6 class="text-lg text-red-500">Rp. {{ $item->totalprice }}</h6>
            </div>
            <div class="flex flex-col justify-center">
                <form action="{{ route('deletecart', $item->id) }}" method="post">
                    @csrf
                    <div class="flex justify-between flex-col gap-3">
                        <a href="{{ route('checkout', $item->id) }}"
                            class="btn bg-blue-600 text-white font-bold py-2 px-4 text-center rounded-lg hover:bg-blue-700 transition duration-300">Checkout</a>
                        <button
                            class="bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300"
                            type="submit">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection