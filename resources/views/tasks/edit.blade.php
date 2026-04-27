<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Task</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-12">
        <!-- Note the method('PUT') - Laravel requires this for updates -->
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT') 
            
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">{{ old('description', $task->description) }}</textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('tasks.index') }}" class="text-gray-600 mr-4">Cancel</a>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update Task</button>
            </div>
        </form>
    </div>
</x-app-layout>