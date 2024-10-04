<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\TalkProposal;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Events\MyEvent;


use App\Models\Review; // Ensure you import the Review model

class TalkProposalController extends Controller
{
    public function index()
    {

        event(new MessageSent("Hello World!"));
        $talkProposals = TalkProposal::all();
        return view('talk_proposals.index', compact('talkProposals'));
    }

    public function create()
    {
        return view('talk_proposals.create');
    }

    public function store(Request $request)
    {

        // print_r($request->all());
        // echo  auth()->id();
        // die;
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
        $talkProposal = TalkProposal::with(['speaker', 'tags', 'revisions', 'reviews.reviewer'])->findOrFail($id);

        // print_r($talkProposal);
        // die;

        return view('talk_proposals.show', compact('talkProposal'));
    }

    public function submitReview(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        // Find the talk proposal
        $talkProposal = TalkProposal::findOrFail($id);

        // Create a new review
        $review = new Review(); // Assuming you have a Review model
        $review->talk_proposal_id = $talkProposal->id;
        $review->reviewer_id = auth()->id(); // Assuming you have an authentication system
        $review->rating = $request->rating;
        $review->comments = $request->comments;
        $review->save();

        // Optionally, update the status of the proposal based on the review
        $talkProposal->status = 'reviewed';
        $talkProposal->save();

        // Redirect back to the review page with a success message
        return redirect()->route('reviewer.proposal.show', $talkProposal->id)->with('success', 'Review submitted successfully!');
    }

    public function review($id)
    {
        // Find the talk proposal
        $talkProposal = TalkProposal::with('reviews')->findOrFail($id);

        // Pass the talk proposal to the view
        return view('talk_proposals.review', compact('talkProposal'));
    }
}
