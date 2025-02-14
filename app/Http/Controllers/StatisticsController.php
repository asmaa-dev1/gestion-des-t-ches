<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $projects = $user->projects();

        $statistics = [
            'total_projects' => $projects->count(),
            'completed_projects' => $projects->where('status', 'Completed')->count(),
            'tasks_by_priority' => $this->getTasksByPriority(),
            'tasks_by_status' => $this->getTasksByStatus(),
            'completion_trend' => $this->getCompletionTrend(),
            'category_distribution' => $this->getCategoryDistribution(),
        ];

        return view('statistics.index', compact('statistics'));
    }

    private function getTasksByPriority()
    {
        return Task::whereIn('project_id', auth()->user()->projects->pluck('id'))
            ->selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->get();
    }

    private function getTasksByStatus()
    {
        return Task::whereIn('project_id', auth()->user()->projects->pluck('id'))
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
    }

    private function getCompletionTrend()
    {
        return Task::whereIn('project_id', auth()->user()->projects->pluck('id'))
            ->where('status', 'Completed')
            ->where('updated_at', '>=', now()->subMonths(6))
            ->selectRaw('DATE_FORMAT(updated_at, "%Y-%m") as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    private function getCategoryDistribution()
    {
        return Project::whereIn('id', auth()->user()->projects->pluck('id'))
            ->with('category')
            ->selectRaw('category_id, count(*) as count')
            ->groupBy('category_id')
            ->get();
    }
}