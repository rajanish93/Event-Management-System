<?php

namespace App\Http\Controllers;

use App\Models\TalkProposal;
use App\Models\Tag;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function dashboard(Request $request)
    {
        $talkProposals = TalkProposal::query();

        if ($request->has('search')) {
            $talkProposals->where('title', 'LIKE', "%{$request->search}%")
                ->orWhereHas('speaker', function ($query) use ($request) {
                    $query->where('name', 'LIKE', "%{$request->search}%");
                });
        }

        if ($request->has('tag') && $request->tag != '') {
            $talkProposals->whereHas('tags', function ($query) use ($request) {
                $query->where('id', $request->tag);
            });
        }

        $talkProposals = $talkProposals->get();
        $tags = Tag::all();

        return view('reviewers.dashboard', compact('talkProposals', 'tags'));
    }

    public function showProposal($id)
    {
        $talkProposal = TalkProposal::findOrFail($id);
        return view('reviewers.show_proposal', compact('talkProposal'));
    }
}
