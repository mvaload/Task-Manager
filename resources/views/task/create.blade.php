@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('Add New Task')</h1>
    {{ Form::model($task, ['url' => route('tasks.store'), 'class' => 'w-50']) }}
    {{ Form::bsText('name') }}
    {{ Form::bsTextarea('description') }}
    {{ Form::bsSelect('status_id', $taskStatuses, null, ['formName' => 'task']) }}
    {{ Form::bsSelect('assigned_to_id', $users, null, ['formName' => 'task']) }}
    {{ Form::bsSelect('tags', $tags, $task->tags, ['formName' => 'task', 'multiple' => 'multiple']) }}
    {{ Form::submit(__('forms.submits.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
