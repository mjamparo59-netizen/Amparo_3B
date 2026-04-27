<x-app-layout>
    <div class="max-w-2xl mx-auto py-12">
        <form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label>Title</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded" value="{{ old('title') }}">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label>Description</label>
                <textarea name="description" class="w-full border-gray-300 rounded">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Save Task</button>
        </form>
    </div>
</x-app-layout>