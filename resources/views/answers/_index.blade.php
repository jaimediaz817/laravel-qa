<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    {{-- <h2>{{ $question->answers_count . " " . Str::plural('Respuesta', $question->answers_count) }}</h2> --}}
                    <h2>{{ $answersCount . " " . Str::plural('Respuesta', $answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($answers as $answer)                    
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
                            <div class="row">
                                <div class="col-md-4">
                                    {{-- ACTIONS --}}
                                    <div class="ml-auto">
                                        {{-- if(Auth::user()-> --}}
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>                                            
                                        @endcan
                                        @can('delete', $answer)
                                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post" class="form-delete">
                                                {{-- {{ method_field('DELETE') }}
                                                {{ csrf_token()  }} --}}
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>                                          
                                        @endcan
                                    </div>
                                </div>

                                <div class="col-md-4">

                                </div>

                                <div class="col-md-4">
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
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>