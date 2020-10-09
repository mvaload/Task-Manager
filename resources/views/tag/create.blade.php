@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('views.tag.create.createNewTag') }}</h1>

    {{ Form::open(['url' => route('tags.store'), 'class' => 'w-50']) }}

    <div class="form-group">
        {{ Form::text('name', '', ['class' => 'form-control']) }}
    </div>

    {{ Form::submit(__('views.tag.create.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
