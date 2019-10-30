@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')
    <h3>{{ __('messages.taskbar') }}</h3>
    <div class="row">
        @forelse($myTasks as $myTask)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card text-white bg-dark mb-3">
                    <strong><a href="{{ route('tasks.show', ['id' => $myTask->id]) }}">{{ $myTask->name }}</a></strong>
                    <span class="badge badge-info">{{ $myTask->status->name }}</span>
                </div>
                <div class="card-body">
                    <p>{{ $myTask->description }}</p>
                    <p class="card-text text-right"><small class="text-muted">{{ $myTask->updated_at }}</small></p>
                </div>
            </div>
        </div>
        @empty
        <p>{{ __('messages.info.record') }}</p>
        @endforelse
    </div>
</div>
@endsection