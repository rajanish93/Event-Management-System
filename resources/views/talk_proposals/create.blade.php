<!-- resources/views/talk_proposals/create.blade.php -->
@extends('layouts.app')

@section('title', 'Submit Talk Proposal')

@section('content')
<div class="card">
    <div class="card-header">
        Submit Talk Proposal
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('talk_proposals.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags (comma-separated)</label>
                <input type="text" name="tags" class="form-control" id="tags">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload PDF (optional)</label>
                <input type="file" name="file" class="form-control" id="file" accept="application/pdf">
            </div>
            <button type="submit" class="btn btn-primary">Submit Proposal</button>
        </form>
    </div>
</div>
@endsection