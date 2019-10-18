@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')

    <h1>{{ __('Dashboard') }}</h1>
    <h3>{{ __('My tasks') }}</h3>
    <div class="row">
    @forelse($myTasks as $myTask)

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                </div>
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
    <p>{{ __('No records') }}</p>
    @endforelse
    </div>
</div>
@endsection