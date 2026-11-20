@extends('layouts.app')
@section('title', 'Task List')
@section('content')
<section class="page-intro compact"><div><p class="eyebrow">THE COMPLETE PICTURE</p><h1>Your task list<span>.</span></h1><p class="lead">Yesterday, today, and what comes next. Every task, in date order.</p></div><span class="count-chip">{{ $tasks->count() }} tasks total</span></section>
<section class="panel">
    <div class="panel-heading"><div><p class="eyebrow">ALL DATES</p><h2>All tasks</h2></div><span class="muted">Earliest date first</span></div>
    @include('partials.task-table', ['tableLabel' => 'All tasks ordered by date', 'emptyMessage' => 'No tasks have been added yet.'])
    <p class="panel-note">This list includes every task, regardless of its date or status.</p>
</section>
@endsection
