<?php

namespace App\Http\Controllers;

use App\Models\TalkProposal;
use App\Models\Tag;
use Illuminate\Http\Request;

class TalkProposalController extends Controller
{
    public function index()
    {
        $talkProposals = TalkProposal::all();
        return view('talk_proposals.index', compact('talkProposals'));
    }

    public function create()
    {
        return view('talk_proposals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('talk_proposals', 'public');
        }

        $talkProposal = TalkProposal::create([
            'speaker_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        // Add tags
        $tags = explode(',', $request->tags);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $talkProposal->tags()->attach($tag);
        }

        return redirect()->route('talk_proposals.index')->with('success', 'Talk Proposal Submitted Successfully');
    }

    public function show($id)
    {
        $talkProposal = TalkProposal::with('revisions', 'reviews')->findOrFail($id);
        return view('talk_proposals.show', compact('talkProposal'));
    }
}
