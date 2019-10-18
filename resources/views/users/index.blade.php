@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <h1>{{ __('Users') }}</h1>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Registered at') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <th scope="row">{{ $initIteration + $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @empty
                <p>No users</p>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection