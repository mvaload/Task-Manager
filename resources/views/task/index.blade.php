@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')
    <h1>{{ __('messages.header3') }}</h1>
    <div class="btn-group my-3" role="group" aria-label="Control buttons">
        <a href="{{ route('tasks.create') }}" class="btn btn-success" role="button" aria-pressed="true">{{ __('Create task') }}</a>
    </div>
    <div class="row">
        <div class="col-md-2">
            <h4>{{ __('messages.info.filter') }}</h4>
            <form method="GET" action="{{ route('tasks.index') }}">
                <h5>{{ __('Statuses') }}</h5>
                <select id="statusFilter" class="form-control" name="filter[status_id]">
                    <option>
                        @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ $filter['status_id'] == $status->id ? ' selected' : '' }}>{{ $status->name }}</option>
                    @endforeach
                </select>
                <h5 class="mt-3">{{ __('Users') }}</h5>
                <select id="assignedToFilter" class="form-control" name="filter[assigned_to_id]">
                    <option>
                    <option value="null" {{ $filter['assigned_to_id'] == 'null' ? ' selected' : '' }}>{{ __('Not assigned') }}</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $filter['assigned_to_id'] == $user->id ? ' selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                <h5 class="mt-3">{{ __('Tags') }}</h5>
                <select id="tagFilter" class="form-control" name="filter[tags]">
                    <option>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $filter['tags'] == $tag->id ? ' selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
                <div class="form-group row my-2">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Filter') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-10">
            <table class="table table-striped">
                <thead class="thead-dark">
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
                        <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                        <td>{{ $task->status->name }}</td>
                        <td>{{ $task->creator->name }}</td>
                        <td>{{ $task->assignedTo ? $task->assignedTo->name : __('Not assigned') }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{{ $task->updated_at }}</td>
                    </tr>
                    @empty
                    <p>{{ __('messages.info.record') }}</p>
                    @endforelse
                </tbody>
            </table>
            {{ $tasks->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
@endsection