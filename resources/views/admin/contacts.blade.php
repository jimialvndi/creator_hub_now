@extends('admin.layout')

@section('title', 'Messages')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Contact Messages</h1>
    <p class="text-gray-600 mt-2">Total: {{ $contacts->total() }} messages</p>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Name</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Email</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Message</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Date</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Status</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="border-b hover:bg-gray-50 {{ $contact->is_read ? 'opacity-60' : '' }}">
                    <td class="py-4 px-6 font-semibold">{{ $contact->name }}</td>
                    <td class="py-4 px-6">{{ $contact->email }}</td>
                    <td class="py-4 px-6">
                        <p class="truncate max-w-md">{{ $contact->message }}</p>
                    </td>
                    <td class="py-4 px-6 text-gray-600 text-sm">{{ $contact->created_at->format('M d, Y') }}</td>
                    <td class="py-4 px-6">
                        @if($contact->is_read)
                        <span class="text-gray-500 text-xs">Read</span>
                        @else
                        <span class="bg-accent text-primary px-3 py-1 rounded-full text-xs font-semibold">New</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        @if(!$contact->is_read)
                        <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-primary hover:text-blue-800 font-semibold text-sm">Mark Read</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-500">No messages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($contacts->hasPages())
    <div class="p-6 border-t">
        {{ $contacts->links() }}
    </div>
    @endif
</div>
@endsection
