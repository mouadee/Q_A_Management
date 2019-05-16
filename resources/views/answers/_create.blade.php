
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control @error('body') is-invalid @enderror" rows="7" name="body"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
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