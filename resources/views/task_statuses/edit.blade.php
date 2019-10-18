@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.flash')
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit task status') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('task_statuses.update', ['id' => $taskStatus->id]) }}">
                        @csrf
                        @method('put')
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $taskStatus->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-between">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                                <a href="{{ route('task_statuses.destroy', ['id' => $taskStatus->id]) }}" class="btn btn-danger" data-method="delete" data-confirm="Are you sure you want to delete this task status?">
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