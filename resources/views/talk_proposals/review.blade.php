<!-- resources/views/talk_proposals/review.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Review Talk Proposal: {{ $talkProposal->title }}</h1>

    <form action="{{ route('talk-proposals.submitReview', $talkProposal->id) }}" method="POST">
        @csrf <!-- CSRF token for form security -->

        <div class="form-group">
            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="form-group">
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>

    <hr>

    <h3>Existing Reviews:</h3>
    @foreach($talkProposal->reviews as $review)
    <div>
        <strong>Rating:</strong> {{ $review->rating }}<br>
        <strong>Comments:</strong> {{ $review->comments }}<br>
        <strong>Reviewed by:</strong> {{ $review->reviewer->name }}<br> <!-- Assuming a relationship with Reviewer -->
        <hr>
    </div>
    @endforeach
</div>
@endsection