<?php
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Artisan::command('tasks:summary', function () {
    $this->info('Tasks for Today - database summary');
    $this->line('Today: '.today()->toDateString().' ('.config('app.timezone').')');
    $tasks = Task::orderBy('task_date')->orderBy('id')->get();
    $this->table(['Date', 'Tasks'], $tasks->groupBy(fn ($task) => $task->task_date->toDateString())
        ->map(fn ($group, $date) => [$date, $group->count()])->values()->all());
    $this->line('Total tasks: '.$tasks->count());
    $this->line('Tasks today: '.Task::forDate(today())->count());
    $this->line('Distinct task dates: '.$tasks->pluck('task_date')->map->toDateString()->unique()->count());
    $this->line('User records: '.User::count());
})->purpose('Show task dates and record counts for assessment verification');
