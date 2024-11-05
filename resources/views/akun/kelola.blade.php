@extends('layout.main')

@section('container')
    <div class="overflow-x-auto mt-5 bg-white shadow-md rounded-lg">
        <!-- Formulir Pencarian Pengguna -->
        <form action="{{ route('kelola.show') }}" method="GET" class="mb-5">
            <div class="flex">
                <input type="text" name="search" placeholder="Cari pengguna..." class="border rounded-l-lg p-2 w-full"
                    value="{{ request()->get('search') }}">
                <button type="submit" class="bg-blue-500 text-white rounded-r-lg px-4">Cari</button>
            </div>
        </form>

        <!-- Tabel Pengguna -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        Bergabung</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <!-- Nama -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                        <!-- Email -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                        <!-- Role -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($user->role) }}</td>
                        <!-- Tanggal Bergabung -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Kontrol Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
