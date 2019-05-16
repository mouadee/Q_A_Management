
@csrf

<div class="form-group">
    <label for="question-title">Question title</label>
    <input class="form-control @error('title') is-invalid @enderror" name="title" id="question-title" type="text" value="{{ old('title', $question->title) }}">
</div>

@error('title')
<div class="alert alert-danger">
    <strong>{{ $message }}</strong>
</div>
@enderror

<div class="form-group">
    <label for="question-body">Explain Your Question</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="question-body" rows="10">{{ old('description', $question->description ) }}</textarea>
</div>

@error('description')
<div class="alert alert-danger">
    <strong>{{ $message }}</strong>
</div>
@enderror

<div class="form-group">
    <button class="btn btn-outline-primary btn-lg" type="submit">{{ $buttonText }}</button>
</div>