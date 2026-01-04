@extends('admin.layout')

@section('title', 'Manage Kelas Online')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-gray-800">Kelas Online</h1>
  <a href="{{ route('admin.courses.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition flex items-center gap-2">
    <span>+ Buat Kelas Baru</span>
  </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Akses</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Materi</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($courses as $course)
        <tr>
          <td class="px-6 py-4">
            <div class="flex items-center">
              <div class="h-12 w-20 flex-shrink-0 overflow-hidden rounded bg-gray-100">
                @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="h-full w-full object-cover">
                @endif
              </div>
              <div class="ml-4">
                <div class="text-sm font-bold text-gray-900">{{ $course->title }}</div>
                <div class="text-xs text-gray-500">Last updated: {{ $course->updated_at->diffForHumans() }}</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            @if($course->access_level === 'free')
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Free User</span>
            @elseif($course->access_level === 'member')
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Member+</span>
            @else
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pro Only</span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $course->lessons_count }} Video
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end gap-3">
              <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-blue-600 hover:text-blue-900 font-semibold">
                Manage & Edit
              </a>

              <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini? Semua materi video di dalamnya juga akan hilang permanent.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                  Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="px-6 py-8 text-center text-gray-500">
            Belum ada kelas online. Silakan buat baru.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="px-6 py-4 border-t border-gray-200">
    {{ $courses->links() }}
  </div>
</div>
@endsection