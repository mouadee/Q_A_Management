@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Questionq --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back To All Question</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a href="" title="This question is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="vote-count">1230</span>
                                <a href="" title="This question is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a href="" title="Click to mark as a favourite question (Double click to undo)" class="favourite mt-2 favourited">
                                    <i class="fas fa-star"></i>
                                    <span class="favourite-count">123</span>
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $question->description_html !!}

                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $question->created_at->diffForHumans() }}</span>
                                    <div class="media">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="avatar">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">
                                                {{ $question->user->name  }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('answers._index',[
            'answers' => $question->answers,
            'answersCount' => $question->answers_count
        ])

        @include('answers._create')
    </div>
@endsection