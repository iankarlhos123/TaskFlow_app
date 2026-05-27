<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Tarea — {{ $project->title }}
            </h2>
            <a href="{{ route('projects.show', $project) }}" class="text-gray-500 hover:underline text-sm">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('tasks.update', [$project, $task]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Título</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Descripción</label>
                        <textarea name="description" rows="3"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Estado</label>
                        <select name="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                            <option value="pendiente" {{ old('status', $task->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_progreso" {{ old('status', $task->status) == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                            <option value="completada" {{ old('status', $task->status) == 'completada' ? 'selected' : '' }}>Completada</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Fecha límite</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('projects.show', $project) }}" class="text-gray-500 hover:underline">Cancelar</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                            Actualizar Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>