{{-- Show Answers --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('Answer', $answersCount) }}</h2>
                    <hr>
                    @include('layouts._messages')
                    @foreach ($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a href="" title="This Answer is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="vote-count">1230</span>
                                <a href="" title="This Answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                @can('accept', $answer)
                                    <a href=""
                                       title="Click to mark as a favourite Answer (Double click to undo)"
                                       class="{{ $answer->status }} mt-2"
                                       onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
                                    >
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="POST" style="display: none">
                                        @csrf

                                    </form>
                                    @else
                                    @if($answer->is_best)
                                        <a href="" title="Best Answer" class="{{ $answer->status }} mt-2">
                                    @endif
                                @endcan
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">

                                            @can('update', $answer)
                                                <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('delete', $answer)
                                                <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-danger" type="submit" onclick="confirm('Are you sure ?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan

                                        </div>
                                    </div>
                                    <div class="col-4">

                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted">Answered {{ $answer->created_at->diffForHumans() }}</span>
                                        <div class="media">
                                            <a href="{{ $answer->user->url }}" class="pr-2">
                                                <img src="{{ $answer->user->avatar }}" alt="avatar">
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $answer->user->url }}">
                                                    {{ $answer->user->name  }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($question->answers_count > 1)
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>