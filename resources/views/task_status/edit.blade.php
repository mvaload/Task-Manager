@extends('layouts.app')

@section('content')
    {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH', 'class' => 'w-50']) }}

    <div class="form-group">
        {{ Form::label('name', __('models.taskStatus.name')) }}
        {{ Form::text('name', $taskStatus->name, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit(__('views.taskStatus.edit.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
