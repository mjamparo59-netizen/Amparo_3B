@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#1e1e1e] flex justify-center p-4">
    <div class="w-full max-w-md">
        
        <div class="flex justify-between items-center mt-6 mb-8">
            <h1 class="text-white text-3xl font-bold">Hello, {{ Auth::user()->name }}</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-gray-200 text-gray-800 px-3 py-1 rounded text-sm font-semibold hover:bg-white transition">
                    Logout
                </button>
            </form>
        </div>

        <div class="bg-[#333b47] p-6 rounded-2xl shadow-xl mb-6 border border-gray-700/30">
            <form method="POST" action="/notes" class="space-y-4">
                @csrf
                <input name="title" placeholder="Note Title" 
                    class="w-full bg-[#4a5568] border-none text-white placeholder-gray-400 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                
                <textarea name="content" placeholder="Note Content" rows="3"
                    class="w-full bg-[#4a5568] border-none text-white placeholder-gray-400 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                
                <button class="w-full bg-[#2563eb] hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition duration-200 uppercase tracking-wide">
                    Add Note
                </button>
            </form>
        </div>

        <div class="space-y-4">
            @foreach($notes as $note)
                <div class="bg-[#333b47] p-5 rounded-2xl shadow-lg border border-gray-700/30">
                    <h2 class="text-white text-xl font-bold mb-1">{{ $note->title }}</h2>
                    <p class="text-gray-300 mb-4">{{ $note->content }}</p>

                    <form method="POST" action="/notes/{{ $note->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="w-full bg-[#ef4444] hover:bg-red-600 text-white font-bold py-2 rounded-lg transition duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <a href="{{ route('profile') }}" class="fixed bottom-6 right-6 bg-blue-600 text-white p-4 rounded-full shadow-2xl z-50 hover:scale-110 transition-transform"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </a>
    </div>
</div>
@endsection