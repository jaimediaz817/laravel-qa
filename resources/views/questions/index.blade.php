@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href="{{ route('questions.create') }}">Ask Question</a>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    
                    @foreach($questions as $question)
                        <div class="media">                  
                            <div class="d-flex flex-column counters">
                                {{-- votes --}}
                                <div class="vote">
                                    <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes) }}
                                </div>
                                {{-- answers --}}
                                <div class="status {{ $question->status }}">
                                    {{-- TODO: refactor --}}
                                    <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer', $question->answers_count) }}
                                </div>         
                                {{-- views --}}
                                <div class="view">
                                    {{ $question->views . " " . Str::plural('view', $question->views) }}
                                </div>
                            </div>
                            
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    {{-- Enlace principal a la pregunta --}}
                                    <h3 class="mt-0">
                                        <a href="{{ $question->url }}">{{ $question->title }}</a>
                                    </h3>           
                                    {{-- ACTIONS --}}
                                    <div class="ml-auto">
                                        {{-- if(Auth::user()-> --}}
                                        @can('update', $question)
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>                                            
                                        @endcan
                                        @can('delete', $question)
                                            <form action="{{ route('questions.destroy', $question->id) }}" method="post" class="form-delete">
                                                {{-- {{ method_field('DELETE') }}
                                                {{ csrf_token()  }} --}}
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>                                          
                                        @endcan
                                    </div>                     
                                </div>                                
                                <p class="lead">
                                    Asked By
                                    <a href="{{ $question->user->url}}">{{ $question->user->name }}</a>
                                    <small class="text-muted">{{ $question->created_date}}</small>
                                </p>

                                {{ Str::limit($question->body, 250) }}
                            </div>
                        </div>                        
                        <hr />
                    @endforeach
                    
                    <div class="">
                        {{ $questions->links() }}
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
