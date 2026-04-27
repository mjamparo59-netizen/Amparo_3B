<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight italic">
                My Task CRUD
            </h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                + Add New Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Display Success/Status Messages -->
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2">
                            <th class="py-3 px-2 text-gray-700">Title</th>
                            <th class="py-3 px-2 text-gray-700">Description</th>
                            <th class="py-3 px-2 text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="py-4 px-2 font-medium">{{ $task->title }}</td>
                            <td class="py-4 px-2 text-gray-600">{{ $task->description }}</td>
                            <td class="py-4 px-2">
                                <!-- Edit Link -->
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-3">
                                    Edit
                                </a>
                                
                                <!-- Soft Delete Form -->
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 font-semibold"
                                            onclick="return confirm('Are you sure you want to soft-delete this task?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-500 italic">
                                No tasks found. Start by adding one!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- The "View Trash" button was removed from here -->
            </div>
        </div>
    </div>
</x-app-layout>