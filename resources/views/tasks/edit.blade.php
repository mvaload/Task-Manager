@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Task') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{ $task->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status_id" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">

                                <select id="status_id" class="form-control @error('status_id') is-invalid @enderror" name="status_id">
                                @foreach ($statuses as $status)

                                    <option value="{{ $status->id }}"{{ $task->status->id == $status->id ? ' selected' : '' }}>{{ $status->name }}</option>

                                @endforeach
                                </select>

                                @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assigned_to_id" class="col-md-4 col-form-label text-md-right">{{ __('Assigned To') }}</label>

                            <div class="col-md-6">

                                <select id="assigned_to_id" class="form-control @error('assigned_to_id') is-invalid @enderror" name="assigned_to_id">
                                    <option>
                                    @foreach ($users as $user)

                                        <option value="{{ $user->id }}"{{ $task->assignedTo && ($task->assignedTo->id == $user->id) ? ' selected' : '' }}>{{ $user->name }}</option>

                                    @endforeach
                                </select>

                                @error('assigned_to_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                                <a href="{{ route('tasks.destroy', ['id' => $task->id]) }}" class="btn btn-danger" data-method="delete">
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection