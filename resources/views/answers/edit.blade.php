@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Editing Answer for question: <strong>{{ $question->title }}</strong></h1>
                        </div>
                        <hr>
                        <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <textarea class="form-control @error('body') is-invalid @enderror" rows="7" name="body">{{ old('body', $answer->body) }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-outline-primary">Update</button>
                            </div>
                        </form>

                        {{-- Display form errors --}}
                        @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection