@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('views.task.index.list') }}</h1>
    <div class="d-flex">
        <div>
            {{ Form::open(['route' => 'tasks.index', 'class' => 'form-inline', 'method' => 'GET']) }}
            {{ Form::select('filter[status_id]', $statusItems, optional($filters)['status_id'], ['placeholder' => __('models.task.status'), 'class' => 'form-control mr-2']) }}
            {{ Form::select('filter[creator_id]', $userItems, optional($filters)['creator_id'], ['placeholder' => __('models.task.creator'), 'class' => 'form-control mr-2']) }}
            {{ Form::select('filter[assigned_to_id]', $userItems, optional($filters)['assigned_to_id'], ['placeholder' => __('models.task.assignee'), 'class' => 'form-control mr-2']) }}
            {{ Form::select('filter[tags.id]', $tagItems, optional($filters)['tags.id'], ['placeholder' => __('views.task.index.tags'), 'class' => 'form-control mr-2']) }}
            {{ Form::submit(__('views.task.index.apply'), ['class' => 'btn btn-outline-primary mr-2']) }}
            {{ Form::close() }}
        </div>
        @auth
            <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">{{ __('views.task.index.addNewTask') }}</a>
        @endauth
    </div>
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{ __('models.task.id') }}</th>
            <th>{{ __('models.task.name') }}</th>
            <th>{{ __('models.task.status') }}</th>
            <th>{{ __('models.task.creator') }}</th>
            <th>{{ __('models.task.assignee') }}</th>
            <th>{{ __('models.task.createdAt') }}</th>
            <th>{{ __('models.tag.tags') }}</th>
            @auth
                <th>{{ __('views.task.index.actions') }}</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                <td>{{ $task->status->name }}</td>
                <td>{{ $task->creator->name }}</td>
                <td>{{ $task->assignee->name }}</td>
                <td>{{ $task->created_at->format('M d Y') }}</td>
                <td>{{ implode(', ', $task->tags->pluck('name')->all()) }}</td>

                @auth
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}">
                            {{ __('views.task.index.edit') }}
                        </a>

                        @can('destroy', $task)

                            <a href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('views.task.index.confirm') }}"
                               data-method="delete">
                                {{ __('views.task.index.delete') }}
                            </a>
                        @endcan
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
