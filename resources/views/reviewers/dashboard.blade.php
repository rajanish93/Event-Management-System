<!-- resources/views/reviewers/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Reviewer Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        Reviewer Dashboard
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reviewer.dashboard') }}">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by title or speaker">
                </div>
                <div class="col-md-3">
                    <select name="tag" class="form-control">
                        <option value="">Filter by Tag</option>
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Speaker</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($talkProposals as $proposal)
                <tr>
                    <td>{{ $proposal->id }}</td>
                    <td>{{ $proposal->title }}</td>
                    <td>{{ Str::limit($proposal->description, 50) }}</td>
                    <td>{{ $proposal->speaker->name }}</td>
                    <td>{{ ucfirst($proposal->status) }}</td>
                    <td>
                        <a href="{{ route('reviewer.proposal.show', $proposal->id) }}"
                            class="btn btn-sm btn-info">Review</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection