@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')

    <h1>{{ __('Tasks') }}</h1>
    <div class="btn-group my-3" role="group" aria-label="Control buttons">
        <a href="{{ route('tasks.create') }}" class="btn btn-outline-secondary" role="button" aria-pressed="true">{{ __('Create task') }}</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Creator') }}</th>
                <th scope="col">{{ __('Assigned To') }}</th>
                <th scope="col">{{ __('Created at') }}</th>
                <th scope="col">{{ __('Updated at') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
            <tr>
                <td><a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{ $task->name }}</a></td>
                <td>{{ $task->status->name }}</td>
                <td>{{ $task->creator->name }}</td>
                <td>{{ $task->assignedTo ? $task->assignedTo->name : __('Not assigned') }}</td>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->updated_at }}</td>
            </tr>
            @empty
            <p>{{ __('No records') }}</p>
            @endforelse
        </tbody>
    </table>
    {{ $tasks->links() }}
</div>
@endsection