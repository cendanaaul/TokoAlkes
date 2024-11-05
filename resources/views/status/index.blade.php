@extends('layout.main')

@section('container')
    <div class="container mx-auto mt-5 p-5 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Status Pengiriman</h2>

        @if (Session::has('success'))
            <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-center">Code</th>
                    <th class="py-2 px-4 border-b text-center">Status</th>
                    <th class="py-2 px-4 border-b text-center">Actions</th> <!-- Align text to the right -->
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b text-center">{{ $item->code }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $item->status }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <form action="{{ route('status.edit', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded"
                                    onclick="return confirm('Apakah Anda yakin?');">Telah Sampai</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
