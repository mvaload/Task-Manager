@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        Task: {{ $task->name }} <a href="{{ route('tasks.edit', $task) }}">⚙</a>
    </h1>
    <div>
        {{ __('Name') }}: {{ $task->name }}
    </div>
    <div>
        {{ __('Description') }}: {{ $task->description }}
    </div>
@endsection
