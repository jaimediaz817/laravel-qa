@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="{{ route('questions.index') }}">Back to all Questions</a>
                            </div>
                        </div>
                    </div>

                    <hr>
    
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a href="" title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">8170</span>
                            <a href="" title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a href="" title="Click to mark as favorite question (Click again to undo)" class="favorite mt-2 favorited">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">817</span>
                            </a>
                        </div>

                        <div class="media-body">
                            {{-- {{ !! $question->body_html !! }}  --}}
                            @parsedown($question->body_html)
                            <div class="float-right">
                                <span class="text-muted">Preguntado {{ $question->created_date }}</span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        <img src="{{ $question->user->avatar }}" class="rounded" alt="avatar">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name}}</a>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $question->answers_count . " " . Str::plural('Respuesta', $question->answers_count) }}</h2>
                    </div>
                    <br>
                    @foreach($question->answers as $key => $answer)                    
                        <div class="media">

                            {{-- CONTROLS --}}
                            <div class="d-flex flex-column vote-controls">
                                <a href="" title="This answer is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">8170</span>
                                <a href="" title="This answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a href="Mark this answer as best answer" title="" class="vote-accepted mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                    <span class="favorites-count">817</span>
                                </a>
                            </div>

                            <div class="media-body">
                                @parsedown($answer->body_html)
                                <div class="float-right">
                                    <span class="text-muted">Respondido {{ $answer->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" class="rounded" alt="avatar">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
