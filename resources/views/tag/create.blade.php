@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('views.taskStatus.create.createNewTaskStatus') }}</h1>

    {{ Form::open(['url' => route('task_statuses.store'), 'class' => 'w-50']) }}

    <div class="form-group">
        {{ Form::text('name', '', ['class' => 'form-control']) }}
    </div>

    {{ Form::submit(__('views.taskStatus.create.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
