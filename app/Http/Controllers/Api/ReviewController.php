<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Review;
use App\Models\TalkProposal;
use Illuminate\Http\Request;
use App\Models\Tag;

class ReviewController extends Controller
{

    public function index(Request $request)
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


            return response()->json(['data' => $talkProposals, 'tags' => $tags]);
        } catch (\Exception $e) {
            // Log the exception or display an error message
            \Log::error('Error in dashboard: ' . $e->getMessage());
            return response()->json(['error' => "An error occurred while fetching data."]);
        }
    }
}


// You can add more api methods here!