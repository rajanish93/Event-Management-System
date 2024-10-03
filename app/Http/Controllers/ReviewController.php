<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TalkProposal;
use Illuminate\Http\Request;
use App\Models\Tag;

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

    public function dashboard(Request $request)
    {
        try {
            // Start the query
            $talkProposals = TalkProposal::query();

            // Search functionality
            if ($request->has('search') && $request->search != '') {
                $talkProposals->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhereHas('speaker', function ($query) use ($request) {
                        $query->where('name', 'LIKE', "%{$request->search}%");
                    });
            }

            // Tag filtering
            if ($request->has('tag') && $request->tag != '') {
                $talkProposals->whereHas('tags', function ($query) use ($request) {
                    $query->where('id', $request->tag);
                });
            }

            // Fetch the results
            $talkProposals = $talkProposals->get();

            // Fetch all tags
            $tags = Tag::all();

            // Return the view with data
            return view('reviewers.dashboard', compact('talkProposals', 'tags'));
        } catch (\Exception $e) {
            // Log the exception or display an error message
            \Log::error('Error in dashboard: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while fetching data.']);
        }
    }


    public function showProposal($id)
    {
        $talkProposal = TalkProposal::findOrFail($id);
        return view('reviewers.show_proposal', compact('talkProposal'));
    }
}
