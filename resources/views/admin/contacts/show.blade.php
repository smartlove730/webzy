@extends('admin.layouts.app')

@section('title', 'View Message')
@section('page-title', 'View Message')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:underline">← Back to messages</a>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">{{ $message->subject }}</h2>
        <p class="mb-2"><strong>Name:</strong> {{ $message->name }}</p>
        <p class="mb-2"><strong>Email:</strong> {{ $message->email }}</p>
        <p class="mb-2"><strong>Received:</strong> {{ $message->created_at->format('d M Y h:i A') }}</p>
        <hr class="my-4">
        <p class="whitespace-pre-line">{{ $message->message }}</p>
        <div class="mt-6">
            <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Message</button>
            </form>
        </div>
    </div>
@endsection