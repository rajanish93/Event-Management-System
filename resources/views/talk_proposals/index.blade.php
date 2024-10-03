<!-- resources/views/talk_proposals/index.blade.php -->
@extends('layouts.app')

@section('title', 'Talk Proposals')

@section('content')
<div class="card">
    <div class="card-header">
        Talk Proposals
        <a href="{{ route('talk_proposals.create') }}" class="btn btn-sm btn-success float-end">Submit New Proposal</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
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
                    <td>{{ ucfirst($proposal->status) }}</td>
                    <td>
                        <a href="{{ route('talk_proposals.show', $proposal->id) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection