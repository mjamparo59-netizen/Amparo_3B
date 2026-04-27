@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 flex flex-col items-center justify-center p-4">
    
    <div class="bg-blue-900 text-white p-12 rounded-lg shadow-2xl text-center w-full max-w-sm border border-blue-800">
        <h1 class="text-3xl font-bold mb-2">Mae Jean Amparo</h1>
        <p class="text-blue-200 text-lg">3rd Year BSIT Student</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('notes.index') }}" 
           class="bg-gray-700 text-gray-300 px-6 py-2 rounded text-sm hover:bg-gray-600 transition">
            Back
        </a>
    </div>

</div>
@endsection