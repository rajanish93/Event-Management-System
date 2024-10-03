<!-- resources/views/reviews/create.blade.php -->
@extends('layouts.app')

@section('title', 'Review Talk Proposal')

@section('content')
<div class="card">
    <div class="card-header">
        Review Proposal: {{ $talkProposal->title }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('reviews.store', $talkProposal->id) }}">
            @csrf
            <div class="mb-3">
                <label for="comments" class="form-label">Comments</label>
                <textarea name="comments" class="form-control" id="comments" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1 to 5)</label>
                <select name="rating" class="form-control" id="rating" required>
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</div>
@endsection