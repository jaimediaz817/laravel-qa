@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{ $question->title }}</h1>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href="{{ route('questions.index') }}">Back to all Questions</a>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">                    
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