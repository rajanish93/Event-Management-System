<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TalkProposal;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $proposalId)
    {
        $request->validate([
            'comments' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'talk_proposal_id' => $proposalId,
            'reviewer_id' => auth()->id(),
            'comments' => $request->comments,
            'rating' => $request->rating,
        ]);

        // Update proposal status
        $talkProposal = TalkProposal::findOrFail($proposalId);
        $talkProposal->update(['status' => 'reviewed']);

        return redirect()->route('reviewer.dashboard')->with('success', 'Review Submitted Successfully');
    }
}
