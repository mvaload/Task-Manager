

@extends('layouts.app')

@section('content')
    {{ Form::model($tag, ['url' => route('tags.update', $tag), 'method' => 'PATCH', 'class' => 'w-50']) }}

    <div class="form-group">
        {{ Form::label('name', __('models.tag.name')) }}
        {{ Form::text('name', $tag->name, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit(__('views.tag.edit.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
