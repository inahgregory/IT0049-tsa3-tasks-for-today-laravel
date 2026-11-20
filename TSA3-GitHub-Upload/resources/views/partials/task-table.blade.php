<div class="table-wrap" tabindex="0" role="region" aria-label="{{ $tableLabel }}">
<table>
    <caption class="sr-only">{{ $tableLabel }}</caption>
    <thead><tr><th scope="col">ID</th><th scope="col">Task</th><th scope="col">Date</th><th scope="col">Status</th></tr></thead>
    <tbody>
    @forelse ($tasks as $task)
        <tr>
            <td class="muted">{{ str_pad($task->id, 2, '0', STR_PAD_LEFT) }}</td>
            <th scope="row">{{ $task->title }}</th>
            <td class="date-cell"><time datetime="{{ $task->task_date->toDateString() }}">{{ $task->task_date->format('M d, Y') }}</time></td>
            <td><span @class(['status', 'completed' => $task->status === 'completed', 'in-progress' => $task->status === 'in_progress'])>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span></td>
        </tr>
    @empty
        <tr><td colspan="4" class="empty-state">{{ $emptyMessage }}</td></tr>
    @endforelse
    </tbody>
</table>
</div>
