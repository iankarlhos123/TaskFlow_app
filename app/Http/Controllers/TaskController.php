<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('pages.tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en_progreso,completada',
            'due_date' => 'nullable|date',
        ]);

        $project->tasks()->create($request->only('title', 'description', 'status', 'due_date'));

        return redirect()->route('projects.show', $project)->with('success', 'Tarea creada!');
    }

    public function edit(Project $project, Task $task)
    {
        return view('pages.tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendiente,en_progreso,completada',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->only('title', 'description', 'status', 'due_date'));

        return redirect()->route('projects.show', $project)->with('success', 'Tarea actualizada!');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.show', $project)->with('success', 'Tarea eliminada!');
    }
}
