<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'nullable|date'
        ]);

        $project->tasks()->create($validated);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Tâche créée avec succès.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'nullable|date'
        ]);

        $task->update($validated);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Project $project, Task $task)
    {
        
        $task->delete();

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Tâche supprimée avec succès.');
    }

    public function toggle(Project $project, Task $task)
    {
        
        $task->update([
            'status' => $task->status === 'Completed' ? 'Pending' : 'Completed'
        ]);

        return back()->with('success', 
            $task->status === 'Completed' ? 'Tâche marquée comme terminée.' : 'Tâche marquée comme à faire.'
        );
    }

    private function getPriorityClasses($priority)
    {
        return match($priority) {
            'high' => 'bg-red-100 text-red-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}