@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('Edit Task')</h1>
    {{ Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'patch', 'class' => 'w-50']) }}
    {{ Form::bsText('name') }}
    {{ Form::bsTextarea('description') }}
    {{ Form::bsSelect('status_id', $taskStatuses, null, ['formName' => 'task']) }}
    {{ Form::bsSelect('assigned_to_id', $users, null, ['formName' => 'task']) }}
    {{ Form::bsSelect('tags', $tags, $task->tags, ['formName' => 'task', 'multiple' => 'multiple']) }}
    {{ Form::submit(__('forms.submits.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
