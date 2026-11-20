<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\View\View;
class TaskController extends Controller
{
    public function welcome(): View
    {
        $today = today();
        $tasks = Task::forDate($today)->orderBy('id')->get();
        return view('welcome', compact('tasks', 'today'));
    }

    public function index(): View
    {
        $tasks = Task::orderBy('task_date')->orderBy('id')->get();
        return view('tasks', compact('tasks'));
    }
}
