<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->title }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline text-sm">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Info del proyecto --}}
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <p class="text-gray-600">{{ $project->description }}</p>
            </div>

            {{-- Tareas --}}
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Tareas</h3>
                <a href="{{ route('tasks.create', $project) }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded text-sm">
                    + Nueva Tarea
                </a>
            </div>

            @if($project->tasks->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                No hay tareas aún. ¡Agrega una!
            </div>
            @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($project->tasks as $task)
                <div class="bg-white rounded-lg shadow p-4">
                    <h4 class="font-semibold text-gray-800">{{ $task->title }}</h4>
                    <p class="text-gray-500 text-sm mt-1">{{ $task->description }}</p>
                    <span class="text-xs mt-2 inline-block px-2 py-1 rounded bg-gray-100 text-gray-600">
                        {{ $task->status }}
                    </span>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('tasks.edit', [$project, $task]) }}" class="text-yellow-500 hover:underline text-sm">Editar</a>
                        <form action="{{ route('tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('¿Eliminar tarea?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>