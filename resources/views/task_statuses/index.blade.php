@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')
    <h1>{{ __('messages.header2') }}</h1>
    <div class="btn-group my-3" role="group" aria-label="Control buttons">
        <a href="{{ route('task_statuses.create') }}" class="btn btn-success" role="button" aria-pressed="true">{{ __('Create status') }}</a>
    </div>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Name') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($taskStatuses as $taskStatus)
            <tr>
                <th scope="row">{{ $initIteration + $loop->iteration }}</th>
                <td><a href="{{ route('task_statuses.edit', $taskStatus->id) }}">{{ $taskStatus->name }}</a></td>
            </tr>
            @empty
            <p>{{ __('messages.info.record') }}</p>
            @endforelse
        </tbody>
    </table>
    {{ $taskStatuses->links() }}
</div>
@endsection