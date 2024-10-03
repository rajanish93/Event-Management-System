<!-- resources/views/talk_proposals/show.blade.php -->
@extends('layouts.app')

@section('title', 'Talk Proposal Details')

@section('content')
<div class="container mt-4">
    <!-- Talk Proposal Details Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $talkProposal->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $talkProposal->description }}</p>
            <p><strong>Status:</strong> {{ ucfirst($talkProposal->status) }}</p>

            <!-- Speaker Information -->
            <p><strong>Speaker:</strong> {{ $talkProposal->speaker->name }}</p>

            <!-- Tags Information -->
            @if($talkProposal->tags->count() > 0)
            <p><strong>Tags:</strong>
                @foreach($talkProposal->tags as $tag)
                <span class="badge bg-primary">{{ $tag->name }}</span>
                @endforeach
            </p>
            @endif

            <!-- File Download -->
            @if($talkProposal->file_path)
            <p>
                <strong>Presentation File:</strong>
                <a href="{{ Storage::url($talkProposal->file_path) }}" target="_blank"
                    class="btn btn-secondary">Download PDF</a>
            </p>
            @endif

            <!-- Proposal Revision History -->
            @if($talkProposal->revisions->count() > 0)
            <hr>
            <h5>Revision History:</h5>
            <ul class="list-group">
                @foreach($talkProposal->revisions as $revision)
                <li class="list-group-item">
                    <strong>{{ $revision->created_at->format('Y-m-d H:i') }}</strong> -
                    {{ $revision->description }}
                    (by {{ $revision->user->name }})
                </li>
                @endforeach
            </ul>
            @endif

            <!-- Back Button -->
            <a href="{{ route('talk_proposals.index') }}" class="btn btn-secondary mt-3">Back to Proposals List</a>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Reviews</h4>
        </div>
        <div class="card-body">
            @if($talkProposal->reviews->count() > 0)
            <ul class="list-group">
                @foreach($talkProposal->reviews as $review)
                <li class="list-group-item">
                    <strong>Reviewer:</strong> {{ $review->reviewer->name }} <br>
                    <strong>Rating:</strong> {{ $review->rating }} / 5 <br>
                    <strong>Comments:</strong> {{ $review->comments }}
                </li>
                @endforeach
            </ul>
            @else
            <p>No reviews available for this proposal.</p>
            @endif
        </div>
    </div>
</div>
@endsection