@extends('layout.main')

@section('container')
    <div class=" mx-auto mt-10 mb-10">
        <a href="/tambah"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 mb-5">
            Tambah
        </a>

        @if (Session::has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ Session::get('success') }}</span>
            </div>
        @endif


        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <form action="{{ route('kelola') }}" method="GET" class="mb-5">
                <div class="flex">
                    <input type="text" name="search" placeholder="Cari produk..." class="border rounded-l-lg p-2 w-full"
                        value="{{ request()->get('search') }}">
                    <button type="submit" class="bg-blue-500 text-white rounded-r-lg px-4">Cari</button>
                </div>
            </form>
            <table class="min-w-full divide-y divide-gray-200 overflow-hidden" id="example">
                <thead class="bg-gray-50">
                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pendapatan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $item)
                        <tr>

                            <td class="px-6 py-4 whitespace-nowrap"><img src="{{ $item->image }}" class="h-24 w-auto"
                                    alt="">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->sold }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp.{{ number_format($item->profit, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp.
                                {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('deleteproduct', $item->id) }}" method="POST">
                                    @csrf
                                    <div class="flex space-x-2">
                                        <a href="{{ route('edit', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Yakin akan menghapus product?')">Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Kontrol Pagination -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
