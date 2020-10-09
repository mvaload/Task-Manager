@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-primary">{{ $task->name }}</div>
                <div class="card-body">
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Status') }}</strong></span>
                        <div class="col-md-6">
                            <span>{{ $task->status->name }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Description') }}</strong></span>
                        <div class="col-md-6">
                            <p>{{ $task->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Creator') }}</strong></span>
                        <div class="col-md-6">
                            <span>{{ $task->creator->name }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Assigned to') }}</strong></span>
                        <div class="col-md-6">
                            <span>{{ $task->assignedTo ? $task->assignedTo->name : __('Not assigned') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Tags') }}</strong></span>
                        <div class="col-md-6">
                            <span>{{ $task->tags->implode('name', ', ') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Created at') }}</strong></span>
                        <div class="col-md-6">
                            <span>{{ $task->created_at }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-md-4 text-md-right"><strong>{{ __('Updated at') }}</strong></span>
                        <div class="col-md-6">
                            <span>{{ $task->updated_at }}</span>
                        </div>
                    </div>
                    <div class="row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success">
                                {{ __('Edit task') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection