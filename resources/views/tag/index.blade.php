@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('views.tag.index.list') }}</h1>
    @auth
        <a href="{{ route('tags.create') }}" class="btn btn-primary">{{ __('views.tag.index.addNew') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{ __('models.tag.id') }}</th>
            <th>{{ __('models.tag.name') }}</th>
            @auth
                <th>{{ __('views.tag.index.actions') }}</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->id}}</td>
                <td>{{$tag->name}}</td>
                @auth
                    <td>
                        <a href="{{ route('tags.destroy', $tag) }}" data-method="delete" rel="nofollow"
                           data-confirm="{{ __('views.tag.index.confirm') }}">{{ __('views.tag.index.delete') }}</a>
                        <a href="{{ route('tags.edit', $tag) }}">
                            {{ __('views.tag.index.edit') }}
                        </a>
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
