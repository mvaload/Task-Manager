@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ __('views.welcome.taskManager') }}</h1>
            <p class="lead">{{ __('views.welcome.description') }}</p>
            <a href="http://mailtrap.io/share/739586/52334c9becdc8258e46e0fbb58545ceb" class="lead">http://mailtrap.io/share/</a>
            <hr class="my-4">
            <p>{{ __('views.welcome.hexletProject') }}</p>
            <a class="btn btn-primary btn-lg" href="http://hexlet.io" role="button">{{ __('views.welcome.learnMore') }}</a>
        </div>
    </div>
@endsection
