@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('views.taskStatus.index.list') }}</h1>
    @auth
        <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('views.taskStatus.index.addNew') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{ __('models.taskStatus.id') }}</th>
            <th>{{ __('models.taskStatus.name') }}</th>
            <th>{{ __('models.taskStatus.createdAt') }}</th>
            @auth
                <th>{{ __('views.taskStatus.index.actions') }}</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach($taskStatuses as $taskStatus)
            <tr>
                <td>{{$taskStatus->id}}</td>
                <td>{{$taskStatus->name}}</td>
                <td>{{$taskStatus->created_at}}</td>
                @auth
                    <td>
                        <a href="{{ route('task_statuses.destroy', $taskStatus) }}" data-method="delete" rel="nofollow"
                           data-confirm="{{ __('views.taskStatus.index.confirm') }}">{{ __('views.taskStatus.index.delete') }}</a>
                        <a href="{{ route('task_statuses.edit', $taskStatus) }}">
                            {{ __('views.taskStatus.index.edit') }}
                        </a>
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
