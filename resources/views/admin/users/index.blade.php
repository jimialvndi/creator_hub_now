@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Manajemen Users</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
        + Tambah User
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4">Nama</th>
                <th class="p-4">Email</th>
                <th class="p-4">Role</th>
                <th class="p-4">Bergabung</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4 font-bold">{{ $user->name }}</td>
                <td class="p-4">{{ $user->email }}</td>
                <td class="p-4">
                    <span class="px-2 py-1 rounded text-xs font-bold 
                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ strtoupper($user->role) }}
                    </span>
                </td>
                <td class="p-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                <td class="p-4 flex gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $users->links() }}
    </div>
</div>
@endsection